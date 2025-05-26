<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->boolean('qualified')->default(false)->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->dropColumn('qualified');
        });
    }
};
