<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('moods', function (Blueprint $table) {
       if (!Schema::hasColumn('moods', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('moods', 'mood')) {
                $table->string('mood')->nullable()->after('user_id');
            }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
