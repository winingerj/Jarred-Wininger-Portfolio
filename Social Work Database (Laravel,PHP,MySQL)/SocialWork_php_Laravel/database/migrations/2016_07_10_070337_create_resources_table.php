<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');           //id INTEGER,
            $table->string('type', 100);        //type VARCHAR(100)
            $table->string('subtype', 100);     //subtype VARCHAR(100)
            $table->string('description', 100); //description VARCHAR(10)
            $table->integer('hits');            //count the number of hits for the table
            $table->timestamps();

        });

        DB::table('resources')->insert([
            'type' => 'Food',
            'subtype' => 'Food Bank',
            'description' => 'A food bank gives out food'
        ]);
        DB::table('resources')->insert([
            'type' => 'Food',
            'subtype' => 'Bake Sale',
            'description' => 'There will be pastries and live music by Skrillex'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('resources');

    }
}