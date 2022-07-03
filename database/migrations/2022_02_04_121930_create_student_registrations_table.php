<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Branch::class, 'branch_id');
            $table->string('register_code', 20)->comment('Branchcode + year + 0001');
            $table->string('first_name', 125);
            $table->string('last_name', 125);
            $table->string('email', 60);
            $table->string('mobile', 15);
            $table->string('residence_no', 15)->nullable();
            $table->date('birth_date');
            $table->string('gender', 1)->default('M')->comment('M,F');
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('student_registrations');
    }
}
