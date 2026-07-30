<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('recipient_name');
            $table->string('sender_name');
            $table->string('title')->default('Une petite invitation pour toi');
            $table->text('intro_message')->nullable();
            $table->json('available_dates')->nullable();
            $table->json('available_times')->nullable();
            $table->json('suggested_places')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
