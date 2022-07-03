<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Branch::class,'branch_id')->after('id');
            $table->foreignIdFor(\App\Models\Document::class,'photo_id')->after('branch_id');

            $table->foreign('branch_id')->references('id')->on('Branches');
            $table->foreign('photo_id')->references('id')->on('Documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['photo_id']);
            $table->dropColumn(['branch_id']);
            $table->dropColumn(['photo_id']);
        });
    }
}
