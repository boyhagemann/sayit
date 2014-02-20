<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		Sentry::createUser(array(
			'email'     => 'test@test.nl',
			'password'  => 'boyhagemann',
			'username' 	=> 'admin',
			'activated' => true,
		));
	}

}
