<?php

class Controller_Ajaxlogin extends Controller_Rest
{
	public function get_testingajax()
	{
		return $this->response(array(
            'foo' => Input::get('foo'),
            'baz' => array(
                1, 50, 219
            ),
            'empty' => null
        ));
	}
/*
	public function action_register()
	{
		$data = array();
		$data["errors"] = array();

		if ( ! \Config::get('are_new_user_registrations_enabled', false)) {
	        \Response::redirect_back();
	    }

	    if (\Input::method() == 'POST')
	    {
		    $fieldset = \Fieldset::forge();
		    $fieldset->form()->add_csrf();
		    $fieldset->add_model('Model\\Auth_User');
		    $fieldset->add_after('fullname', 'Full Name', array(), array('required'), 'email');

		    //Using email as username
		    $fieldset->disable('username');
		    $fieldset->disable('group_id');

		    $fieldset->field('email')->set_attribute('type', 'email');

		    $fieldset->field('password')->set_attribute('class', 'form-control');
		    $fieldset->field('email')->set_attribute('class', 'form-control');
		    $fieldset->field('fullname')->set_attribute('class', 'form-control');

			$params = Input::post();
			$params['group_id'] = \Config::get('application.user.default_group', 1);
			array_key_exists('email', $params) and $params['username'] = $params['email'];

	        $fieldset->validation()->run($params);

	        if ( ! $fieldset->validation()->error())
	        {
	            try
	            {
	                $created = \Auth::create_user(
	                    $fieldset->validated('email'),//$fieldset->validated('username'),
	                    $fieldset->validated('password'),
	                    $fieldset->validated('email'),
	                    $fieldset->validated('group_id'),
	                    array('fullname' => $fieldset->validated('fullname'))
	                );
	                if ($created)
	                {
	                	\Auth::instance()->login(
	                		$fieldset->validated('username'), 
	                		$fieldset->validated('password')
	                	);
	                    \Response::redirect('accounts');
	                }
	            }
	            catch (\SimpleUserUpdateException $e)
	            {
	                // duplicate email
	                if ($e->getCode() == 2){
	                	array_push($data["errors"], 
	                		array('email', 'email_already_registered', 'This email is already registered, try logging in.')
	                	);
	                }
	                // duplicate username
	                elseif ($e->getCode() == 3) {
	                	array_push($data["errors"], 
	                		array('username', 'username_already_registered', 'This username is already registered, try logging in.')
	                	);
	                }
	                else {

	                    //\Messages::error($e->getMessage());
	                }
	            }
	        }
	        else 
	        {
	        	foreach ($fieldset->error() as $field => $error)
			    {
			    	array_push($data["errors"], 
			    		array($field, 
			    			$error->get_message(':rule'),
			    			$error->get_message()));
	        	}
	        }

	        // validation failed, repopulate form from posted data
	        $fieldset->repopulate();
	    }

	    if ( ! array_key_exists('errors', $data)) {
	    	$data['errors'] = array();
	    }

	    $fieldset->add('submit', '', array('type' => 'submit', 'value' => 'Create account', 'class' => 'btn btn-primary register-form__submit-button'));

		$data["subnav"] = array('register'=> 'active' );
		$this->template->title = 'Create account';
		$this->template->screen_name = Auth::get_profile_fields('fullname', 'Unknown name');
	    $this->template->content = \View::forge('accounts/register', $data)->set('form', $fieldset, false);

		$data["subnav"] = array('register'=> 'active' );
		$this->template->title = 'Ajaxlogin &raquo; Register';
		$this->template->content = View::forge('ajaxlogin/register', $data);
	}

	public function action_login()
	{
		$this->template->screen_name = Auth::get_profile_fields('fullname', 'Unknown name');

	    if (\Auth::check()) {
	        \Response::redirect('accounts');
	    }

	    if (\Input::method() == 'POST')
	    {
	        if (\Auth::instance()->login(\Input::param('username'), \Input::param('password')))
	        {
	            if (\Input::param('remember', false)) {
	                \Auth::remember_me();
	            } else {
	                \Auth::dont_remember_me();
	            }
	            \Response::redirect('accounts');
	        }
	        else {
	        	$data['incorrect_username_or_password'] = true;
	        }
	    }

		$data["subnav"] = array('login'=> 'active' );
		$this->template->title = 'Login';
		$this->template->content = \View::forge('accounts/login', $data);

		$data["subnav"] = array('login'=> 'active' );
		$this->template->title = 'Ajaxlogin &raquo; Login';
		$this->template->content = View::forge('ajaxlogin/login', $data);
	}
*/

}





