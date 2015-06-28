<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('accounts/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('accounts/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('accounts/logout','Logout');?></li>
	<li class='<?php echo Arr::get($subnav, "passwordrecovery" ); ?>'><?php echo Html::anchor('accounts/passwordrecovery','Passwordrecovery');?></li>

</ul>



<form action="/accounts/changepassword" method="POST">
	<div>
		<label>
			Old password
			<input type="password" name="oldpassword" />
		</label>
	</div>
	<div>
		<label>
			New password
			<input type="password" name="newpassword" />
		</label>
	</div>
	<button>Login</button>
</form>