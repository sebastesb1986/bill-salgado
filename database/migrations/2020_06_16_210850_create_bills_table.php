<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {

            // Rows table bills
            $table->id();
            $table->string('name', 150);
            $table->string('lastname', 150);
            $table->string('document', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('address', 70)->nullable();
            $table->string('city', 150);
            $table->string('store', 150);
            $table->string('article', 150);
            $table->integer('quantity');
            $table->decimal('price', 11, 2);
            $table->decimal('tax', 4, 2)->nullable();
            $table->decimal('total', 15, 2);

            $table->softDeletes();
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
        Schema::dropIfExists('bills');
    }
}
