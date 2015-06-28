<?php 



echo '<div class="register-form">';
if (is_array($errors) || is_object($errors))
{

	        	foreach ($errors as $val) {
	        		# code...
	        		//echo ' #1: '.$val[0];
			        //echo ' #2: '.$val[1];
			        echo '<p class="alert alert-danger">'.$val[2].'</p>';
	        	}
}
else {
	echo $errors;
}
echo $form.'</div>';
?>
<!--
<form action="/accounts/register" method="POST">
	<div class="form-group <?php if ( ! empty($incorrect_username_or_password)) { echo 'has-error';} ?>">
		<label class="control-label">
			Email
			<input class="form-control" type="email" name="username" />
		</label>
	</div>
	<div class="form-group <?php if ( ! empty($incorrect_username_or_password)) { echo 'has-error';} ?>">
		<label class="control-label">
			Password
			<input class="form-control" type="password" name="password" />
		</label>
	</div>
</form>
-->

