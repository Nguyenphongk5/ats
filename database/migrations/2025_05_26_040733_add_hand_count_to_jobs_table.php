<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_add_hand_count_to_jobs_table.php

public function up()
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->unsignedInteger('hand_count')->default(0);
    });
}

public function down()
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->dropColumn('hand_count');
    });
}

};
