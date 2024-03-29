<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php if (!$o_category->status): ?>
    <div class="pg-status">[ <?php echo __('app.caption.status_off') ?> ]</div>
<?php endif ?>

<h1><?= $o_category->title ?></h1>
<p><?= $o_category->description ?></p>
<hr>

<?php foreach ($o_articles as $o_article): ?>

    <div class="item">

        <?php if (!$o_article->status): ?>
            <span class="pg-status">[ <?= __('app.caption.status_off') ?> ]</span>
        <?php endif ?>

        <h2>
            <?php if ($is_admin) { ?>
                <?= HTML::anchor(ADMIN . '/publications/edit_article/' . $o_article->id, '<i class="icon-edit"></i>', array('title' => 'Редактировать статью')) ?>
            <?php } ?>
            <?= HTML::anchor('article/' . $o_article->slug, $o_article->title) ?>
        </h2>

        <?php
        if ($o_article->fimage and is_file(IMG_PUBLICATIONS_DIR . $o_article->fimage))
            echo HTML::image(IMG_PUBLICATIONS_URL . $o_article->fimage, array(
                'class' => 'img-polaroid left',
                'alt' => '$o_article->title',
                'width' => '160',
                'height' => '130',
            ));
        ?>

        <p><?= $o_article->preview ?></p>

        <div class="date">
            <i class="icon-calendar"></i> <?= Date::d_m_Y($o_article->created) ?>
        </div>

    </div>

<?php endforeach ?>

<hr>
<?= $pagination ?>
