<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php if ( ! $o_category->status): ?>
	<div class="pg-status">[ <?php echo __('app.caption.status_off') ?> ]</div>
<?php endif ?>

<h1><?php echo $o_category->title ?></h1>
<?php echo $o_category->description ?>
<hr>

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
				)
		?>

		<?php echo $o_article->preview ?>

		<div class="date">
			<i class="icon-calendar"></i> <?php echo Date::d_m_Y($o_article->created) ?>
		</div>

	</div>

<?php endforeach ?>

<?php echo $pagination ?>
