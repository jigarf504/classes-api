<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Inquiry::class,'inquiry_id');
            $table->foreignIdFor(\App\Models\Course::class,'course_id');

            $table->foreign('inquiry_id')->references('id')->on('inquiries');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry_courses');
    }
}
