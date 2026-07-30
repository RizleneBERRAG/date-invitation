<?php

namespace App\Http\Controllers;

use App\Mail\InvitationResponseReceived;
use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        if (filled($notificationEmail)) {
            try {
                Mail::to($notificationEmail)->send(
                    new InvitationResponseReceived(
                        invitation: $invitation,
                        dateResponse: $dateResponse,
                    )
                );
            } catch (Throwable $exception) {
                /*
                 * La réponse reste enregistrée même si Gmail est momentanément
                 * indisponible. L'erreur est conservée dans les logs Laravel.
                 */
                report($exception);
            }
        }

        return redirect()->route('invitation.confirmed', $invitation->token);
    }
}
