<?php

use Michelf\MarkdownExtra;

Article::creating(function(Article $article) {

	Input::merge(array('user' => 'boy@swis.nl'));

	$user = UserRepository::fromInput();
	$article->user_id 	= $user->id;
	$article->html 		= MarkdownExtra::defaultTransform($article->markdown);

});