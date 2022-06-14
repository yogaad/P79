<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accountId');
            $table->foreign('accountId')->references('id')->on('accounts')->onDelete('cascade');
            $table->datetime('transactionDate');
            $table->unsignedBigInteger('description');
            $table->foreign('description')->references('id')->on('descs')->onDelete('cascade');
            $table->unsignedBigInteger('debitCreditStatus');   
            $table->foreign('debitCreditStatus')->references('id')->on('debits')->onDelete('cascade'); 
            $table->decimal('amount');    
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
        Schema::dropIfExists('transactions');
    }
}
