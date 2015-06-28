<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>

	<?php echo Asset::css('bootstrap.css'); ?>
	<?php echo Asset::css('app.css'); ?>
</head>
<body>



<header class="main-header container-fluid">
	<div class="row">
		<div class="main-header__user-account col-sm-4 col-sm-offset-8 col-xs-6 col-xs-offset-6">
			<div class="row">
				<ul class="list-inline">
					<li><div class="main-header__user-account__screen-name"><?php echo $screen_name ?></div></li>
					<?php if ($screen_name === 'Guest'): ?>
						<li><a href="/accounts/login">Login</a></li>
						<li><a href="/accounts/register">Register</a></li>
					<?php else: ?>
						<li><a href="/accounts/logout">Logout</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
	
</header>

<div class="container">
	<div class="col-md-12">
		<h1><?php echo $title; ?></h1>
		<hr>
	</div>
	<div class="col-md-12"><?php echo $content; ?></div>

	
</div>
<footer>
	
</footer>




</body>
</html>
