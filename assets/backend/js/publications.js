$(function(){

// Изменить статус категории

	$('.label.change-status-catategory').click(function(){
		publicationsChangeStatus($(this).attr('id'), 'catategory');
	});

// Подтверждение на удаление категории

	$('.btn.btn-danger.delete-category').click(function(){
		return confirm(APP.msg.confirm.delete_category);
	})


// Изменить статус статьи

	$('.label.change-status-article').click(function(){
		publicationsChangeStatus($(this).attr('id'), 'article');
	});

// Подтверждение на удаление статьи

	$('.btn.btn-danger.delete-article').click(function () {
		return confirm(APP.msg.confirm.delete_article);
	});


// Загрузка изображения

	uploadImage($('#uploadBtnImage'));

// Удаление изображения

	$('.btn.btn-danger.delete-image').live('click', function(e) {
		e.preventDefault();
		if ( ! confirm(APP.msg.confirm.delete_image)) {
			return false;
		} else {
			var val = $(this).val();

			// показываем картинку загрузки файла
			$('.img-loader').html(APP.AJAX_IMG_LOADER);

			$.post(APP.AJAX_URL + 'publications/delete_image_for_article',
				{ img_id: val },
				function (data) {
					if (data.status) {
						$('.img-loader').empty();
						$('#image').empty();
					}
				},
				'json'
			)
		}
	});

});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * Изменить статус категории или статьи
 * @param id
 */
function publicationsChangeStatus(id, action)
{
	var curr_el = $('#' + id);

	curr_el.removeClass();
	curr_el.empty().html(APP.AJAX_IMG_LOADER);

	$.ajax({
		url: APP.AJAX_URL + 'publications/change_status_' + action,
		type: 'post',
		dataType: 'json',
		data: { id : id },
		success: function(data){
			if (data.success) {
				if (data.params.status){
					curr_el.addClass('label change-status-' + action + ' label-success');
					curr_el.text(APP.msg.caption.on);
				}
				else{
					curr_el.addClass('label change-status-' + action + ' label-important');
					curr_el.text(APP.msg.caption.off);
				}
			}
		},
		error: function() {
			alert(APP.msg.err.transmission);
		}
	});
}


/**
 * Загрузка изображения к статье
 * @param upload
 */
function uploadImage(upload)
{
	var interval;

	$.ajax_upload(upload, {

		action : APP.AJAX_URL + 'publications/upload_image_for_article',
		name : 'image',
		onSubmit : function(file, ext) {

			// Показываем картинку загрузки файла
			$('.img-loader').html(APP.AJAX_IMG_LOADER);

			this.disable();
		},
		onComplete : function(file, response) {

			var obj = jQuery.parseJSON(response);

			// Убираем картинку загрузки файла
			$(".img-loader").empty();

			// Убираем изображение
			$("#image").empty();

			this.enable();

			if (obj.status) {
				$('<img id="' + obj.img_id + '" src="' + obj.params.image + '" class="img-polaroid">').appendTo("#image");
				$('<button class="btn btn-danger delete-image" value="' + obj.img_id + '"><i class="icon-remove icon-white"></i></button>').appendTo("#image")
			} else {
				$(APP.alert(obj.message, 'error')).appendTo('#image');
			}

		}
	});
}
