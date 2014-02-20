<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('user.index');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return View::make('user.dashboard');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function register()
	{
		$fb = App::make('formbuilder');
		$fb->route('user.store');
		$fb->text('email')->label('E-mail address');
		$fb->password('password')->label('Choose a password');
		$fb->text('username')->label('Choose a username');
		$form = $fb->build();

        return View::make('user.register', compact('form'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
			$user = Sentry::register(array(
				'email'    => Input::get('email'),
				'password' => Input::get('password'),
			));

			// Let's get the activation code
			$activationCode = $user->getActivationCode();

			// Send activation code to the user so he can activate the account


			return Redirect::route('user.unconfirmed');

		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			$error = 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			$error = 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$error = 'User with this login already exists.';
		}

		if($error) {
			return Redirect::route('user.register')->withError($error);
		}
	}


	public function unconfirmed()
	{
		return View::make('user.unconfirmed');
	}

	public function confirm($email, $token)
	{
		try
		{
			// Find the user using the user id
			$user = Sentry::findUserByCredentials(array(
				'email' => $email
			));

			// Attempt to activate the user
			if ($user->attemptActivation($token))
			{
				Sentry::login($user, false);

				return Redirect::route('user.dashboard')->withSuccess('User verified');
			}
			else
			{
				return Redirect::route('user.unconfirmed')->withError('Incorrect token used');
			}

		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::route('user.register')->withError('User not found');
		}
		catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
			return Redirect::route('user.register')->withError('User is already activated');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('user.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit()
	{
		$fb = App::make('formbuilder');
		$fb->route('user.update');
		$fb->method('put');
		$fb->model(Sentry::getUser());
		$fb->text('email')->label('E-mail address');
		$fb->password('password')->label('Choose a password');
		$fb->text('username')->label('Choose a username');
		$form = $fb->build();

        return View::make('user.edit', compact('form'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update()
	{
		try
		{
			// Find the user using the user id
			$user = Sentry::getUser();

			// Update the user details
			$user->email 	= Input::get('email');
			$user->username = Input::get('username');

			// Update the user
			if ($user->save())
			{
				return Redirect::route('user.edit')->withSuccess('Profile updated');
			}
			else
			{
				return Redirect::route('user.edit')->withError('Profile could not be updated');
			}
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			return Redirect::route('user.edit')->withError('Profile with this login already exists');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::route('user.edit')->withError('User was not found');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
