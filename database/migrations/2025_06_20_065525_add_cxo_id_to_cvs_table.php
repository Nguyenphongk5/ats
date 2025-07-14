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
    Schema::table('cvs', function (Blueprint $table) {
        $table->unsignedBigInteger('cxo_id')->nullable()->after('job_id');
        $table->foreign('cxo_id')->references('id')->on('cxos')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('cvs', function (Blueprint $table) {
        $table->dropForeign(['cxo_id']);
        $table->dropColumn('cxo_id');
    });
}

};
