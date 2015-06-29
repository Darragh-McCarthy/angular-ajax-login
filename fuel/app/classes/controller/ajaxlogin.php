<?php

class Controller_Ajaxlogin extends Controller_Rest
{
	public function get_logout() {
	    \Auth::dont_remember_me();
	    $is_logged_out = \Auth::logout();
	    return $this->response(array(
			'is_logged_out' => $is_logged_out
        ));
	}
	public function post_login()
	{
		//NOT WORKING, returning empty array:
		//$params = \Input::post();
		//NOT WORKING: empty for some reason
		//$is_logged_in = \Auth::instance()->login(\Input::get('username'), \Input::get('password'));

		//not sure if this is a good enough solution but it's a possible workaround
		$post_contents = file_get_contents( 'php://input' );
		$json_parsed_post_contents = json_decode($post_contents);
		$is_logged_in = \Auth::login(
			$json_parsed_post_contents->username, 
			$json_parsed_post_contents->password
		);
        if ($is_logged_in)
        {
            if (\Input::get('remember', false)) {
                \Auth::remember_me();
            } else {
                \Auth::dont_remember_me();
            }
			return $this->response(array(
				'is_logged_in' => true, 
	            'data' => array(
	            	'fullname' => Auth::get_profile_fields('fullname', 'Unknown name')
	            )
	        ));
        }
        else {
        	return $this->response(array(
        		'is_logged_in' => false
        	));
        }		
	}
	public function get_test() {
		return $this->response(array(
			'foo'=>'bar',
			'baz'=>'something'
		));
	}

	public function post_register()
	{
		$errors = array();

	    $fieldset = \Fieldset::forge();
	    $fieldset->add_model('Model\\Auth_User');
	    $fieldset->add_after('fullname', 'Full Name', array(), array('required'), 'email');

	    //Using email as username
	    $fieldset->disable('username');
	    $fieldset->disable('group_id');

	    //handle the post data the same way as in the login handler due to problems accessing \Input::post() contents
	    $post_contents = file_get_contents( 'php://input' );
		$json_params = json_decode($post_contents);

		$params = array();
		$params['email'] = $json_params->email;
		$params['fullname'] = $json_params->fullname;
		$params['password'] = $json_params->password;
		$params['group_id'] = \Config::get('application.user.default_group', 1);
		array_key_exists('email', $params) and $params['username'] = $params['email'];

        $fieldset->validation()->run($params);

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





