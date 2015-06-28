<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('ajaxlogin/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('ajaxlogin/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "forgotpassword" ); ?>'><?php echo Html::anchor('ajaxlogin/forgotpassword','Forgotpassword');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('ajaxlogin/logout','Logout');?></li>

</ul>
<p>Logout</p>