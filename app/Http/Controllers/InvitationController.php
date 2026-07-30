<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\View\View;

class InvitationController extends Controller
{
    public function show(string $token): View
    {
        $invitation = Invitation::query()
            ->where('token', $token)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->firstOrFail();

        return view('invitation.show', compact('invitation'));
    }

    public function confirmed(string $token): View
    {
        $invitation = Invitation::query()
            ->with('response')
            ->where('token', $token)
            ->firstOrFail();

        abort_unless($invitation->response, 404);

        return view('invitation.confirmed', compact('invitation'));
    }
}
