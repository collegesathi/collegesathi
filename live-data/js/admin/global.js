$(document).ready(function(){
	/** For tooltip */
	$('[data-toggle="tooltip"]').tooltip();

    $('.breadcrumb li:last-child').find("a").attr("onclick", "return false;");
    $('.breadcrumb li:last-child').find("a").css("pointer-events","none");


	$(document).on("click", ".changePhoto", function(){

		var relVal	=	$(this).attr('rel');

		if(relVal){
			var selectObject	=	$("."+relVal+" #profile_"+relVal);
		}
		else {
			var selectObject	=	$(".add-image #profile_image");
		}

		if(!selectObject.hasClass("added")){
			selectObject.trigger("click");
			selectObject.addClass("added");

			window.setTimeout(function(){
				selectObject.removeClass("added");
			},500);
		}
	});

})



/** ##########  Function for  check image size validation  ######################## */
function checkImageSize(field_id,max_size,submit_type,error_field_id ='', pImage = ''){
	var field_id 		= field_id;
	var allowed_size 	= max_size * 1024 * 1024; //convert mb to kb
	var submit_type 	= submit_type;
	var error_field_id 	= error_field_id;
	var size 			= parseFloat($("#"+field_id)[0].files[0].size).toFixed(2);

	if(size > allowed_size){
		var msg 		= "File size should not be greater than "+max_size+'MB. Please compress your file using online compression tools and try again.';

		if(submit_type == 'ajax'){
			$("#"+field_id).val('');
			showErrorMessageBottomRight(msg);
		}
		else{
			$("#"+field_id).val('');
			$("#"+error_field_id).html('');
			$("#"+error_field_id).html(msg);
		}
		return false;
	}
	else{
		var files = !!$("#"+field_id)[0].files ? $("#"+field_id)[0].files : [];

        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){
			// only image file
			var reader = new FileReader(); // instance of the FileReader
			reader.readAsDataURL(files[0]); // read the local file
			reader.onloadend = function(){
				if(pImage == ''){
					pImage = 'pImage';
				}
				$("#"+pImage).html("<img src='"+this.result+"' class='profileImage' >");
			}
        }

		if(error_field_id != ''){
			$("#"+error_field_id).html('');
		}
		return true;
	}
}//end checkImageSize()




function checkUserDocumentSizeType(field_id,max_size,submit_type,error_field_id ='', pImage = ''){
    var field_id        = field_id;
    var allowed_size    = max_size * 1024 * 1024; //convert mb to kb
    var submit_type     = submit_type;
    var error_field_id  = error_field_id;
    var size            = parseFloat($("#"+field_id)[0].files[0].size).toFixed(2);

    var fileName = $("#"+field_id)[0].files[0].name;
    var getExtension = fileName.split('.').pop().toLowerCase();

    var imageExtension = USER_DOCUMENT_EXTENSION;
    var validImageTypes = imageExtension.split(',');

    if ($.inArray(getExtension, validImageTypes) < 0) {

    	var msg = USER_FILE_EXTENSION_ERROR;

    	if(submit_type == 'ajax'){
            $("#"+field_id).val('');
            showErrorMessageBottomRight(msg);
        }
        else{
            $("#"+field_id).val('');
            $("#"+error_field_id).html('');
            $("#"+error_field_id).html(msg);
        }
        return false;

    } else if(size > allowed_size){
        var msg         = "File size should not be greater than "+max_size+'MB. Please compress your file using online compression tools and try again.';
        if(submit_type == 'ajax'){
            $("#"+field_id).val('');
            showErrorMessageBottomRight(msg);
        }
        else{
            $("#"+field_id).val('');
            $("#"+error_field_id).html('');
            $("#"+error_field_id).html(msg);
        }
        return false;

    } else {
        var files = !!$("#"+field_id)[0].files ? $("#"+field_id)[0].files : [];

        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){
            // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function(){
                if(pImage == ''){
                    pImage = 'pImage';
                }
               /* $("#"+pImage).html("<img src='"+this.result+"' class='profileImage' >");*/
            }
        }

        if(error_field_id != ''){
            $("#"+error_field_id).html('');
        }
        return true;
    }
}//end checkImageSizeType()




function phoneNumValidate2(e, t, o) {
    var a, r, n;
    a = $("#" + e), r = $("." + t), n = $("#" + o);
    var l = 0;
    a.intlTelInput({
        utilsScript: WEBSITE_URL + "/js/intl-tel-input/utils.js",
        formatOnDisplay: !1,
        initialCountry : 'in',
    });


	a.blur(function() {
        if ($.trim(a.val())) {
            var e = a.intlTelInput("isValidNumber");
            /*if (0 == e) return $(r).html(PLEASE_ENTER_VALID_MOBILE_NOXXXXXXXXX), n.val(""), !1;*/
            if (1 == e) {
                var t = a.intlTelInput("getSelectedCountryData").dialCode;
                "" != (t = "+" + t) && $(".dial_code").val(t);
            }
        }
    }).trigger("blur"), a.on("keyup change", function() {
        a.removeClass("error"), n.length && n.val("")
    }), a.keyup(function() {
        $.trim(a.val()) || $(r).html("")
    })
}



/** ##########  Function for IntlTel Input  ########################*/
function phoneNumValidate(phone_field,error_box_id,valid_msg_id){
    var telInput;
    telInput = $("#"+phone_field),
    errorMsg = $("#"+error_box_id),
    validfield = $("#"+valid_msg_id);
    var isvalid_number = 0;

    // initialise plugin
    telInput.intlTelInput({
        utilsScript: WEBSITE_URL+"/js/admin/intl-tel-input/utils.js",
        formatOnDisplay : false,
		initialCountry : 'in',
    });
    var reset = function() {
        telInput.removeClass("error");
        if(validfield.length) validfield.val("");
    };

    // on blur: validate
    telInput.blur(function() {
        //reset();
        if ($.trim(telInput.val())) {

            var tesval = telInput.intlTelInput("isValidNumber");

            if(tesval == false){
                $(".not_valid_mobile").html('Please enter valid mobile number.');
                validfield.val("");
                return false;
            }
			else if(tesval == true){
				var countryData = telInput.intlTelInput("getSelectedCountryData");
				var countryCode = countryData.dialCode;
				countryCode = "+" + countryCode; // convert 1 to +1
				if(countryCode != ''){
					$('.dial_code').val(countryCode);
				}
                var numberType = telInput.intlTelInput("getNumberType");
                if((numberType == intlTelInputUtils.numberType.MOBILE)  || (numberType == intlTelInputUtils.numberType.FIXED_LINE_OR_MOBILE)){
                    isvalid_number = 1;
                }
                if (isvalid_number==0) {
                    // is a mobile number
                    $(".not_valid_mobile").html('Please enter valid mobile number.');
                    validfield.val("");
                    return false;
                }
                telInput.val( telInput.intlTelInput("getNumber"));
                if(validfield.length)
                    validfield.val(telInput.intlTelInput("getNumber"));
                $(".not_valid_mobile").html('');
                return true;
            }
        }
    }).trigger('blur');


    // on keyup / change flag: reset
    telInput.on("keyup change", reset);

}



/** function used for equal height boxes starts here .
* @param null
*/
function resizeequalheight(){
	equalHeight($(".makeequal"));
}

function equalHeight(group) {
	tallest = 0;
	group.height('');
	group.each(function() {
	thisHeight = $(this).height();
	if(thisHeight > tallest) {
		tallest = thisHeight;
	}
	});
	group.height(tallest);
}


$(function(){
	$(window).resize(function() {
		setTimeout('resizeequalheight()',250)
	});
	setTimeout('resizeequalheight()',250)
});


/** function used for equal height boxes end here .
* @param null
*/
