<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdrs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('member_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('fdrtype_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->char('account', 10)->index();
            $table->date('start_date');
            $table->date('expire_date');
            $table->double('fdr_amount', 8, 2);
            $table->double('return_interest', 8, 2);
            $table->foreignId('refer_member');
            $table->foreignId('refer_user');
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
        Schema::dropIfExists('fdrs');
    }
}
