<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "login" ); ?>'><?php echo Html::anchor('accounts/login','Login');?></li>
	<li class='<?php echo Arr::get($subnav, "register" ); ?>'><?php echo Html::anchor('accounts/register','Register');?></li>
	<li class='<?php echo Arr::get($subnav, "logout" ); ?>'><?php echo Html::anchor('accounts/logout','Logout');?></li>
	<li class='<?php echo Arr::get($subnav, "passwordrecovery" ); ?>'><?php echo Html::anchor('accounts/passwordrecovery','Passwordrecovery');?></li>

</ul>

<?php 
if (is_array($errors) || is_object($errors))
{

	        	foreach ($errors as $val) {
	        		# code...
	        		echo ' #1: '.$val[0];
			        echo ' #2: '.$val[1];
			        echo ' #3: '.$val[2];
			        echo('<br/>');
	        	}
}
else {
	echo $errors;
}
?>

<?php echo $form ?>