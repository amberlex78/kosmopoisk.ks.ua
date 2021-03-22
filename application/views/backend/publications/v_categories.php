<?php defined('SYSPATH') or die('No direct script access.') ?>

<p><?php echo App_Formtb::btn(ADMIN . '/publications/add_category/' . $o_pcategory->id, 'publications.category.add') ?></p>

<?php echo $breadcrumbs ?>

<?php if ($num_of_categories > 0): ?>

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th><?php echo __('publications.category.title') ?></th>
				<th><?php echo __('seo.url') ?></th>
				<th style="width: 50px;"><?php echo __('app.caption.status') ?></th>
				<th style="width: 90px;"><?php echo __('app.action.actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($o_categories as $o_category): ?>
				<tr>
					<td>
						<?php echo $o_category->title ?>
						<?php //echo HTML::anchor(ADMIN . '/publications/categories/' . $o_category->id, $o_category->title) ?>
					</td>
					<td>
						<?php echo HTML::anchor('category/' . $o_category->slug, $o_category->slug, array('target' => '_blank')) ?>
					</td>
					<td>
						<span id="<?php echo $o_category->id ?>" class="label change-status-catategory label-<?php echo ($o_category->status) ? 'success' : 'important' ?>" style="cursor: pointer;" >
							<?php echo $o_category->status ? __('app.caption.status_on') : __('app.caption.status_off') ?>
						</span>
					</td>
					<td>
						<div class="btn-group">
							<?php
								echo HTML::anchor(ADMIN . '/publications/edit_category/'   . $o_category->id, ICO_PENCIL, array('class' => 'btn'));

								// Чтобы не удалить основные категории
								if ($o_category->id > 3)
									echo HTML::anchor(ADMIN . '/publications/delete_category/' . $o_category->id, ICO_REMOVE, array('class' => 'btn btn-danger delete-category'));
							?>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<span class="label label-info"><?php echo __('publications.category.amount') . ': ' . $num_of_categories ?></span>

<?php else: ?>

	<div class="alert alert-info"><?php echo __('publications.category.no_categories') ?></div>

<?php endif ?>

