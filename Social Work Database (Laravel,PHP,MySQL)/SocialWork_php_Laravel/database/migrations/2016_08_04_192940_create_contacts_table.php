<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
	    $table->string('contact_f_name', 30);      //contact_f_name VARCHAR(30)
            $table->string('contact_l_name', 30);      //contact_l_name VARCHAR(30)
            $table->string('phone', 18);         //phone VARCHAR(18) //ex. 18001234567ext890
            $table->timestamps();
        });

DB::table('contacts')->insert([
            'contact_f_name' => 'John',
            'contact_l_name' => 'Doe',
            'phone' => '5555554567',
        ]);
DB::table('contacts')->insert([
            'contact_f_name' => 'Jane',
            'contact_l_name' => 'Doe',
            'phone' => '5555558524',
        ]);
DB::table('contacts')->insert([
            'contact_f_name' => 'Jim',
            'contact_l_name' => 'McCurry',
            'phone' => '5555559758',
        ]);
DB::table('contacts')->insert([
            'contact_f_name' => 'Bill',
            'contact_l_name' => 'Smith',
            'phone' => '5555554561',
        ]);
DB::table('contacts')->insert([
            'contact_f_name' => 'Bob',
            'contact_l_name' => 'Bakers',
            'phone' => '5555554668',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }
}
