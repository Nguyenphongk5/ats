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
        Schema::table('cvs', function (Blueprint $table) {
            //
            $table->date('qualify_date')->nullable();
            $table->date('interview1_date')->nullable();
            $table->date('interview2_date')->nullable();
            $table->date('offer_date')->nullable();
            $table->date('hand_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cvs', function (Blueprint $table) {
            //
               $table->dropColumn(['qualify_date', 'interview1_date', 'interview2_date', 'offer_date', 'hand_date']);
        });
    }
};
