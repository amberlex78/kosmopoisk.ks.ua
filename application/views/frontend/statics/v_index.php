<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php if ( ! $o_page->status): ?>
	<div class="pg-status">[ <?php echo __('app.caption.status_off') ?> ]</div>
<?php endif ?>

<h1><?php echo $o_page->title ?></h1>
<?php echo $o_page->text ?>

<?php echo $v_contacts ?>
