<?php defined('SYSPATH') or die('No direct script access.') ?>

<div class="main-menu">
	<div class="main-menu-header">
		<h4><?php echo __('app.caption.navigation') ?></h4>
	</div>
	<ul class="linksList">
		<?php foreach($main_menus as $item): $style  = ( ! $item->status) ? 'color: red;' : '';?>
			<li<?php echo $item->slug == $slug ? ' class="menu-active"' : '' ?>>
				<?php echo HTML::anchor('category/' . $item->slug, '<i class="icon-chevron-right"></i> ' . $item->title_menu, array('style' => $style)) ?>
			</li>
		<?php endforeach ?>
	</ul>
</div>