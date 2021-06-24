<?php defined('SYSPATH') or die('No direct script access.') ?>
<!DOCTYPE html>
<html lang="<?php echo $language ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" href="<?php echo Url::base(); ?>favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo Html::chars($description) ?>" />
	<meta name="keywords" content="<?php echo Html::chars($keywords) ?>" />
	<?php foreach ($styles as $file_style) echo Html::style($file_style) . "\n\t" ?>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>	<![endif]-->
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
	<div class="container hbar">
		<a class="brand" href="<?php echo URL::base() ?>"><?php echo $sitename ?></a>
		<ul class="nav">
			<?php
				foreach($static_pages as $static_page)
				{
					$active = $slug == $static_page->slug ? ' class="active"' : '';
					$icon   = $static_page->icon_menu == '' ? '' : '<i class="' . $static_page->icon_menu . '"></i> ';
					$style  = ( ! $static_page->status) ? 'color: red;' : '';
					echo '<li' . $active . '>' . HTML::anchor($static_page->slug, $icon . $static_page->title_menu, array('style' => $style)) . '</li>';
				}
			?>
            <li><?= $is_admin ? HTML::anchor(ADMIN . '/publications/add_article', '<i class="icon-plus"></i> Добавить статью') : '' ?></li>
		</ul>
		<div class="pull-right">
			<?php echo Form::open(URL::Base() . 'search', array('id' =>'frm_search', 'class' => 'navbar-search pull-right')) ?>
				<div class="input-append">
					<?php echo Form::input('search_string', '', array('id' => 'appendedInputButton', 'class' => 'span2', 'placeholder' => __('app.caption.search'))) ?>
					<button class="btn" type="submit"><i class="icon-search"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<div class="container">
	<div class="content">
		<div class="row">
			<div class="span3">
				<?php foreach ($block_left as $block) echo $block ?>
			</div>
			<div class="span9">
				<div class="subcontent">
					<?php echo $message ?>
					<?php echo $block_center ?>
					<div class="both"></div>
				</div>
			</div>
		</div>
		<footer>
			<div class="container">
				<div class="row">
					<div class="span10">
						<p class="muted copy">
							<small>
								<?php echo $sitecopy . date('Y', time()) ?>г.<br/>
								<br/>
							</small>
						</p>
					</div>
					<div class="span2">
						<a href="#" class="btn pull-right"><?php echo __('app.action.go_top') ?> <i class="icon-chevron-up"></i></a>
					</div>
				</div>
			</div>
		</footer>
	</div>
</div>

<?php foreach ($scripts as $file_script) echo Html::script($file_script) . "\n" ?>

<script>
    var reformalOptions = {
        project_id: 985002,
        project_host: "ks-kosmopoisk.reformal.ru",
        tab_orientation: "bottom-left",
        tab_indent: "10px",
        tab_bg_color: "#264263",
        tab_border_color: "#FFFFFF",
        tab_image_url: "http://tab.reformal.ru/T9GC0LfRi9Cy0Ysg0Lgg0L%252FRgNC10LTQu9C%252B0LbQtdC90LjRjw==/FFFFFF/9c1f751cd883e990123aab292c606f93/bottom-left/1/tab.png",
        tab_border_width: 0
    };

    (function() {
        var script = document.createElement('script');
        script.type = 'text/javascript'; script.async = true;
        script.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'media.reformal.ru/widgets/v3/reformal.js';
        document.getElementsByTagName('head')[0].appendChild(script);
    })();
</script><noscript><a href="http://reformal.ru"><img src="http://media.reformal.ru/reformal.png" alt="reformal.ru"/></a><a href="http://ks-kosmopoisk.reformal.ru">Oтзывы и предложения для Научно-исследовательское объединение «Херсон – Космопоиск»</a></noscript>

<?php if (Kohana::$environment !== Kohana::PRODUCTION) echo View::factory('profiler/stats') ?>

</body>
</html>