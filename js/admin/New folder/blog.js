$(document).ready(function() {

	$('#profile_image').change(function() {
        checkImageSize('profile_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div', 'pImage');
    });

    $('#profile_image_1').change(function() {
        checkImageSize('profile_image_1', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div_1', 'pImage1');
    });



    /*$(document).on('change','#expert_data',function(){

        $.ajax({
            url     : getDestinationUrl,
            data    : {'user_id' : $("#expert_data").val()},
            headers : { 'X-CSRF-TOKEN': csrf_token },
            type    : "POST",
            beforeSend:function(){
                $("#overlay").show();
            },
            success: function(res){
                console.log(res);

                $("#overlay").hide();
                $('.destination_div').html(res);
                $('.destination_data').selectpicker();
            }
        });
    });*/

    /* Get Destination List */



});
