$(document).ready(function() {

	$('#profile_image').change(function() {
        checkImageSize('profile_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div', 'pImage');
    });

    $('#profile_image_1').change(function() {
        checkImageSize('profile_image_1', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div_1', 'pImage1');
    });


});
