<?php

class GroupTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('groups')->truncate();

		 Sentry::createGroup(array(
			'name'        => 'Writer',
			'permissions' => array(
				'write' => 1,
				'view' => 1,
			),
		));
	}

}
