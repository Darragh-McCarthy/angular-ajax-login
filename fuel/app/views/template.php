<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.css'); ?>
</head>
<body>
	<header><h1><?php echo $screen_name ?></h1></header>
	<div class="container">
		<div class="col-md-12">
			<h1><?php echo $title; ?></h1>
			<hr>
		</div>
		<div class="col-md-12"><?php echo $content; ?></div>

		
	</div>
	<footer>
		<!--<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>-->
	</footer>
</body>
</html>
