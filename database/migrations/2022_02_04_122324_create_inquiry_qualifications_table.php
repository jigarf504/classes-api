<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Inquiry::class,'inquiry_id');
            $table->foreignIdFor(\App\Models\Qualification::class,'qualification_id');

            $table->foreign('inquiry_id')->references('id')->on('inquiries');
            $table->foreign('qualification_id')->references('id')->on('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry_qualifications');
    }
}
