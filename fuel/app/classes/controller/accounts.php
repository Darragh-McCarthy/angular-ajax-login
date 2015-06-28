<?php

class Controller_Accounts extends Controller_Template
{

	public function action_index() 
	{
		$this->template->screen_name = Auth::get_profile_fields('fullname', 'Unknown name');
		//Debug::dump('hello');

		$data["subnav"] = array();
		$this->template->title = 'Accounts';
		$this->template->content = \View::forge('accounts/default', $data);

	}
	public function action_delete()
	{
		try {
			Auth::delete_user(Input::post('username'));
		}
		catch (SimpleUserUpdateException $e) {
			Debug::dump($e);
		}
		\Response::redirect('accounts');
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
	    }

		$data["subnav"] = array('login'=> 'active' );
		$this->template->title = 'Accounts &raquo; Login';
		$this->template->content = \View::forge('accounts/login', $data);
	}

	public function action_register()
	{
	    if ( ! \Config::get('are_new_user_registrations_enabled', false)) {
	        \Response::redirect_back();
	    }

		$data = array();
		$data["errors"] = array();

	    $fieldset = \Fieldset::forge();
	    $fieldset->form()->add_csrf();
	    $fieldset->add_model('Model\\Auth_User');
	    $fieldset->add_after('fullname', 'Full Name', array(), array('required'), 'email');

	    //Using email as username
	    $fieldset->disable('username');

	    //group_id shouldn't appear on the form
	    $fieldset->disable('group_id');
	    $fieldset->field('group_id')
	    	->delete_rule('required')
	    	->delete_rule('is_numeric');

	    if (\Input::method() == 'POST')
	    {
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
	        else {
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

	    $fieldset->add('submit', '', array('type' => 'submit', 'value' => 'Add', 'class' => 'btn medium primary'));

		$data["subnav"] = array('register'=> 'active' );
		$this->template->title = 'Accounts &raquo; Register';
		$this->template->screen_name = Auth::get_profile_fields('fullname', 'Unknown name');
	    $this->template->content = \View::forge('accounts/register', $data)->set('form', $fieldset, false);
	}

	public function action_logout()
	{
	    \Auth::dont_remember_me();
	    \Auth::logout();
	    //\Messages::success(__('login.logged-out'));

	    // and go back to where you came from (or the application
	    // homepage if no previous page can be determined)
	    //\Response::redirect('accounts');
	    \Response::redirect('accounts/login');


		//$data["subnav"] = array('logout'=> 'active' );
		//$this->template->title = 'Accounts &raquo; Logout';
		//$this->template->content = View::forge('accounts/logout', $data);
	}

	public function action_passwordrecovery($hash = null)
	{
	    if (\Input::method() == 'POST')
	    {
	        if ($email = \Input::post('email'))
	        {
	            if ($user = \Model\Auth_User::find_by_email($email))
	            {
	                // generate a recovery hash
	                $hash = \Auth::instance()->hash_password(\Str::random()).$user->id;

	                // and store it in the user profile
	                \Auth::update_user(
	                    array(
	                        'lostpassword_hash' => $hash,
	                        'lostpassword_created' => time()
	                    ),
	                    $user->username
	                );

	                // send an email out with a reset link
	                \Package::load('email');
	                $email = \Email::forge();

	                // use a view file to generate the email message
	                /*$email->html_body(
	                    \Theme::instance()->view('login/lostpassword')
	                        ->set('url', \Uri::create('login/lostpassword/' . base64_encode($hash) . '/'), false)
	                        ->set('user', $user, false)
	                        ->render()
	                );*/
					$domain_name = Uri::base(false);
					$password_resovery_hash = base64_encode($hash);
					$email->html_body(
						'<a href="'
						.$domain_name
						.'/accounts/passwordrecovery/'
						.$password_resovery_hash
						.'">Reset your password</a>'
					, false);
	                $email->subject('Harpoon password recovery');
	                $from = \Config::get('customer_service_email_address', array('name'=>'','email'=>''));
	                $email->from($from['from-email'], $from['brand-name']);
	                $email->to($user->email, $user->fullname);

	                try
	                {
	                    $email->send();
	                }
	                catch(\EmailValidationFailedException $e)
	                {
	                    //\Messages::error(__('login.invalid-email-address'));
	                    \Response::redirect_back();
	                }
	                catch(\Exception $e)
	                {
	                    // log the error so an administrator can have a look
	                    logger(\Fuel::L_ERROR, '*** Error sending email ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());

	                    //\Messages::error(__('login.error-sending-email'));
	                    \Response::redirect_back();
	                }
	            }
	        }
	        else
	        {
	            // inform the user and fall through to the form
	            //\Messages::error(__('login.error-missing-email'));
	        }

	        // inform the user an email is on the way (or not ;-))
	        //\Messages::info(__('login.recovery-email-send'));
	        \Response::redirect_back();
	    }
	    elseif ($hash !== null)
	    {
	        $hash = base64_decode($hash);
	        // get the userid from the hash
	        $user = substr($hash, 44);

	        if ($user = \Model\Auth_User::find_by_id($user))
	        {
	            // do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
	            if (isset($user->lostpassword_hash) and $user->lostpassword_hash == $hash and time() - $user->lostpassword_created < 86400)
	            {
	                // invalidate the hash
	                \Auth::update_user(
	                    array(
	                        'lostpassword_hash' => null,
	                        'lostpassword_created' => null
	                    ),
	                    $user->username
	                );

	                // log the user in and go to the profile to change the password
	                if (\Auth::instance()->force_login($user->id))
	                {
	                    //\Messages::info(__('login.password-recovery-accepted'));
	                    \Response::redirect('profile');
	                }
	            }
	        }
	        //\Messages::error(__('login.recovery-hash-invalid'));
	        \Response::redirect_back();
	    }
	    else
	    {
	        \Response::redirect_back();
	    }



	    /*
	    	As mentioned before, this example uses Ormauth, 
	    	and can therefore use the provided Orm models to access the users table. 
	    	If you use Simpleauth, use this code instead:

		$user = \DB::select_array(\Config::get('simpleauth.table_columns', array('*')))
		    ->where('email', '=', $email)
		    ->from(\Config::get('simpleauth.table_name'))
		    ->as_object()->execute(\Config::get('simpleauth.db_connection'))->current();

	    if ($user)
	    {
				and likewise for the second lookup, which is on 'id'. 
				You will also have to modify the check on the lostpassword fields, 
				as with Simpleauth they are stored in the profile fields array. 
				This means that you have to the profile_fields column from the query result, 
				unserialize it if it's not empty, and get the hash and timestamp out of it.
				You may also notice that the user-id is added to the hash. 
				This is done to be able to support Simpleauth. 
				With Ormauth, you could do a metadata lookup, 
				and get the related user object from the metadata. 
				With Simpleauth, there is no lookup possible since the data is stored in a serialized array inside the profile_fields column.
		}
			*/




		$data["subnav"] = array('passwordrecovery'=> 'active' );
		$this->template->title = 'Accounts &raquo; Passwordrecovery';
		$this->template->content = View::forge('accounts/passwordrecovery', $data);
	}

}



