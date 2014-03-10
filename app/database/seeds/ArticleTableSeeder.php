<?php

class ArticleTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('article')->truncate();

//		Article::create(array(
//			'title' => 'Test article',
//			'key' => md5('testkey'),
//			'teaser' => 'Teaser text',
//			'markdown' => '## test header',
//			'user_id' => 1,
//			'channel_id' => 1,
//			'access' => 'public',
//		));
	}

}
