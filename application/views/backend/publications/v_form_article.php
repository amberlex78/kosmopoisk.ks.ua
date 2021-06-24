<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php echo Form::open(Request::current(), array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data')) ?>

<ul class="nav nav-tabs">
	<li class="active"><a href="#page" data-toggle="tab"><?php echo __('publications.article.caption') ?></a></li>
	<li><a href="#seo" data-toggle="tab"><?php echo __('seo.caption') ?></a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane fade in active" id="page">
		<?php
		echo App_Formtb::select('category_id', $categories, $cid,
			array('class' => 'input-xxlarge'),
			array('label' => 'publications.category.select', 'errors' => $errors, 'mark' => TRUE)
		);
		echo App_Formtb::input('title', $data->title,
			array('class' => 'input-xxlarge'),
			array('label' => 'publications.article.title', 'help' => 'publications.article.title_h', 'errors' => $errors, 'mark' => TRUE)
		);
        echo App_Formtb::textarea('preview', $data->preview,
            array('class' => 'input-xxlarge', 'rows' => 4),
            array('label' => 'publications.article.preview')
        );
        echo App_Formtb::ckeditor('text', $data->text, array('label' => 'publications.article.text'));
        echo App_Formtb::input('tags', $tags,
            array('class' => 'span7'),
            array('label' => 'publications.article.tags', 'help' => 'publications.article.tags_h')
        );
        echo App_Formtb::input('source', $data->source,
            array('class' => 'span7'),
            array('label' => 'publications.article.source', 'help' => 'publications.article.source_h', 'errors' => $errors)
        );
        ?>

        <div class="controls">
			<p>
				<span class="img-loader"></span>
				<div id="image">
					<?php
					// Если добавление
					if (Session::instance()->get('flag_article_action') == 'add')
					{
						$image = Session::instance()->get('uploaded_image_add');
						if (is_file(IMG_PUBLICATIONS_DIR . $image))
						{
							echo HTML::image(IMG_PUBLICATIONS_URL . $image, array('id' => $image, 'class' => 'img-polaroid'));
							echo '<button class="btn btn-danger delete-image" value="' . $image .'"><i class="icon-remove icon-white"></i></button>';
						}
					}
					elseif (Session::instance()->get('flag_article_action') == 'edit')
					{
						if (is_file(IMG_PUBLICATIONS_DIR . $data->fimage))
						{
							Session::instance()->set('uploaded_image_edit', $data->fimage);
							echo HTML::image(IMG_PUBLICATIONS_URL . $data->fimage, array('id' => $data->fimage, 'class' => 'img-polaroid'));
							echo '<button class="btn btn-danger delete-image" value="' . $data->fimage .'"><i class="icon-remove icon-white"></i></button>';
						}
					}
					?>
				</div>
			</p>
			<button id="uploadBtnImage" class="upload btn">
				<?php echo __('app.action.upload_image') ?>
			</button>
		</div>
    </div>

	<div class="tab-pane fade" id="seo">
		<?php
		echo App_Formtb::input('slug', $data->slug,
			array('class' => 'input-xxlarge'),
			array('label' => 'seo.url', 'help' => 'seo.url_h', 'errors' => $errors)
		);
		echo App_Formtb::textarea('meta_t', $data->meta_t,
			array('class' => 'span7', 'rows' => 2),
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

