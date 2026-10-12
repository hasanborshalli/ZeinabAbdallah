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
        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });

        // FAQs weren't per-session before this migration — every question
        // written so far was actually written for the Newborn session, so
        // that's where the existing rows land rather than being left unset.
        $newbornId = DB::table('categories')->where('title', 'Newborn')->value('id');

        if ($newbornId) {
            DB::table('questions')->whereNull('category_id')->update(['category_id' => $newbornId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
