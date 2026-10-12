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
        // booking_theme references bookings, so it has to go first.
        Schema::dropIfExists('booking_theme');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('portfolios');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();

            $table->string('full_name');
            $table->string('phone');

            $table->date('date');
            $table->time('start_time');
            $table->unsignedInteger('duration_minutes');

            $table->boolean('share_on_social')->default(false);
            $table->string('status')->default('pending');

            $table->json('details')->nullable();

            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::create('booking_theme', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('theme_id')->constrained()->cascadeOnDelete();
        });

        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->boolean('tall')->default(false);
            $table->timestamps();
        });
    }
};
