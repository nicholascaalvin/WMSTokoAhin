<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings_detail', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('incomings_id')->constrained('incomings');
            $table->foreignId('item_id')->constrained('items');
            $table->integer('qty');

            $table->foreignId('company_id')->constrained('companies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomings_detail');
    }
}
