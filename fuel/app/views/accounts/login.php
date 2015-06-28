<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('accounts/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('accounts/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('accounts/logout','Logout');?></li>
	<li class='<?php echo Arr::get($subnav, "passwordrecovery" ); ?>'><?php echo Html::anchor('accounts/passwordrecovery','Passwordrecovery');?></li>

</ul>



<form action="/accounts/login" method="POST">
	<div>
		<label>
			Email
			<input type="email" name="username" />
		</label>
	</div>
	<div>
		<label>
			Password
			<input type="password" name="password" />
		</label>
	</div>
	<div>
		<label>
			Keep me logged in
			<input type="checkbox" name="remember" />
		</label>
	</div>
	<button>Login</button>
	<!--
	Expects input from a form that contains the input fields username (which may contain either username or email address), 
	password and remember (which is used as a toggle, so it can be a checkbox). 
	-->

</form>