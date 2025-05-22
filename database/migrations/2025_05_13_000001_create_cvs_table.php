<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
             $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('job_id')->nullable()->constrained()->onDelete('cascade');
    $table->string('full_name');
    $table->year('birth_year');
    $table->string('last_company')->nullable();
    $table->string('last_position')->nullable();
    $table->string('file_path');
    $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cvs');
    }
};
