<?php

class AuthController extends BaseController {

	public function login()
	{
		$fb = App::make('formbuilder');
		$fb->text('email')->label('E-mail address')->required();
		$fb->password('password')->label('Password')->required();
		$form = $fb->build();

		return View::make('auth.login', compact('form'));
	}

	public function check()
	{
		try
		{
			// Set login credentials
			$credentials = array(
				'email'    => Input::get('email'),
				'password' => Input::get('password'),
			);

			// Try to authenticate the user
			$user = Sentry::authenticate($credentials, false);

			// Login
			Sentry::login($user, false);

			return Redirect::route('user.dashboard')->withSuccess('You are now logged in');
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			$error = 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			$error = 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
			$error = 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$error = 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			$error = 'User is not activated.';
		}

// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			$error = 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			$error = 'User is banned.';
		}

		if($error) {
			return Redirect::route('auth.login')->withError($error);
		}

	}

	public function logout()
	{
		Sentry::logout();

		return Redirect::route('home');
	}

}
