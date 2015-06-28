<?php

class Controller_Home extends Controller_Template
{

	public function action_index()
	{
		$this->template->screen_name = Auth::get_profile_fields('fullname', 'Unknown name');
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Home &raquo; Index';
		$this->template->content = View::forge('home/index', $data);
	}

}
