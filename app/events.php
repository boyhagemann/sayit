<?php

$parsedown = new Parsedown();

Article::creating(function(Article $article) use ($parsedown) {

	Input::merge(array('user' => 'boy@swis.nl'));

	$user = UserRepository::fromInput();

	$article->user_id 	= $user->id;
	$article->html 		= Input::get('html') ? Input::get('html') : $parsedown->parse($article->markdown);

	if(!$article->access) {
		$article->access = 'public';
	}

	if(!$article->teaser) {
		$article->teaser = ArticleRepository::generateTeaser($article->markdown);
	}

});

Article::updating(function(Article $article) use ($parsedown) {

	$article->html 		= Input::get('html') ? Input::get('html') : $parsedown->parse($article->markdown);

});