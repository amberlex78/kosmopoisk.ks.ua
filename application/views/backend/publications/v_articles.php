<?php defined('SYSPATH') or die('No direct script access.') ?>

<p><?php echo App_Formtb::btn(ADMIN . '/publications/add_article/' . $cid, 'publications.article.add') ?></p>

<?php echo $breadcrumbs ?>

<?php if ($pagination->config['total_items'] > 0): ?>

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width: 40px;"></th>
				<th><?php echo __('publications.article.title') ?></th>
				<th><?php echo __('seo.url') ?></th>
				<th style="width: 50px;"><?php echo __('app.caption.status') ?></th>
				<th style="width: 90px;"><?php echo __('app.action.actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($o_articles as $o_article): ?>
				<tr>
					<td>
						<?php if (is_file(IMG_PUBLICATIONS_DIR . $o_article->fimage)) echo HTML::image(IMG_PUBLICATIONS_URL . $o_article->fimage, array('class' => 'span1')) ?>
					</td>
					<td>
						<?php echo $o_article->title ?>
						<?php if ( ! $cid): ?>
							<br/>
							<b><?php echo __('publications.category.caption') ?>:</b>
							<?php echo HTML::anchor(ADMIN . '/publications/articles/' . $o_article->category->id, $o_article->category->title) ?>
						<?php endif ?>
					</td>
					<td>
						<?php echo HTML::anchor('article/'. $o_article->slug, $o_article->slug, array('target' => '_blank')) ?>
					</td>
					<td>
						<span id="<?php echo $o_article->id ?>" class="label change-status-article label-<?php echo ($o_article->status) ? 'success' : 'important' ?>" style="cursor: pointer;" >
							<?php echo $o_article->status ? __('app.caption.status_on') : __('app.caption.status_off') ?>
						</span>
					</td>
					<td>
						<div class="btn-group">
							<?php echo HTML::anchor(ADMIN . '/publications/edit_article/'   . $o_article->id, ICO_PENCIL, array('class' => 'btn')) ?>
							<?php echo HTML::anchor(ADMIN . '/publications/delete_article/' . $o_article->id, ICO_REMOVE, array('class' => 'btn btn-danger delete-article')) ?>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?php echo $pagination ?>

	<span class="label label-info"><?php echo __('publications.article.amount') . ': ' . $pagination->config['total_items'] ?></span>

<?php else: ?>

	<div class="alert alert-info"><?php echo __('publications.article.no_articles') ?></div>

<?php endif ?>

