<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Fees::class,'fees_id');
            $table->decimal('installment_amount', 8, 2);
            $table->decimal('actual_amount', 8, 2);
            $table->date('payment_date');
            $table->string('receipt_no',60);
            $table->decimal('collect_fees', 8, 2);
            $table->unsignedInteger('cheque_id');
            $table->tinyInteger('refund')->default(0);
            $table->timestamps();

            $table->foreign('fees_id')->references('id')->on('fees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees_installments');
    }
}
