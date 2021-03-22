<?php defined('SYSPATH') or die('No direct script access.') ?>

<ul class="breadcrumb">
	<?php foreach ($breadcrumbs as $i => $crumb): ?>
		<?php if ($i < count($breadcrumbs) - 1): ?>
			<li>
				<?php echo HTML::anchor(ADMIN . '/publications/'. Request::current()->action() . '/' . $crumb->id, $crumb->title) ?>
				<span class="divider">/</span>
			</li>
		<?php else: ?>
			<li class="active">
				<?php if ($is_anchor): ?>
					<?php echo HTML::anchor(ADMIN . '/publications/categories/' . $crumb->id, $crumb->title) ?>
				<?php else: ?>
					<?php echo $crumb->title ?>
				<?php endif ?>
				<span class="divider">/</span>
			</li>
		<?php endif ?>
	<?php endforeach ?>
</ul>


