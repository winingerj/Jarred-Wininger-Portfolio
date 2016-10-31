<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProviderResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_resource', function (Blueprint $table) {
            $table->increments('id');           //id INTEGER,
            $table->integer('provider_id');
            $table->integer('resource_id');
            $table->integer('contact_id');
        });
    
        DB::table('provider_resource')->insert([
            'provider_id' => '1',
            'resource_id' => '1',
            'contact_id' => '1',
        ]);

        DB::table('provider_resource')->insert([
            'provider_id' => '2',
            'resource_id' => '3',
            'contact_id' => '2',
        ]);
        DB::table('provider_resource')->insert([
            'provider_id' => '3',
            'resource_id' => '1',
            'contact_id' => '3',
        ]);
        DB::table('provider_resource')->insert([
            'provider_id' => '3',
            'resource_id' => '4',
            'contact_id' => '4',
        ]);
        DB::table('provider_resource')->insert([
            'provider_id' => '4',
            'resource_id' => '5',
            'contact_id' => '5',
        ]);
        DB::table('provider_resource')->insert([
            'provider_id' => '5',
            'resource_id' => '1',
        ]);
        DB::table('provider_resource')->insert([
            'provider_id' => '5',
            'resource_id' => '6',
        ]);
        DB::table('provider_resource')->insert([
            'provider_id' => '6',
            'resource_id' => '7',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provider_resource');
    }
}
