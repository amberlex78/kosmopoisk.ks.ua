<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php if ($o_tags): ?>
	<div class="main-menu">
		<div class="main-menu-header">
			<h4><?php echo __('app.caption.tag_cloud') ?></h4>
		</div>
		<div class="block-in-side">
			<?php foreach ($o_tags as $o_tag): ?>
				<?php echo HTML::anchor('search/' . $o_tag['slug'], $o_tag['name']); ?><sup class="muted">(<?php echo $o_tag['posts_count'] ?>)</sup>,
			<?php endforeach ?>
		</div>
	</div>
<?php endif ?>
