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
            $table->string('population', 250);  //population_constraint VARCHAR(100)
            $table->string('office_hours', 12); //office_hours VARCHAR(12)
            $table->boolean('flag_archived');               //flag BOOLEAN
            $table->boolean('flag_out_of_date');            //flag BOOLEAN
            $table->binary('flag_out_of_date_comment');     //flag_comment BLOB
            $table->binary('description');      //description BLOB
            $table->string('intake', 50);       //intake VARCHAR(50)??
            $table->decimal('feed');            //feed DECIMAL
            $table->timestamps();
            $table->integer('hits');            //hit counter 
        });

        DB::table('providers')->insert([
            'name' => 'St. Mary\'s',
            'street' => '2300 East Stone Dr',
            'city' => 'Kingsport',
            'county' => 'Sullivan',
            'zip' => '75660',
            'state' => 'TN',
            'phone' => '4238618312',
            'email' => 'contact@stymaryskingsport.com',
            'web' => 'www.stymaryskingsport.com',
            'location' => 'Kingsport',
            'population' => 'Any',
            'office_hours' => 'Mon - Fri 10 am - 6 pm',
            'flag_archived' => 0,
            'flag_out_of_date' => 1,
            'flag_out_of_date_comment' => 'The web address does not work.',
            'description' => 'St. Mary\'s provides shelter, meals, and hospitality to victims of sexual assault.',
            'intake' => 'walk in',
            'feed' => 'none for walk in. Meals are $3.',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

        DB::table('providers')->insert([
            'name' => 'Kevin\'s Clothing',
            'street' => '1816 Kingsport Hwy',
            'city' => 'Bristol',
            'county' => 'Sullivan',
            'zip' => '37999',
            'state' => 'TN',
            'phone' => '4235555555',
            'email' => 'help@kevinskingsport.com',
            'web' => 'www.kevinskingsport.com',
            'location' => 'Sullivan County',
            'population' => 'Low or fixed income new clothing line',
            'office_hours' => 'Monday, Wednesday 9AM - 3PM',
            'flag_archived' => 0,
            'flag_out_of_date' => 1,
            'flag_out_of_date_comment' => 'The phone number is no longer in service.',
            'description' => 'Kevin\'s Clothing is low cost closet for fixed income families.',
            'intake' => 'walk in',
            'feed' => 'none',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        DB::table('providers')->insert([
            'name' => 'Haven of Mercy Rescue Mission',
            'street' => '23 North Roan St',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'zip' => '75601',
            'state' => 'TN',
            'phone' => '4238334582',
            'email' => 'help@HavenOfMercyJC.com',
            'web' => 'http://www.HaveOfMercyJC.com',
            'location' => 'Washington County',
            'population' => 'Residents of Washington Co.',
            'office_hours' => '24/7',
            'flag_archived' => 0,
            'flag_out_of_date' => 0,
            'flag_out_of_date_comment' => '',
            'description' => 'Homeless shelter and services for Johnson City',
            'intake' => 'walk in',
            'feed' => 'none',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        DB::table('providers')->insert([
            'name' => 'Interfaith Hospitality',
            'street' => '210 W Fairview Ave',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'zip' => '75601',
            'state' => 'TN',
            'phone' => '4238334582',
            'email' => 'help@ifhjc.com',
            'web' => 'http://www.ifhjc.com',
            'location' => 'Washington County',
            'population' => 'Homleless families with children including domestic violence situation when children are in the family. NO INDIVIDUALS. MARRIED COUPLES WITHOUT CHILDREN ARE ACCEPTED BUT WILL BE PLACED BEHIND FAMILIES WITH CHILDREN ON THE WAITING LIST.',
            'office_hours' => '24/7',
            'flag_archived' => 0,
            'flag_out_of_date' => 0,
            'flag_out_of_date_comment' => '',
            'description' => 'Shelter and food for homeless families with children ONLY! Case management for families to work on goals and objectives while waiting to find housing Provision of all needs while in the program and assistance in moving into housing.',
            'intake' => 'walk in',
            'feed' => 'free',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        DB::table('providers')->insert([
            'name' => 'Salvation Army',
            'street' => '505 Dale Street',
            'city' => 'Kingsport',
            'county' => 'Gray',
            'zip' => '37660',
            'state' => 'TN',
            'phone' => '4238338520',
            'email' => 'help@sa.org',
            'web' => 'http://www.sa.org',
            'location' => 'none',
            'population' => '',
            'office_hours' => 'Shelter is open 24/7',
            'flag_archived' => 0,
            'flag_out_of_date' => 0,
            'flag_out_of_date_comment' => '',
            'description' => 'The Salvation Army of Greater Kingsport offers a long-term program to the needy who want to help themselves This is called the Solid Rock program Solid Rock allows the individual to stay in the shelter at no cost, receiving three meals a day.',
            'intake' => 'walk in',
            'feed' => 'free',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        DB::table('providers')->insert([
            'name' => 'Estate auction in remembrance of Steve Gully.',
            'street' => '230 Seabrook Ln.',
            'city' => 'Johnson City',
            'county' => 'Washington',
            'zip' => '75601',
            'state' => 'TN',
            'phone' => '4237785461',
            'email' => 'janice@realtorsJC.com',
            'web' => 'http://www.realtorsJC.com',
            'location' => 'Washington county residents only.',
            'population' => 'none',
            'office_hours' => '24/7',
            'flag_archived' => 1,
            'flag_out_of_date' => 0,
            'flag_out_of_date_comment' => '',
            'description' => 'Homeless shelter and services for Johnson City',
            'intake' => 'register online',
            'feed' => 'none',
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
