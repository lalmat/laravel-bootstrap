<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('users')->insert([
            'name'              => 'Administrator',
            'password'          => Hash::make('laravel'),
            'email'             => 'admin@example.com',
            'email_verified_at' => $now,
            'created_at'        => $now,
            'updated_at'        => $now,
            'administrator'     => true,
            'active'            => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DELETE FROM users WHERE email='admin@example.com'");
    }
}
