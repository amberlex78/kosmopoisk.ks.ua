<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php foreach ($o_articles as $o_article): ?>

	<div class="item">

		<?php if ( ! $o_article->status): ?>
			<span class="pg-status">[ <?php echo __('app.caption.status_off') ?> ]</span>
		<?php endif ?>

		<h2>
            <?php if($is_admin) { ?>
                <?= HTML::anchor(ADMIN . '/publications/edit_article/' .  $o_article->id, '<i class="icon-edit"></i>', array('title' => 'Редактировать статью')) ?>
            <?php } ?>
            <?php echo HTML::anchor('article/' . $o_article->slug, $o_article->title) ?>
        </h2>

		<?php
			if ($o_article->fimage AND is_file(IMG_PUBLICATIONS_DIR . $o_article->fimage))
				echo HTML::anchor(
					'article/' . $o_article->slug,
					HTML::image(IMG_PUBLICATIONS_URL . $o_article->fimage, array('class' => 'img-polaroid left', 'alt' => ''))
				);
		?>

		<?php echo $o_article->preview ?>

		<div class="date">
			<?php if ($o_article->category->status): ?>
				<i class="icon-book"></i> <?php echo HTML::anchor('category/' . $o_article->category->slug, $o_article->category->title) ?>
			<?php else: ?>
				<?php if ($is_admin): ?>
					<i class="icon-book"></i> <?php echo HTML::anchor('category/' . $o_article->category->slug, $o_article->category->title, array('class' => 'mark')) ?>
				<?php endif ?>
			<?php endif ?>
			&nbsp;<i class="icon-calendar"></i> <?php echo Date::d_m_Y($o_article->created) ?>
		</div>

	</div>

<?php endforeach ?>

<?php echo $pagination ?>
