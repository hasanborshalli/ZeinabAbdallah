<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title_ar');
        });

        // Backfill existing categories from their (English) title so public
        // session URLs keep working the moment this ships — the admin form
        // takes over from here for anything added or renamed afterwards.
        DB::table('categories')->whereNull('slug')->get(['id', 'title'])->each(function ($category) {
            DB::table('categories')->where('id', $category->id)->update([
                'slug' => Str::slug($category->title),
            ]);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
