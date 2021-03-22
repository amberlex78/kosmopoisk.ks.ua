<?php defined('SYSPATH') or die('No direct script access.') ?>
<!DOCTYPE html>
<html lang="<?php echo $language ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<?php foreach ($styles as $file_style) echo Html::style($file_style)."\n\t" ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>	<![endif]-->
</head>

<body>

<!-- Верхнее меню -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<?php echo Html::anchor(ADMIN, $sitename . ' &mdash; ' .  __('app.caption.admin'), array('class'=>'brand')) ?>
			<div class="pull-right">
				<ul class="nav">
					<li <?php if ($current_controller == 'settings') echo 'class="active"' ?>>
						<?php echo Html::anchor(Route::url('backend', array('controller' => 'settings')), __('settings.heading')) ?>
					</li>
					<li <?php if ($current_controller == 'users' AND $current_action == 'admin') echo 'class="active"' ?>>
						<?php echo Html::anchor(Route::url('backend', array('controller' => 'users', 'action' => 'admin')), __('users.profile')) ?>
					</li>
					<li><?php echo Html::anchor('', __('app.caption.to_site'), array('target' => '_blank')) ?></li>
					<li><?php echo Html::anchor(Route::url('backend_auth', array('action' => 'logout')), __('users.logout')) ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">

	<div class="row">
		<div class="span3">
			<?php echo $block_left ?>
		</div>
		<div class="span9">
			<?php echo $message ?>
			<fieldset>
				<legend><?php echo $legend ?></legend>
				<?php echo $block_center ?>
			</fieldset>
		</div>
	</div>

	<div class="row">
		<div class="span12"><hr/></div>
		<div class="span10">
			<p class="muted copy">AmberlexCMS, 2012 <br/> <?php echo usage_time_and_memory() ?></p>
		</div>
		<div class="span2">
			<a href="#" class="btn pull-right"><?php echo __('app.action.go_top') ?> <i class="icon-chevron-up"></i></a>
		</div>
	</div>

</div>

<?php foreach ($scripts as $file_script) echo Html::script($file_script)."\n" ?>

<!-- Профилировщик -->
<br />
<?php if (Kohana::$environment !== Kohana::PRODUCTION) echo View::factory('profiler/stats') ?>

</body>
</html>