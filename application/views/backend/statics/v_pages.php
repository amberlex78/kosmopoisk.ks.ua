<?php defined('SYSPATH') or die('No direct script access.') ?>

<p><?php echo App_Formtb::btn(ADMIN . '/statics/add', 'statics.add') ?></p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th><?php echo __('statics.title') ?></th>
			<th><?php echo __('seo.url') ?></th>
			<th style="width: 50px;"><?php echo __('app.caption.status') ?></th>
			<th style="width: 90px;"><?php echo __('app.action.actions') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($o_pages as $o_page): ?>
			<tr>
				<td><?php echo $o_page->title ?></td>
				<td><?php echo HTML::anchor('/' . $o_page->slug, $o_page->slug, array('target' => '_blank')) ?></td>
				<td>
					<?php if ($o_page->id > 1): ?>
						<span id="<?php echo $o_page->id ?>" class="label change-status label-<?php echo ($o_page->status) ? 'success' : 'important' ?>" style="cursor: pointer;" >
							<?php echo $o_page->status ? __('app.caption.status_on') : __('app.caption.status_off') ?>
						</span>
					<?php endif ?>
				</td>
				<td>
					<div class="btn-group">
						<?php
							echo HTML::anchor(ADMIN . '/statics/edit/' . $o_page->id, ICO_PENCIL, array('class' => 'btn'));
							if ($o_page->allow_delete)
								echo HTML::anchor(ADMIN . '/statics/delete/' . $o_page->id, ICO_REMOVE, array('class' => 'btn btn-danger delete-static'));
						?>
					</div>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<span class="label label-info"><?php echo __('statics.amount') . ': ' . $amount ?></span>