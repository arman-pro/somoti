<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->morphs('installmentable');
            $table->date('date');
            $table->double('amount', 8, 2);   
            $table->date('paid_date')->nullable();        
            $table->double('paid_amount', 8, 2)->nullable();            
            $table->foreignId('received_by')->nullable()->index();
            $table->boolean('is_paid')->default(false);
            $table->tinyText('note')->nullable();
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
        Schema::dropIfExists('installments');
    }
}
