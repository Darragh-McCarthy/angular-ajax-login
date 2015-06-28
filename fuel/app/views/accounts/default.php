<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('accounts/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('accounts/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('accounts/logout','Logout');?></li>
	<li class='<?php echo Arr::get($subnav, "passwordrecovery" ); ?>'><?php echo Html::anchor('accounts/passwordrecovery','Passwordrecovery');?></li>

</ul>


<form action="/accounts/delete" method="POST">
	<label>Delete user by username
		<input type="text" name="username">
	</label>
	<input type="submit" value="Submit"/>
</form>


<form action="/accounts/passwordrecovery" method="POST">
	<label>Reset your password
		<input type="text" name="email">
	</label>
	<input type="submit" value="Submit"/>
</form>