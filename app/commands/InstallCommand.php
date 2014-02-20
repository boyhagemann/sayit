<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'sayit:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Do all install things';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->call('config:publish', array('package' => 'lucadegasperi/oauth2-server-laravel'));
		$this->call('migrate', array('--package' => 'lucadegasperi/oauth2-server-laravel'));

		$this->call('config:publish', array('package' => 'cartalyst/sentry'));
		$this->call('migrate', array('--package' => 'cartalyst/sentry'));

		$this->call('migrate');
		$this->call('db:seed');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
