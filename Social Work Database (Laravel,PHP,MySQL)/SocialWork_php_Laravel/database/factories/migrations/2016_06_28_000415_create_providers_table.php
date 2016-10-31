<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');           //id INTEGER,
            $table->string('name', 100);        //name VARCHAR(100)
            $table->string('street', 70);       //street VARCHAR(70)
            $table->string('city', 40);         //city VARCHAR(40)
            $table->string('county', 40);       //county VARCHAR(40)
            $table->string('zip', 5);           //zip VARCHAR(5)
            $table->string('state', 2);         //state VARCHAR(2)
            $table->string('phone', 8);         //phone VARCHAR(8)
            $table->string('email', 40);        //email VARCHAR(40)
            $table->string('web', 100);         //web VARCHAR(100)
            $table->string('contact_f_name', 30);      //contact_f_name VARCHAR(30)
            $table->string('contact_l_name', 30);      //contact_l_name VARCHAR(30)
            $table->string('location', 40);     //location_constraint VARCHAR(40)
            $table->string('population', 100);  //population_constraint VARCHAR(100)
            $table->string('office_hours', 12); //office_hours VARCHAR(12)
            $table->boolean('flag_archived');               //flag BOOLEAN
            $table->boolean('flag_out_of_date');            //flag BOOLEAN
            $table->binary('flag_out_of_date_comment');     //flag_comment BLOB
            $table->binary('description');      //description BLOB
            $table->string('intake', 50);       //intake VARCHAR(50)??
            $table->decimal('feed');            //feed DECIMAL
            $table->timestamps();
        });

        DB::table('providers')->insert([
            'name' => 'St. Mary\'s',
            'street' => '2300 East Stone Dr',
            'city' => 'Kingsport',
            'county' => 'Sullivan',
            'zip' => '75660',
            'state' => 'TN',
            'phone' => '4238618312',
            'email' => 'contact@willGiveUMoney.com',
            'web' => 'http://willGiveUMoney.com',
            'contact_f_name' => '',
            'contact_l_name' => '',
            'location' => 'Uptown Kingsport',
            'population' => 'At risk youth and homosexual pets.',
            'office_hours' => 'Mon - Fri 9 am - 9 pm',
            'flag_archived' => 'false',
            'flag_out_of_date' => 'true',
            'flag_out_of_date_comment' => '',
            'description' => 'Somewhat helpful',
            'intake' => '',
            'feed' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

        DB::table('providers')->insert([
            'name' => 'Unicef',
            'street' => '816 like, I-81 or something. I don\'t know Bristol',
            'city' => 'Bristol',
            'county' => 'Sullivan',
            'zip' => '37999',
            'state' => 'TN',
            'phone' => '4235555555',
            'email' => 'help@Cash4You.com',
            'web' => 'http://Cash4You.com',
            'contact_f_name' => '',
            'contact_l_name' => '',
            'location' => 'Sullivan County',
            'population' => 'Unwed teenage mothers with 3 or 5 children, widows with 2 or 6 childrem ages 4-12',
            'office_hours' => '2 days a month, generally within a fortnight of the full moon',
            'flag_archived' => 'false',
            'flag_out_of_date' => 'false',
            'flag_out_of_date_comment' => '',
            'description' => 'helpful',
            'intake' => '',
            'feed' => '',public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

        DB::table('providers')->insert([
            'name' => 'Tots without Yachts',
            'street' => '23 North Roan St',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'zip' => '75601',
            'state' => 'TN',
            'phone' => '4238334582',
            'email' => 'help@weHelp.com',
            'web' => 'http://weHelp.com',
            'contact_f_name' => 'Bob',
            'contact_l_name' => 'Jenkins',
            'location' => 'Washington County, Sullivan County, Greene County, Carter County, Johnson County, Bristol, VA',
            'population' => 'Everyone except Sagittarius. Bunch of jerks.',
            'office_hours' => '24/7',
            'flag_archived' => 'true',
            'flag_out_of_date' => 'false',
            'flag_out_of_date_comment' => '',
            'description' => 'Very helpful',
            'intake' => '',
            'feed' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('providers');
    }
}