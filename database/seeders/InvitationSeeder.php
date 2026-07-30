<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    public function run(): void
    {
        Invitation::query()->updateOrCreate(
            ['token' => 'pour-toi'],
            [
                'recipient_name' => 'Toi',
                'sender_name' => 'Rizlene',
                'title' => 'J’ai une petite proposition…',
                'intro_message' => 'Une sortie, deux personnes plutôt cool, et probablement quelque chose de bon à manger. Tu acceptes de choisir notre prochain date ?',
                'available_dates' => [
                    now()->next('Saturday')->toDateString(),
                    now()->next('Sunday')->toDateString(),
                    now()->next('Friday')->addWeek()->toDateString(),
                ],
                'available_times' => ['14:00', '16:30', '19:00', '20:30'],
                'suggested_places' => [
                    ['label' => 'Un restaurant', 'emoji' => '🍝'],
                    ['label' => 'Une activité', 'emoji' => '🎳'],
                    ['label' => 'Une jolie balade', 'emoji' => '🌅'],
                    ['label' => 'Surprise-moi', 'emoji' => '🎁'],
                ],
                'is_active' => true,
                'expires_at' => now()->addMonths(2),
            ]
        );
    }
}
