<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Adresse recevant les réponses
    |--------------------------------------------------------------------------
    |
    | Cette valeur doit être définie uniquement dans le fichier .env afin de
    | ne pas exposer l'adresse du destinataire dans le dépôt public.
    |
    */
    'notification_email' => env('INVITATION_NOTIFICATION_EMAIL'),
];
