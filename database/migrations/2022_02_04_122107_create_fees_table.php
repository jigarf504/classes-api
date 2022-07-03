<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StudentRegistration::class, 'student_id');
            $table->foreignIdFor(\App\Models\Branch::class, 'branch_id');
            $table->decimal('total_amount', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('gst', 8, 2);
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('student_registrations');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
