


<form class="login-form" action="/accounts/login" method="POST">
	<?php if ( ! empty($incorrect_username_or_password)): ?>
		<p class="alert alert-danger">Incorrect email or password.</p>
	<?php endif; ?>
	<div class="form-group <?php if ( ! empty($incorrect_username_or_password)) { echo 'has-error';} ?>">
		<label class="control-label">
			Email
			<input class="form-control" type="email" name="username" />
		</label>
	</div>
	<div class="form-group <?php if ( ! empty($incorrect_username_or_password)) { echo 'has-error';} ?>">
		<label class="control-label">
			Password
			<input class="form-control" type="password" name="password" id="login-form__password-input" />
		</label>
	</div>
	<label class="login-form__show-password-checkbox-label">Show password
		<input id="login-form__show-password-checkbox" type="checkbox" />
	</label>

	<div class="checkbox login-form__keep-me-logged-in">
		<label class="control-label">
			<input type="checkbox" name="remember" />
			Keep me logged in
		</label>
	</div>
	<div class="login-form__actions">
		<button type="submit" class="btn btn-primary login-form__login-button">Login</button>
		<div class="login-form__forgot-password-link">
			<?php echo Html::anchor('accounts/passwordrecovery','Forgot your password?');?>
		</div>
	</div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function() {

	var showPasswordCheckbox = document.getElementById('login-form__show-password-checkbox');
	var passwordInputField = document.getElementById('login-form__password-input');

	showPasswordCheckbox.onclick = function(){
		var inputType = showPasswordCheckbox.checked ? 'text' : 'password';
    	passwordInputField.setAttribute('type', inputType);
	};
    
});
</script>
