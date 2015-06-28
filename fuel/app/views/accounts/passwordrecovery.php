<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('accounts/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('accounts/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('accounts/logout','Logout');?></li>
	<li class='<?php echo Arr::get($subnav, "passwordrecovery" ); ?>'><?php echo Html::anchor('accounts/passwordrecovery','Passwordrecovery');?></li>

</ul>
<h1>WARNING: this page unsafely exposes the password recovery link for test purposes. 
	<br/>
	The password recovery link should be sent by email.</h1>

<?php if ( ! empty($password_url)) { ?>
<a href="<?php echo $password_url ?>">Recover Password</a>
<?php } ?>
<form action="/accounts/passwordrecovery" method="POST">
	<div>
		<label>
			Email
			<input type="email" name="email" />
		</label>
	</div>
	
	<button>Login</button>
</form>