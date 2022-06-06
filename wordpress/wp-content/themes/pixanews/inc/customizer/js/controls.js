jQuery(document).ready(function () {
	jQuery('.controls#pixanews-img-container li img').click(function () {
		jQuery('.controls#pixanews-img-container li').each(function () {
			jQuery(this).find('img').removeClass('pixanews-radio-img-selected');
		});
		jQuery(this).addClass('pixanews-radio-img-selected');
	});
});