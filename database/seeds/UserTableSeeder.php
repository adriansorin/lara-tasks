<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {
	
	public function run()
    {
        DB::table('users')->delete();

        $usr = new User([
			'username'   => 'admin',
			'first_name' => 'admin',
			'last_name'  => 'admin',
			'password'   => bcrypt('admin'),
			'is_admin'   => 1
        ]);

        $usr->save();
    }
}