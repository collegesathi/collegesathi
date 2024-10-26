$(document).ready(function(){

		/**
		* Check profile image
		*/
		$('#profile_image').change(function(){
			checkImageSize('profile_image',IMAGE_UPLOAD_FILE_MAX_SIZE,'form','image_error_div');
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

		phoneNumValidate('userMobile','UserPhone_error','userPhone');
 
   });