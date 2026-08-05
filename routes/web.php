<?php

use App\Http\Controllers\DateResponseController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/', function () {
    return redirect()->route('invitation.show', [
        'token' => 'pour-toi',
    ]);
});

Route::get('/pour-toi', function () {
    return redirect()->route('invitation.show', [
        'token' => 'pour-toi',
    ]);
});

/*
|--------------------------------------------------------------------------
| Assets de l’invitation
|--------------------------------------------------------------------------
|
| Ces fichiers sont volontairement servis par Laravel. La page reste ainsi
| utilisable lorsqu’un ancien manifeste Vite est encore présent en local.
| La liste blanche empêche l’accès à tout autre fichier du projet.
|
*/

Route::get('/invitation-assets/{file}', function (string $file) {
    $assets = [
        'invitation-base.css' => [
            'path' => resource_path('css/invitation-base.css'),
            'type' => 'text/css; charset=UTF-8',
        ],
        'mobile.css' => [
            'path' => resource_path('css/mobile.css'),
            'type' => 'text/css; charset=UTF-8',
        ],
        'invitation.js' => [
            'path' => resource_path('js/invitation.js'),
            'type' => 'application/javascript; charset=UTF-8',
        ],
    ];

    abort_unless(isset($assets[$file]), 404);
    abort_unless(is_file($assets[$file]['path']), 404);

    return response()->file(
        $assets[$file]['path'],
        [
            'Content-Type' => $assets[$file]['type'],
            'Cache-Control' => 'public, max-age=3600',
            'X-Content-Type-Options' => 'nosniff',
        ]
    );
})
    ->where('file', 'invitation-base\.css|mobile\.css|invitation\.js')
    ->name('invitation.asset');

Route::get('/invitation/{token}', [InvitationController::class, 'show'])
    ->name('invitation.show');

Route::post('/invitation/{token}', [DateResponseController::class, 'store'])
    ->name('invitation.store');

Route::get('/invitation/{token}/confirmation', [InvitationController::class, 'confirmed'])
    ->name('invitation.confirmed');
