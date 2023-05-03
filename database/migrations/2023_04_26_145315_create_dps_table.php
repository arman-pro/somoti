<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dps', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('member_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('dpstype_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->char('account', 10)->index();
            $table->double('amount_per_installment', 8, 2);
            $table->integer('number_of_installment');
            $table->date('start_date');
            $table->date('expire_date');
            $table->double('fine_missing_dps', 8, 2);
            $table->double('profit', 8, 2);
            $table->double('total_amount', 8, 2);
            $table->boolean('is_matured')->default(false);
            $table->mediumText('comment')->nullable();
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
        Schema::dropIfExists('dps');
    }
}
