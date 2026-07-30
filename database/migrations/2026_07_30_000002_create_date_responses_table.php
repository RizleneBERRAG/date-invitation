<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'date_responses',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->foreignId('invitation_id')
                    ->unique()
                    ->constrained()
                    ->cascadeOnDelete();

                $table->string('activity');
                $table->date('selected_date');
                $table->string('selected_time', 5);

                $table
                    ->string('food_preference')
                    ->nullable();

                $table
                    ->string('outfit_style')
                    ->nullable();

                $table
                    ->string('music_choice')
                    ->nullable();

                $table
                    ->string('romance_level')
                    ->nullable();

                $table
                    ->text('personal_message')
                    ->nullable();

                $table->timestamp('confirmed_at');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('date_responses');
    }
};
