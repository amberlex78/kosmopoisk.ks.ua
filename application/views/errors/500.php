<?php defined('SYSPATH') or die('No direct script access.') ?>
<div class="alert alert-error">
	<h1><?php echo $message ? $message : __('app.message.error_500') ?></h1>
</div>
<p><i class="icon-chevron-left"></i> <a href="javascript:history.go(-1);"><?php echo __('app.action.back_page') ?></a></p>
