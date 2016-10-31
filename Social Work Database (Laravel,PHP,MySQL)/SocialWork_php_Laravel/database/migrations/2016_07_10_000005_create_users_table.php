<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
            $table->rememberToken();
            $table->timestamps();
        });
    
        DB::table('users')->insert([
            'name' => 'Tony Stark',
            'email' => 'ironman@socialwork.com',
            'password' => '$2y$10$wOzsEp8QQNUc/lru8xZyne7YL9M9TzYAm.gvRRGqy9xL7FuC.WFL2',
			'role' => 5,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

    DB::table('users')->insert([
            'name' => 'Steve Rogers',
            'email' => 'cap@socialwork.com',
            'password' => '$2y$10$wOzsEp8QQNUc/lru8xZyne7YL9M9TzYAm.gvRRGqy9xL7FuC.WFL2',
			'role' => 4,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

    DB::table('users')->insert([
            'name' => 'Bruce Banner',
            'email' => 'hulk@socialwork.com',
            'password' => '$2y$10$wOzsEp8QQNUc/lru8xZyne7YL9M9TzYAm.gvRRGqy9xL7FuC.WFL2',
			'role' => 3,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

    DB::table('users')->insert([
            'name' => 'Peter Parker',
            'email' => 'spidey@socialwork.com',
            'password' => '$2y$10$wOzsEp8QQNUc/lru8xZyne7YL9M9TzYAm.gvRRGqy9xL7FuC.WFL2',
			'role' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);

    DB::table('users')->insert([
            'name' => 'Wade Winston Wilson',
            'email' => 'deadpool@socialwork.com',
            'password' => '$2y$10$wOzsEp8QQNUc/lru8xZyne7YL9M9TzYAm.gvRRGqy9xL7FuC.WFL2',
			'role' => 1,
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
        Schema::drop('users');
    }
}
