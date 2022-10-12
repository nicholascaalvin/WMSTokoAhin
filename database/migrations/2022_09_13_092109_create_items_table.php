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
            $table->string('name');
            $table->foreignId('brand_id')->constrained('brands');
            $table->foreignId('uom_id')->constrained('uoms');
            $table->string('weight');
            $table->foreignId('country_id')->constrained('countries');
            $table->string('description')->nullable();

            $table->integer('incoming')->default(0);
            $table->integer('outgoing')->default(0);
            $table->integer('stock')->default(0);

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
