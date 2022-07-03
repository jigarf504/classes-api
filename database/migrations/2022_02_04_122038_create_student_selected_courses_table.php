<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSelectedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_selected_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StudentRegistration::class,'student_id');
            $table->foreignIdFor(\App\Models\Course::class,'course_id');
            $table->string('course_name')->nullable();
            $table->decimal('fullpay', 8, 2);
            $table->decimal('installment_pay', 8, 2);
            $table->tinyInteger('is_completed')->default(0);
            $table->timestamp('completed_at');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('student_registrations');
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
        Schema::dropIfExists('student_selected_courses');
    }
}
