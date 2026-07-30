<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Adresse recevant les réponses
    |--------------------------------------------------------------------------
    |
    | Le destinataire reçoit le récapitulatif, mais n'a jamais besoin de fournir
    | son mot de passe. Cette adresse reste uniquement dans le fichier .env.
    |
    */
    'notification_email' => env('INVITATION_NOTIFICATION_EMAIL'),

    /*
    |--------------------------------------------------------------------------
    | Brevo
    |--------------------------------------------------------------------------
    |
    | Brevo sert uniquement de transport. La clé API et l'adresse expéditrice
    | vérifiée ne doivent jamais être ajoutées au dépôt GitHub.
    |
    */
    'brevo' => [
        'api_key' => env('BREVO_API_KEY'),
        'sender_email' => env('BREVO_SENDER_EMAIL'),
        'sender_name' => env('BREVO_SENDER_NAME', 'Invitation Date'),
    ],
];