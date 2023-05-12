<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->char('mobile', 15)->index();
            $table->double('amount', 8, 2);
            $table->double('interest', 8, 2);
            $table->double('total_amount_payable', 8, 2);
            $table->double('installment_amount', 8, 2);
            $table->integer('installment_number');
            $table->double('insurence_amount', 8, 2);
            $table->double('loan_fee', 8, 2);
            $table->date('loan_start_date');
            $table->date('loan_end_date');
            $table->foreignId('loantype_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('member_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('refer_user_id')->index()->nullable();
            $table->foreignId('refer_member_id')->index()->nullable();
            $table->json('extra_info')->default('[]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
