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
    Schema::table('jobs', function (Blueprint $table) {
        $table->unsignedInteger('interview1_count')->default(0);
    });
}

public function down()
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->dropColumn('interview1_count');
    });
}
};
