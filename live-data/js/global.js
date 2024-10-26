function showSuccessMessageBottomRight(msg){
    noty({
		layout : 'bottomRight',
		theme : 'noty_theme_default',
		type : 'success',
		text: msg ,
		timeout : 10000,
		closeButton:true,
		animation : {
			easing: 'swing',
			speed: 150 // opening & closing animation speed
		}
    });
}

function showErrorMessageBottomRight(msg){
    noty({
        layout : 'bottomRight',
        theme : 'noty_theme_default',
        type : 'error',
        text: msg ,
        timeout : 10000,
        closeButton:true,
        animation : {
            easing: 'swing',
            speed: 150 // opening & closing animation speed
        }
    });
}

function showSuccessMessageTopRight(msg){
    noty({
        layout : 'topRight',
        theme : 'noty_theme_default',
        type : 'success',
        text: msg ,
        timeout : 10000,
        closeButton:true,
        animation : {
            easing: 'swing',
            speed: 150 // opening & closing animation speed
        }
    });
}

function showErrorMessageTopRight(msg){
    noty({
        layout : 'topRight',
        theme : 'noty_theme_default',
        type : 'error',
        text: msg ,
        timeout : 10000,
        closeButton:true,
        animation : {
            easing: 'swing',
            speed: 150 // opening & closing animation speed
        }
    });
}

function equalHeight(group) {
	tallest = 0;
	group.height('');
	group.each(function() {
		thisHeight = $(this).height();
		if (thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}


function blockedUI() {
	$(".loading-cntant").fadeIn(100);
}


function unblockedUI() {
	$(".loading-cntant").fadeOut(100);
}




/** ##########  Function for IntlTel Input  ########################*/
function phoneNumValidate(phone_field,error_box_id,valid_msg_id,dialCode){
    //  alert(phone_field)
    var telInput;
    telInput = $("#"+phone_field),
    
    errorMsg = $("#"+error_box_id),
    validfield = $("#"+valid_msg_id);
    // initialise plugin
    telInput.intlTelInput({
        utilsScript: WEBSITE_URL+"/js/admin/intl-tel-input/utils.js",
        formatOnDisplay : false,
		initialCountry : 'in',
    });
    var reset = function() {
        telInput.removeClass("error");
    };
    // on blur: validate
    telInput.blur(function() {
        if ($.trim(telInput.val())) {
            var countryData = telInput.intlTelInput("getSelectedCountryData");
             
            var countryCode = countryData.dialCode;
		    countryCode = "+" + countryCode; // convert 1 to +1
            if(countryCode != ''){
                 $('#'+dialCode).val(countryCode);
            }
            telInput.val(telInput.val());
            if(telInput.intlTelInput("getNumber")){
                $("#"+valid_msg_id).val(telInput.intlTelInput("getNumber"));
            }
            
        }
    }).trigger('blur');
    // on keyup / change flag: reset
    telInput.on("keyup change", reset);
}


/** ##########  Function for IntlTel Input  ########################*/
function phoneNumValidate_old(phone_field,error_box_id,valid_msg_id){

    var telInput;
    telInput = $("#"+phone_field),
    errorMsg = $("#"+error_box_id),
    validfield = $("#"+valid_msg_id);
    var isvalid_number = 0;

    // initialise plugin
    telInput.intlTelInput({
        utilsScript: WEBSITE_URL+"/js/admin/intl-tel-input/utils.js",
        formatOnDisplay : false,
		initialCountry : 'au',
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
            //alert(tesval); return;
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



function phoneNumValidate2(e, t, o) {
    var a, r, n;
    a = $("#" + e), r = $("." + t), n = $("#" + o);
    var l = 0;
    a.intlTelInput({
        utilsScript: WEBSITE_URL + "/js/intl-tel-input/utils.js",
        formatOnDisplay: !1,
        initialCountry: "au"
    });

    a.blur(function() {
        if ($.trim(a.val())) {
            var e = a.intlTelInput("isValidNumber");
            if (0 == e) return $(r).html(PLEASE_ENTER_VALID_MOBILE_NO), n.val(""), !1;
            if (1 == e) {
                var t = a.intlTelInput("getSelectedCountryData").dialCode;
                "" != (t = "+" + t) && $(".dial_code").val(t);
                var o = a.intlTelInput("getNumberType");
                return o != intlTelInputUtils.numberType.MOBILE && o != intlTelInputUtils.numberType.FIXED_LINE_OR_MOBILE || (l = 1), 0 == l ? ($(r).html(PLEASE_ENTER_VALID_MOBILE_NO), n.val(""), !1) : (a.val(a.intlTelInput("getNumber")), n.length && n.val(a.intlTelInput("getNumber")), $(r).html(""), !0)
            }
        }
    }).trigger("blur"), a.on("keyup change", function() {
        a.removeClass("error"), n.length && n.val("")
    }), a.keyup(function() {
        $.trim(a.val()) || $(r).html("")
    })
}


/** ##########  Function for  check image size validation  ######################## */
function checkImageSize(field_id,max_size,submit_type,error_field_id ='', pImage = ''){
    console.log(pImage);
    var field_id        = field_id;
    var allowed_size    = max_size * 1024 * 1024; //convert mb to kb
    var submit_type     = submit_type;
    var error_field_id  = error_field_id;
    var size            = parseFloat($("#"+field_id)[0].files[0].size).toFixed(2);

    if(size > allowed_size){
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
    }
    else{
        var files = !!$("#"+field_id)[0].files ? $("#"+field_id)[0].files : [];

        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){
            // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            reader.onloadend = function(){
                if(pImage == 'pMImage'){
                    $("#pMImage").html("<img src='" + this.result + "' class='profileImage' >");
                }else {
                    pImage = 'pImage';
                    $("#"+pImage).html("<img src='"+this.result+"' class='profileImage' >");
                }
               
            }
        }

        if(error_field_id != ''){
            $("#"+error_field_id).html('');
        }
        return true;
    }
}//end checkImageSize()





$(document).ready(function(){

	// $(window).resize(function() {
	// 	setTimeout(resizeequalheight(), 250);
	// });

	// $(window).on('load', function(event) {
 	// 	resizeequalheight();
	// });

	// setTimeout( resizeequalheight(), 250);


	// function resizeequalheight() {
	// 	if ($('.quote-inner-wrap p').length > 0) {
	// 		equalHeight($(".quote-inner-wrap p"));
	// 	}
	// }



	/* $('.autocomplete').select2().on('select2:select', function (e) {

		alert($(this).closest('form').attr('id'));
		alert($(this).attr('name'));

		$('#'+ $(this).closest('form').attr('id')).formValidation('addField', $(this).attr('name'));
	}); */





	$(document).on('click', '.confirm_box', function(e){
		url 				= $(this).attr('data-href');
		confirmMessage 		= $(this).attr('data-confirm-message');
		confirmHeading 		= $(this).attr('data-confirm-heading');

		 swal({
			title: confirmHeading,
			text: confirmMessage,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			closeOnConfirm: false
		}, function () {
		   window.location.replace(url);
		});

	});

});

function checkImageSizeType(field_id,max_size,submit_type,error_field_id ='', pImage = ''){
    var field_id        = field_id;
    var allowed_size    = max_size * 1024 * 1024; //convert mb to kb
    var submit_type     = submit_type;
    var error_field_id  = error_field_id;
    var size            = parseFloat($("#"+field_id)[0].files[0].size).toFixed(2);

    var fileName = $("#"+field_id)[0].files[0].name;
    var getExtension = fileName.split('.').pop().toLowerCase();

    var imageExtension = IMAGE_EXTENSION;
    var validImageTypes = imageExtension.split(',');

    if ($.inArray(getExtension, validImageTypes) < 0) {

    	var msg = IMAGE_EXTENSION_ERROR;

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
                $("#"+pImage).html("<img src='"+this.result+"' class='profileImage' >");
            }
        }

        if(error_field_id != ''){
            $("#"+error_field_id).html('');
        }
        return true;
    }
}//end checkImageSizeType()




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
                $("#"+pImage).html("<img src='"+this.result+"' class='profileImage' >");
            }
        }

        if(error_field_id != ''){
            $("#"+error_field_id).html('');
        }
        return true;
    }
}//end checkImageSizeType()





$(function() {
	$(document).on("click", ".alert_confirm_box", function(e) {
		var t = $(this).data("href"), o = $(this).data("alert");
        bootbox.confirm({
				message: o,
				buttons: { confirm: { className: "btn btn-primary" }, cancel: { className: "btn btn-primary btn_theme_blue_color" } },
				callback: function(e) { e && (blockedUI(), window.location.replace(t)) }
		});
	});
});


$(document).ready(function() {
	$('select.autocomplete').select2({ 'width': '100%'});
});

/**
* Function for show date picker
* @params field_id as id of dob field
* @params date_formate as date format
*/
function showDateInPast(field_id, date_formate){
  
    var currentDate = new Date();
    $('#'+field_id).bootstrapMaterialDatePicker({
        weekStart: 0, 
        format: date_formate,
        shortTime: false,
        date: true,
        time: false,
        maxDate: currentDate,
        autoclose : true,
    }).on('change', function(e, date) {
        $('#contactUsForm').formValidation('addField', 'dob');
        $('#applyUniversityForm').formValidation('addField', 'dob');
        $('#surveyForm').formValidation('addField', 'dob');
    }).on('open',function(e, date){ 
        $("body").addClass("body_scroll_off");
    }).on('close',function(e, date){
        $("body").removeClass("body_scroll_off");
    });

    


    
        
}
