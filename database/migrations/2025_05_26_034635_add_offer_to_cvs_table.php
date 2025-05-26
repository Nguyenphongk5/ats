<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_offer_to_cvs_table.php

public function up()
{
    Schema::table('cvs', function (Blueprint $table) {
        $table->boolean('offer')->default(false);
    });
}

public function down()
{
    Schema::table('cvs', function (Blueprint $table) {
        $table->dropColumn('offer');
    });
}

};
