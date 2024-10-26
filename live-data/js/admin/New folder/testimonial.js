$(document).ready(function(){
    
	if($('#comment1').length > 0 && $('#rchars1').length > 0){
		var textlen1 = maxLength - $('#comment1').val().length;
		$('#rchars1').text(textlen1);
	}
   
    
	if($('#comment2').length > 0 && $('#rchars2').length > 0){
		var textlen2 = maxLength - $('#comment2').val().length;
		$('#rchars2').text(textlen2);
	}	
		
	
	$('textarea').keyup(function() {
			
		if($('#comment1').length > 0 && $('#rchars1').length > 0){	
			var textlen1 = maxLength - $('#comment1').val().length;
			$('#rchars1').text(textlen1);
		}
		
		if($('#comment2').length > 0 && $('#rchars2').length > 0){
			var textlen2 = maxLength - $('#comment2').val().length;
			$('#rchars2').text(textlen2);
		}
    
    });

    /**
    * Check profile image
    */
    $('#profile_image').change(function(){
        checkImageSize('profile_image',IMAGE_UPLOAD_FILE_MAX_SIZE_TWO,'form','image_error_div');
    });

    /** 
    *Show user image after select 
    */
    $(document).on("click", ".changePhoto", function(){
        if(!$(".add-image #profile_image").hasClass("added")){
            $(".add-image #profile_image").trigger("click");
            $(".add-image #profile_image").addClass("added");
            window.setTimeout(function(){
                $(".add-image #profile_image").removeClass("added");
            },500);
        }
    });

});
