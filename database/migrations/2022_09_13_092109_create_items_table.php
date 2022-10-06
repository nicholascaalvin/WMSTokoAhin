<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->string('name');
            $table->foreignId('uom')->constrained('uom');
            $table->string('weight_in_grams');
            $table->foreignId('country_id')->constrained('countries');
            $table->string('description');

            $table->integer('incoming')->defalt(0);
            $table->integer('outgoing')->defalt(0);
            $table->integer('stock')->defalt(0);

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
        Schema::dropIfExists('items');
    }
}
