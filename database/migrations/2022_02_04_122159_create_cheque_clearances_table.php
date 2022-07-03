<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChequeClearancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheque_clearances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StudentRegistration::class, 'student_id');
            $table->foreignIdFor(\App\Models\Branch::class, 'branch_id');
            $table->string('bank_name');
            $table->string('branch');
            $table->string('cheque_no');
            $table->decimal('amount', 8, 2);
            $table->date('cheque_date');
            $table->timestamp('is_cleared');

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
        Schema::dropIfExists('cheque_clearances');
    }
}
