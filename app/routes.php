<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Michelf\MarkdownExtra;

Route::bind('article', function($slug) {

	return is_numeric($slug)
	? ArticleRepository::findById($slug)
	: ArticleRepository::findBySlug($slug);
});


Route::resource('channel', 'ChannelController');
Route::resource('api/article', 'Api\ArticleController');


Route::get('/', array(
	'as' => 'home',
	'uses' => 'homeController@index',
));


Route::group(array('before' => 'auth'), function()
{
	Route::resource('article', 'ArticleController', array('except' => array('show')));
});
Route::get('article/{article}', array(
	'as' => 'article.show',
	'uses' => 'ArticleController@show',
));



Route::group(array('before' => 'guest'), function()
{

	Route::get('login', array(
		'as' => 'auth.login',
		'before' => 'guest',
		'uses' => 'authController@login',
	));
	Route::post('login', array(
		'as' => 'auth.check',
		'before' => 'guest',
		'uses' => 'authController@check',
	));
	Route::get('user/unconfirmed', array(
		'as' => 'user.unconfirmed',
		'before' => 'guest',
		'uses' => 'UserController@unconfirmed',
	));
	Route::get('user/confirm/{email}/{token}', array(
		'as' => 'user.confirm',
		'before' => 'guest',
		'uses' => 'UserController@confirm',
	));
	Route::get('register', array(
		'as' => 'user.register',
		'before' => 'guest',
		'uses' => 'UserController@register',
	));

});


Route::group(array('before' => 'auth'), function()
{

	Route::get('logout', array(
		'as' => 'auth.logout',
		'before' => 'auth',
		'uses' => 'authController@logout',
	));
	Route::get('user/profile', array(
		'as' => 'user.edit',
		'before' => 'auth',
		'uses' => 'UserController@edit',
	));
	Route::put('user/update', array(
		'as' => 'user.update',
		'before' => 'auth',
		'uses' => 'UserController@update',
	));
	Route::get('/dashboard', array(
		'as' => 'user.dashboard',
		'before' => 'auth',
		'uses' => 'userController@dashboard',
	));

	Route::resource('user', 'UserController', array('only' => array('store')));

});




Route::post('article/preview', array('as' => 'article.preview', function() {
	return MarkdownExtra::defaultTransform(Input::get('markdown'));
}));


Route::get('scan', function() {

	$scanner = new Scanner();
	$scanner->ignoreFolder('vendor');
	$files = $scanner->scanForMd('C:\Users\boy\Workspace\bronovo');

	foreach($files as $file) {

		$title = basename($file);
		$title = str_replace('.md', '', $title);
		$title = Str::slug($title, ' ');
		$title = ucfirst($title);

		$batch[] = array(
			'title' => $title,
			'markdown' => file_get_contents($file),
			'key' => md5($file),
            'metadata' => array(
                'location' => $file,
            )
		);
	}

    $response = API::post('http://localhost/sayit/public/api/article', compact('batch'));
    
    dd($response);
});



/*
Route::get('apitest/list-article', function() {
	return View::make('article.index', API::get('http://localhost/sayit/public/api/article?with=user'));
});

Route::get('apitest/view-article/{slug}', function($slug) {
	return API::get('http://localhost/sayit/public/api/article/' . $slug . '?' . http_build_query(Input::all()));
});

Route::get('apitest/create-article', function() {

	$fb = App::make('formbuilder');
	$fb->url('apitest/store-article');
	$fb->method('post');
	$fb->text('title');
	$fb->text('key');
	$fb->textarea('markdown');
	$fb->defaults(Input::old());
	$fb->errors(Session::get('errors'));

	return $fb->build();
});

Route::post('apitest/store-article', function() {

	$response = API::post('http://localhost/sayit/public/api/article', Input::all() );

	if(isset($response['errors'])) {
		return Redirect::to('apitest/create-article')->withErrors($response['errors']);
	}

	return Redirect::to('apitest/view-article/' . $response['article']['slug']);

});
*/