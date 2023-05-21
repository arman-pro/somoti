<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharepurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->char('vouchar_no', 8)->index();
            $table->enum('share_type', ['sale', 'purchase'])->default('purchase');
            $table->date('date');
            $table->double('amount');
            $table->foreignId('member_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('sharepurchases');
    }
}
