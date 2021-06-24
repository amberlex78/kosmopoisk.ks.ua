<?php defined('SYSPATH') or die('No direct script access.') ?>

<h1><?php echo $o_page->title ?></h1>
<?php echo $o_page->text ?>

<hr>
<?php echo $o_last_articles ?>

<hr>
<h3><a href="#tags" id="tags">Теги</a></h3>
<?php foreach ($o_tags as $o_tag): ?>
    <?php echo HTML::anchor('search/' . $o_tag['slug'],
        $o_tag['name'] . ' <sup class="muted">' . $o_tag['posts_count'] . '</sup>',
        array('class' => 'btn', 'style' => 'margin-bottom: 4px;')
    ); ?>
<?php endforeach ?>
