<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $title; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

    	<?php echo Asset::css('bootstrap.css', array(), null, true); ?>
		<?php echo Asset::css('app.css', array(), null, true); ?>
    </head>
    <body ng-strict-di ng-app="harpoonAjaxLogin">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



		<header class="main-header">
			<div ui-view="header"></div>
		</header>
		<main>
			<div ui-view="content"></div>
		</main>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        -->

		<script type="text/ng-template" id="/templates/header.template.html">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-sm-offset-8">
					  	<ul class="list-inline main-header__navigation">
					  		<li>{{header.userScreenName}}</li>
					  		<li><a ui-sref-active="active" ui-sref="app.login" ng-show=" ! header.isUserLoggedIn">Login</a></li>
					  		<li><a ui-sref-active="active" ui-sref="app.register" ng-show=" ! header.isUserLoggedIn">Create account</a></li>
					  		<li><a ng-click="header.logout()" ng-show="header.isUserLoggedIn">Logout</a></li>
					  	</ul>
					</div>
				</div>
		  	</div>
		</script>


		<script type="text/ng-template" id="/templates/homepage.template.html">
			<h1>{{homepage.homepageTestText}}</h1>
		</script>


		<script type="text/ng-template" id="/templates/forgot-password.template.html">
		  Forgot password template {{forgotPassword.homepageTestText}}
		</script>


		<script type="text/ng-template" id="/templates/login.template.html">

		  	<form class="login-form" ng-submit="login.login()">
		  		<h1>Login</h1>
		  		<p ng-show="login.isWrongUsernamePassword" class="alert alert-danger">Incorrect email or password</p>
				<div class="form-group">
					<label>
						Email
						<input name="username" type="email" class="form-control" ng-model="login.username" required autofocus />
					</label>
				</div>
				<div class="form-group">
					<label>
						Password
						<input name="password" type="{{login.passwordInputType}}" type="text" class="form-control" ng-model="login.password" required />
					</label>
				</div>
				<div>
					<label class="login-form__show-password-checkbox-label">
						Show password
						<input class="login-form__show-password-checkbox" type="checkbox" ng-click="login.togglePasswordInputType()" />
					</label>
				</div>
				<div class="checkbox login-form__keep-me-logged-in">
					<label class="login-form__keep-me-logged-in__label">
						<input name="remember" type="checkbox" ng-model="login.remember" />
						Keep me logged in
					</label>
				</div>
				<div class="login-form__actions">
					<button class="btn btn-primary">Login</button>
					<a class="login-form__forgot-password-link" ui-sref="app.forgot-password">Forgot your password?</a>
				</div>
			</form>
		</script>

		<script  type="text/ng-template" id="/templates/register.template.html">
			<form class="register-form" name="registerform" ng-submit="register.register()">
		  		<h1>Register</h1>
		  		<ul class="register-form__errors-list">
			  		<li ng-repeat="error in register.serverErrors"
			  			class="alert alert-danger">
			  			{{error}}
			  		</li>
		  		</ul>
				<div class="form-group">
					<label>
						Email
						<input name="email" 
							type="email" 
							class="form-control" 
							name="email" 
							ng-model="register.email" 
							required 
							autofocus 
						/>
					</label>
				</div>
				<div class="form-group">
					<label>
						Full name
						<input name="fullname" 
							type="text" 
							class="form-control" 
							name="fullname" 
							ng-model="register.fullname" 
							required 
						/>
					</label>
				</div>
				<div class="form-group">
					<label>
						Password
						<input name="password" 
							type="{{register.passwordInputType}}" 
							name="password" 
							type="text" 
							class="form-control" 
							ng-model="register.password" 
							required 
						/>
					</label>
				</div>
				<label class="register-form__show-password-checkbox-label">
					<input class="register-form__show-password-checkbox" 
						type="checkbox"  
						ng-click="register.togglePasswordInputType()" 
					/>
					Show password
				</label>
				<div class="register-form__actions">
					<button class="btn btn-primary">Create account</button>
				</div>
			</form>
		</script>

		<script>
			window.isUserLoggedIn = '<?php if ( ! empty($is_user_logged_in)) { echo $is_user_logged_in; } else { echo "0"; } ?>';
			if (window.isUserLoggedIn === '0') {
				window.isUserLoggedIn = false;
			}
			else if (window.isUserLoggedIn === '1') {
				window.isUserLoggedIn = true;
			}
			else {
				console.log('invalid window.isUserLoggedIn value');
			}
			window.userScreenName = '<?php echo $screen_name; ?>';
		</script>

		<?php echo Asset::js('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js'); ?>
		<?php echo Asset::js('//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular-animate.js'); ?>
		<?php echo Asset::js('angular-ui-router.min.js'); ?>
		<?php echo Asset::js('main.module.js'); ?>
		<?php echo Asset::js('main.route.js'); ?>
		<?php echo Asset::js('homepage.controller.js'); ?>
		<?php echo Asset::js('login.controller.js'); ?>
		<?php echo Asset::js('register.controller.js'); ?>
		<?php echo Asset::js('header.controller.js'); ?>
		<?php echo Asset::js('forgot-password.controller.js'); ?>
		<?php echo Asset::js('sharedServices/userAuthService.factory.js'); ?>
		<?php echo Asset::js('focusTextInputsOnMouseover.directive.js'); ?>

    </body>
</html>










