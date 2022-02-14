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
            $table->unsignedBigInteger('user_id');
            $table->string('code');
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('term');
            $table->tinyInteger('is_month');
            $table->tinyInteger('is_approved')->default(0)->comment('0: pending, 1: approved');
            $table->tinyInteger('is_emi_completed')->default(0)->comment('0: pending, 1: completed');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
