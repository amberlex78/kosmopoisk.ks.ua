<?php defined('SYSPATH') or die('No direct script access.') ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php foreach ($styles as $file_style) echo Html::style($file_style)."\n\t" ?>
</head>
<body>
	<div class="container">
		<?php if ($message) echo $message ?>
		<?php echo $block_center ?>
	</div>
	<?php foreach ($scripts as $file_script) echo Html::script($file_script)."\n\t" ?>
</body>
</html>