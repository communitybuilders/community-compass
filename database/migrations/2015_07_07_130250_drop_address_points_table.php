<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAddressPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('address_points');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('address_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('addresses')
                ->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE address_points ADD COLUMN geopoint POINT");
    }
}
