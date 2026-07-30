<?php

use App\Http\Controllers\DateResponseController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('invitation.show', [
        'token' => 'pour-toi',
    ]);
});

Route::get('/invitation/{token}', [InvitationController::class, 'show'])
    ->name('invitation.show');

Route::post('/invitation/{token}', [DateResponseController::class, 'store'])
    ->name('invitation.store');

Route::get('/invitation/{token}/confirmation', [InvitationController::class, 'confirmed'])
    ->name('invitation.confirmed');
