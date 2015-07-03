<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateOrganisationsTable
 */
class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     * TODO: has many addresses, has many emails, has many images
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('Charity');
            $table->string('legal_name');
            $table->string('other_name')->nullable();
            $table->bigInteger('abn');
//            $table->date('registration_date');
//            $table->date('established_date')->nullable();
            $table->string('size')->nullable();
            $table->integer('num_responsible_persons')->nullable();
//            $table->date('financial_year_end');
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
        Schema::drop('organisations');
    }
}
