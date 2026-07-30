<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class DateResponseController extends Controller
{
    public function store(Request $request, string $token): RedirectResponse
    {
        $invitation = Invitation::query()
            ->where('token', $token)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'activity' => ['required', 'string', 'max:100'],
            'selected_date' => ['required', 'date', 'after_or_equal:today'],
            'selected_time' => ['required', 'date_format:H:i'],
            'food_preference' => ['nullable', 'string', 'max:80'],
            'outfit_style' => ['nullable', 'string', 'max:80'],
            'music_choice' => ['nullable', 'string', 'max:80'],
            'romance_level' => ['nullable', 'string', 'max:80'],
            'personal_message' => ['nullable', 'string', 'max:500'],
        ]);

        $dateResponse = $invitation->response()->updateOrCreate(
            ['invitation_id' => $invitation->id],
            [...$validated, 'confirmed_at' => now()]
        );

        $notificationEmail = config('invitation.notification_email');
        $apiKey = config('invitation.brevo.api_key');
        $senderEmail = config('invitation.brevo.sender_email');
        $senderName = config('invitation.brevo.sender_name');

        if (filled($notificationEmail) && filled($apiKey) && filled($senderEmail)) {
            try {
                $htmlContent = view('emails.invitation-response-received', [
                    'invitation' => $invitation,
                    'dateResponse' => $dateResponse,
                ])->render();

                $textLines = [
                    'Nouvelle réponse à ton invitation',
                    '',
                    'Ambiance : '.$dateResponse->activity,
                    'Date : '.$dateResponse->selected_date
                        ->locale('fr')
                        ->translatedFormat('l j F Y'),
                    'Heure : '.str_replace(':', ' h ', $dateResponse->selected_time),
                ];

                foreach ([
                    'Nourriture' => $dateResponse->food_preference,
                    'Tenue' => $dateResponse->outfit_style,
                    'Musique' => $dateResponse->music_choice,
                    'Romantisme' => $dateResponse->romance_level,
                    'Message' => $dateResponse->personal_message,
                ] as $label => $value) {
                    if (filled($value)) {
                        $textLines[] = $label.' : '.$value;
                    }
                }

                Http::timeout(15)
                    ->acceptJson()
                    ->withHeaders([
                        'api-key' => $apiKey,
                    ])
                    ->post('https://api.brevo.com/v3/smtp/email', [
                        'sender' => [
                            'name' => $senderName,
                            'email' => $senderEmail,
                        ],
                        'to' => [
                            [
                                'email' => $notificationEmail,
                                'name' => $invitation->sender_name,
                            ],
                        ],
                        'subject' => '💌 Nouvelle réponse à ton invitation',
                        'htmlContent' => $htmlContent,
                        'textContent' => implode("\n", $textLines),
                    ])
                    ->throw();
            } catch (Throwable $exception) {
                /*
                 * La réponse reste enregistrée même si l'API d'e-mail est
                 * momentanément indisponible. L'erreur reste dans les logs.
                 */
                report($exception);
            }
        }

        return redirect()->route('invitation.confirmed', $invitation->token);
    }
}
