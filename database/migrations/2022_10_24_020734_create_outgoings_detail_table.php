<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoingsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoings_detail', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('outgoings_id')->constrained('outgoings');
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
        Schema::dropIfExists('outgoings_detail');
    }
}
