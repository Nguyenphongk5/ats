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
        Schema::create('function_jobs', function (Blueprint $table) {
            $table->id();
    $table->foreignId('function_model_id')->constrained('function_models')->onDelete('cascade');
    $table->text('description');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('function_jobs');
    }
};
