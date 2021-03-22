$(function(){

	$('.label.change-status').click(function(){

		var id = $(this).attr('id');
		var curr_el = $('#' + id);

		curr_el.removeClass();
		curr_el.empty().html(APP.AJAX_IMG_LOADER);

		$.post(APP.AJAX_URL + 'statics/change_status',
			{ id : id },
			function (data) {
				if (data.success) {
					if (data.params.status){
						curr_el.addClass('label change-status label-success');
						curr_el.text(APP.msg.caption.on);
					}
					else{
						curr_el.addClass('label change-status label-important');
						curr_el.text(APP.msg.caption.off);
					}
				}
			},
			'json'
		)
	});

	$('.btn.btn-danger.delete-static').click(function(e){
		if ( ! confirm(APP.msg.confirm.delete_static)) {
			return false;
		}
	})

});
