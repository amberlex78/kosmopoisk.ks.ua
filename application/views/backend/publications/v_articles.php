<?php defined('SYSPATH') or die('No direct script access.') ?>

<p><?= App_Formtb::btn(ADMIN . '/publications/add_article/' . $cid, 'publications.article.add') ?></p>

<?= $breadcrumbs ?>

<?php if ($pagination->config['total_items'] > 0): ?>

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width: 40px;"></th>
				<th><?= __('publications.article.title') ?></th>
				<th><?= __('seo.url') ?></th>
				<th style="width: 50px;"><?= __('app.caption.status') ?></th>
				<th style="width: 90px;"><?= __('app.action.actions') ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($o_articles as $o_article): ?>
				<tr>
					<td>
						<?php if (is_file(IMG_PUBLICATIONS_DIR . $o_article->fimage)) echo HTML::image(IMG_PUBLICATIONS_URL . $o_article->fimage, array('class' => 'img')) ?>
					</td>
					<td>
						<?= $o_article->title ?>
						<?php if ( ! $cid): ?>
							<br/>
							<b><?= __('publications.category.caption') ?>:</b>
							<?= HTML::anchor(ADMIN . '/publications/articles/' . $o_article->category->id, $o_article->category->title) ?>
						<?php endif ?>
					</td>
					<td>
						<?= HTML::anchor('article/'. $o_article->slug, $o_article->slug, array('target' => '_blank')) ?>
					</td>
					<td>
						<span id="<?= $o_article->id ?>" class="label change-status-article label-<?= ($o_article->status) ? 'success' : 'important' ?>" style="cursor: pointer;" >
							<?= $o_article->status ? __('app.caption.status_on') : __('app.caption.status_off') ?>
						</span>
					</td>
					<td>
						<div class="btn-group">
							<?= HTML::anchor(ADMIN . '/publications/edit_article/'   . $o_article->id, ICO_PENCIL, array('class' => 'btn')) ?>
							<?= HTML::anchor(ADMIN . '/publications/delete_article/' . $o_article->id, ICO_REMOVE, array('class' => 'btn btn-danger delete-article')) ?>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<?= $pagination ?>

	<span class="label label-info"><?= __('publications.article.amount') . ': ' . $pagination->config['total_items'] ?></span>

<?php else: ?>

	<div class="alert alert-info"><?= __('publications.article.no_articles') ?></div>

<?php endif ?>

