<?php defined('SYSPATH') or die('No direct script access.');

// Ссылки для категории
$usr_link = HTML::anchor('category/' . $o_article->category->slug, $o_article->category->title);
$adm_link = HTML::anchor('category/' . $o_article->category->slug, $o_article->category->title, array('class' => 'mark'));

echo '<i class="icon-book"></i> ' . __('publications.category.caption') . ': ';
if ($o_article->category->status)
	echo $usr_link;
elseif ($is_admin)
	echo $adm_link;
?>

<?php if ( ! $o_article->status): ?>
	<span class="pg-status">[ <?php echo __('app.caption.status_off') ?> ]</span>
<?php endif ?>


<h1>
    <?php if($is_admin) { ?>
        <?= HTML::anchor(ADMIN . '/publications/edit_article/' .  $o_article->id, '<i class="icon-edit"></i>', array('title' => 'Редактировать статью')) ?>
    <?php } ?>
    <?php echo $o_article->title ?>
</h1>
<?php
	if ($o_article->fimage AND is_file(IMG_PUBLICATIONS_DIR . $o_article->fimage))
		echo HTML::image(IMG_PUBLICATIONS_URL . $o_article->fimage, array('class' => 'img-polaroid left', 'alt' => ''));

	if (isset($o_article->preview))
		echo '<p>'.$o_article->preview.'</p>';

	echo $o_article->text;
?>
<div class="row-fluid"><div class="span12"><hr></div></div>
<div class="row-fluid">
	<div class="span5">
		
		<i class="icon-chevron-left"></i> <a href="javascript:history.go(-1);"><?php echo __('app.action.back_page') ?></a>
	</div>
	<div class="span7">
		<p class="right">
			<?php echo Date::d_m_Y($o_article->created) ?> <i class="icon-calendar"></i><br />
			<?php echo HTML::anchor('contacts', $autograph) ?> <i class="icon-user"></i><br />
			<?php
				if ($o_article->category->status)
					echo $usr_link . ' <i class="icon-book"></i><br />';
				else
					if ($is_admin)
						echo $adm_link . ' <i class="icon-book"></i>';

				if ($o_article->source)
					echo HTML::anchor($o_article->source, __('publications.article.source'), array('rel' => 'nofollow', 'target'=> '_blank')) . ' <i class="icon-external-link"></i><br />';

				if (count($tags))
				{
					echo '<br />';
					foreach ($tags as $tag)
						echo HTML::anchor('search/' . $tag->slug, $tag->name, array('class' => 'btn btn-mini'));

					echo '&nbsp;<i class="icon-tags"></i>';
				}
			?>
		</p>
	</div>
</div>
