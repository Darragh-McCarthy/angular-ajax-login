<?php
/* KEEP CODE CLEAN */

class Controller_Ajaxlogin extends Controller_Rest
{
	public function get_logout()
	{
		\Auth::dont_remember_me();
		
		$is_logged_out = \Auth::logout();
		
		return $this->response(array(
			'is_logged_out' => $is_logged_out
        	));
	}
	
	public function post_login()
	{		
		$username = \Input::json("username");
		$password = \Input::json("password");
		$remember_me = \Input::json("remember", false);

		$is_logged_in = \Auth::login(
			$username, 
			$password
		);
		
		if ($is_logged_in)
		{
			if ($remember_me)
			{
				\Auth::remember_me();
			}
			else
			{
				\Auth::dont_remember_me();
			}
		
			return $this->response(array(
				'is_logged_in' => true, 
				'data' => array(
		            		'fullname' => Auth::get_profile_fields('fullname', 'Unknown name')
		            	)
		        ));
	    }
        else
        {
        	return $this->response(array(
        		'is_logged_in' => false
        	));
        }		
	}

	public function post_register()
	{
	    $fieldset = \Fieldset::forge();
	    $fieldset->add_model('Model\\Auth_User');
	    $fieldset->add_after('fullname', 'Full Name', array(), array('required'), 'email');

		$params = array();
		$params['username'] = \Input::json("username");
		$params['email']    = \Input::json("username");
		$params['password'] = \Input::json("password");
		$params['fullname'] = \Input::json("fullname");
		$params['group_id'] = \Config::get('application.user.default_group', 1);

        $fieldset->validation()->run($params);

		$errors = array();

        if ( ! $fieldset->validation()->error())
        {
            try
            {
                $created = \Auth::create_user(
                    $fieldset->validated('email'),
                    $fieldset->validated('password'),
                    $fieldset->validated('email'),
                    $fieldset->validated('group_id'),
                    array('fullname' => $fieldset->validated('fullname'))
                );
                if ($created)
                {
                	\Auth::login(
                		$fieldset->validated('username'), 
                		$fieldset->validated('password')
                	);
                	return $this->response(array(
						'is_account_creation_success' => true
					));
                }
            }
            catch (\SimpleUserUpdateException $e)
            {
                if ($e->getCode() == 2){
                	array_push($errors, 'This email is already registered, try logging in.');
                }
                elseif ($e->getCode() == 3) {
                	array_push($errors, 'This username is already registered, try logging in.');
                }
                else {
                	array_push($errors, $e->getMessage());
                }
            }
        }
        else 
        {
        	foreach ($fieldset->error() as $field => $error)
		    {
		    	array_push($errors, 
		    		$error->get_message()
		    	);
        	}
        }
        return $this->response(array(
			'is_account_creation_success' => false,
			'errors' => $errors
		));

	}


}





