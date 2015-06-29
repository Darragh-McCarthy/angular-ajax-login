<?php

class Controller_Home extends Controller_Template
{
	public $template = 'angular-template';

	public function action_index()
	{
		$this->template->screen_name = Auth::get_profile_fields('fullname', 'Unknown');
		$this->template->is_user_logged_in = Auth::check();
		$this->template->title = 'Simple AJAX login with AngularJS and FuelPHP';
	}

}
