<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('small_description')->nullable()->change();
            $table->string('small_description_ar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->whereNull('small_description')->update(['small_description' => '']);
        DB::table('categories')->whereNull('small_description_ar')->update(['small_description_ar' => '']);

        Schema::table('categories', function (Blueprint $table) {
            $table->string('small_description')->nullable(false)->change();
            $table->string('small_description_ar')->nullable(false)->change();
        });
    }
};
