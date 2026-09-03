<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();

            $table->string('full_name');
            $table->string('phone');

            $table->date('date');
            $table->time('start_time');
            // Snapshotted from the package at booking time, so a later change
            // to the package's duration never reshuffles an existing booking.
            $table->unsignedInteger('duration_minutes');

            $table->boolean('share_on_social')->default(false);
            $table->string('status')->default('pending'); // pending | confirmed | declined

            // Category-specific answers (baby_name, cake_choice, etc.) — the
            // question set differs per category, so it's stored as JSON rather
            // than one nullable column per possible question. See Category::bookingTemplate().
            $table->json('details')->nullable();

            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
