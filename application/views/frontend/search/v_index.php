<?php defined('SYSPATH') or die('No direct script access.') ?>

<h1><?php echo $title ?></h1>

<?php if ($search_string): ?>
	<span class="label label-info"><i class="icon-<?php echo $type_search == 'tag' ? 'tag' : 'search' ?> icon-white"></i> <?php echo HTML::chars($search_string) ?></span>
	<span class="badge badge-success"><?php echo __('publications.article.founded') . ': ' . $amount_records ?></span>
	<?php //$v_result = preg_replace('#(' . HTML::chars($search_string) . ')#iuU', '<span class="mark-found">$1</span>', $v_result) ?>
<?php endif ?>

<?php echo $v_result ?>
