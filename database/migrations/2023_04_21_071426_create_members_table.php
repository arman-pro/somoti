<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->date('join_date');
            $table->char('member_no', 6)->index();
            $table->char('account', 10)->index();
            $table->string("name", 50);
            $table->string("mobile", 15)->nullable();
            $table->foreignId('group_id')->constrained()->cascade('onUpdate')->cascade('onDelete');
            $table->json("extra_info")->default(json_encode([]));
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
        Schema::dropIfExists('members');
    }
}
