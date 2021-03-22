<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php echo Form::open(Request::current(), array('class'=>'form-horizontal')) ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#page" data-toggle="tab"><?php echo __('statics.page.caption') ?></a></li>
		<li><a href="#seo" data-toggle="tab"><?php echo __('seo.caption') ?></a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="page">
			<?php
				echo App_Formtb::input('title', $data->title,
					array('class' => 'input-xxlarge'),
					array('label' => 'statics.title', 'errors' => $errors, 'mark' => TRUE)
				);
				echo App_Formtb::ckeditor('text', $data->text, array('label' => 'statics.text'));
				echo App_Formtb::input('title_menu', $data->title_menu,
					array('class' => 'input-xxlarge'),
					array('label' => 'statics.title_menu', 'help' => 'statics.title_menu_h')
				);
				echo App_Formtb::input('icon_menu', $data->icon_menu,
					array('class' => 'input-xxlarge'),
					array('label' => 'statics.icon_menu', 'help' => 'statics.icon_menu_h')
				);
			?>
		</div>
		<div class="tab-pane fade" id="seo">
			<?php
				echo App_Formtb::input('slug', $data->slug,
					array('class' => 'input-xxlarge'),
					array('label' => 'seo.url', 'help' => 'seo.url_h', 'errors' => $errors)
				);
				echo App_Formtb::input('meta_t', $data->meta_t,
					array('class' => 'span7'),
					array('label' => 'seo.meta_t', 'help' => 'seo.meta_t_page_h')
				);
				echo App_Formtb::textarea('meta_d', $data->meta_d,
					array('class' => 'span7', 'rows' => 2),
					array('label' => 'seo.meta_d', 'help' => 'seo.meta_d_page_h')
				);
				echo App_Formtb::textarea('meta_k', $data->meta_k,
					array('class' => 'span7', 'rows' => 2),
					array('label' => 'seo.meta_k', 'help' => 'seo.meta_k_page_h')
				);
			?>
		</div>
	</div>

	<?php echo App_Formtb::btns('static') ?>

<?php echo Form::close() ?>
