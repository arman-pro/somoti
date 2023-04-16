<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 125)->nullable();
            $table->string('facebook', 125)->nullable();
            $table->string('phone', 125)->nullable();
            $table->string("email", 125)->nullable();
            $table->char("timezone", 30)->nullable();
            $table->text("address")->nullable();
            $table->boolean("is_maitanence_mood")->default(false);
            $table->char("currency", 10)->default('BDT');
            $table->boolean("active_sms")->default(false);

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
        Schema::dropIfExists('settings');
    }
}
