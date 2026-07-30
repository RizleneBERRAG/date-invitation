<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle réponse à ton invitation</title>
</head>
<body style="margin:0;padding:0;background:#fff7f4;font-family:Arial,sans-serif;color:#3e2b31;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#fff7f4;padding:28px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px;background:#ffffff;border:1px solid #f0d8df;border-radius:24px;overflow:hidden;box-shadow:0 18px 50px rgba(92,42,57,.12);">
                    <tr>
                        <td style="padding:34px 30px 24px;text-align:center;background:linear-gradient(135deg,#fff0f4,#fff8f4);">
                            <div style="font-size:44px;line-height:1;margin-bottom:14px;">💌</div>
                            <h1 style="margin:0;font-size:30px;line-height:1.2;color:#7e2942;">Elle a répondu à ton invitation !</h1>
                            <p style="margin:12px 0 0;color:#8b7078;font-size:15px;line-height:1.6;">
                                Voici le récapitulatif de ses choix.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:28px 30px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:separate;border-spacing:0 10px;">
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Ambiance</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">{{ $dateResponse->activity }}</td>
                                </tr>
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Date</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">
                                        {{ $dateResponse->selected_date->locale('fr')->translatedFormat('l j F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Heure</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">
                                        {{ str_replace(':', ' h ', $dateResponse->selected_time) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Nourriture</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">{{ $dateResponse->food_preference ?: 'Non précisé' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Tenue</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">{{ $dateResponse->outfit_style ?: 'Non précisé' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Musique</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">{{ $dateResponse->music_choice ?: 'Non précisé' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:36%;padding:13px 16px;background:#fff4f6;border-radius:14px 0 0 14px;color:#8b7078;font-size:13px;font-weight:bold;">Romantisme</td>
                                    <td style="padding:13px 16px;background:#fff4f6;border-radius:0 14px 14px 0;font-size:14px;font-weight:bold;">{{ $dateResponse->romance_level ?: 'Au feeling' }}</td>
                                </tr>
                            </table>

                            @if ($dateResponse->personal_message)
                                <div style="margin-top:20px;padding:18px;border-radius:16px;background:#f9e7ec;color:#7e2942;font-size:15px;line-height:1.65;">
                                    <strong style="display:block;margin-bottom:8px;">Son petit message :</strong>
                                    “{{ $dateResponse->personal_message }}”
                                </div>
                            @endif

                            <p style="margin:24px 0 0;text-align:center;color:#8b7078;font-size:12px;line-height:1.5;">
                                Réponse enregistrée le {{ $dateResponse->confirmed_at->locale('fr')->translatedFormat('j F Y à H\hi') }}.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
