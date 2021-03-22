<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php echo $breadcrumbs ?>

<?php echo Form::open(Request::current(), array('class'=>'form-horizontal')) ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#category" data-toggle="tab"><?php echo __('publications.category.caption') ?></a></li>
		<li><a href="#seo" data-toggle="tab"><?php echo __('seo.caption') ?></a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade in active" id="category">
			<?php
			echo App_Formtb::input('title', $data->title,
				array('class' => 'input-xxlarge'),
				array('label' => 'publications.category.title', 'help' => 'publications.category.title_h', 'errors' => $errors, 'mark' => TRUE)
			);
			echo App_Formtb::ckeditor('description', $data->description, array('label' => 'publications.category.description'), 150);
			echo App_Formtb::input('title_menu', $data->title_menu,
				array('class' => 'input-xxlarge'),
				array('label' => 'publications.category.title_menu', 'help' => 'publications.category.title_menu_h')
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
					array('label' => 'seo.meta_t', 'help' => 'seo.meta_t_category_h')
				);
				echo App_Formtb::textarea('meta_d', $data->meta_d,
					array('class' => 'span7', 'rows' => 2),
					array('label' => 'seo.meta_d', 'help' => 'seo.meta_d_category_h')
				);
				echo App_Formtb::textarea('meta_k', $data->meta_k,
					array('class' => 'span7', 'rows' => 2),
					array('label' => 'seo.meta_k', 'help' => 'seo.meta_k_category_h')
				);
			?>
		</div>
	</div>

	<?php echo App_Formtb::btns() ?>

<?php echo Form::close() ?>