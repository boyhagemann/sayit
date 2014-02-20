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

Route::resource('article', 'ArticleController');
Route::resource('channel', 'ChannelController');
Route::resource('api/article', 'Api\ArticleController');


Route::get('/', array(
	'as' => 'home',
	'uses' => 'homeController@index',
));
Route::get('login', array(
	'as' => 'auth.login',
	'uses' => 'authController@login',
));
Route::post('login', array(
	'as' => 'auth.check',
	'uses' => 'authController@check',
));
Route::get('logout', array(
	'as' => 'auth.logout',
	'uses' => 'authController@logout',
));
Route::get('user/unconfirmed', array(
	'as' => 'user.unconfirmed',
	'uses' => 'UserController@unconfirmed',
));
Route::get('user/confirm/{email}/{token}', array(
	'as' => 'user.confirm',
	'uses' => 'UserController@confirm',
));
Route::get('register', array(
	'as' => 'user.register',
	'uses' => 'UserController@register',
));
Route::get('user/profile', array(
	'as' => 'user.edit',
	'uses' => 'UserController@edit',
));
Route::put('user/update', array(
	'as' => 'user.update',
	'uses' => 'UserController@update',
));
Route::get('/dashboard', array(
	'as' => 'user.dashboard',
	'uses' => 'userController@dashboard',
));
Route::resource('user', 'UserController', array('except' => array('update')));


Route::post('article/preview', array('as' => 'article.preview', function() {
	return MarkdownExtra::defaultTransform(Input::get('markdown'));
}));


Route::get('scan', function() {

	$files = scanForMd('../');

	foreach($files as $file) {
		$batch[] = array(
			'title' => basename($file),
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

function scanForMd($folder)
{
    $files = File::glob(rtrim($folder, '/') . '/*.md');
    
    foreach(File::directories($folder) as $subfolder) {
        $files = array_merge($files, scanForMd($subfolder));
    }
    
    return $files;
}



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