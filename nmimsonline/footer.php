<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://amityonline.com/lp/mba/js/Ipstackscript.js"></script>

<!-- OTP IN HIDDEN -->
<input id="OTPCode" name="OTPCode" type="hidden" value="" /> 
<!-- OTP IN HIDDEN -->

<script type="text/javascript">

	function hideerr(){
		setTimeout(function(){
			$('.errormsg').fadeOut();
		}, 5000);
	}
	
	 
	/* 
	function redirectToThanks() {
		<?php if($from_fb){ ?>
			var redirectURL = 'thanks.php?from_fb=true';
		<?php } else { ?> 
			var redirectURL = 'thanks.php';
		<?php } ?>
		window.location.href= redirectURL;
	} 
	*/
	function redirectToThanks() {
		<?php
		$redirectparams	=	[];
		$redirectStr	=	'';
		$redirectURL	=	"thanks.php";

		if ($from_fb == true) {
			$redirectparams['from_fb']	=	'true';
		}

		if ($source != "") {
			$redirectparams['source']	=	$source;
		}

		if ($source_campaign != "") {
			$redirectparams['source_campaign']	=	$source_campaign;
		}

		if ($source_medium != "") {
			$redirectparams['source_medium']	=	$source_medium;
		}
		
		if(!empty($redirectparams)){
			foreach($redirectparams as $redirectKey => $redirectValue){
				$redirectStr	.= 	$redirectKey.'='.$redirectValue.'&';	
			}
			
			/*REMOVE & ADDED IN LAST */
			$redirectStr	=	rtrim($redirectStr, "&");
		}

		if($redirectStr !=""){
			$redirectURL	=	$redirectURL.'?'.$redirectStr;
		}
		?>

		window.location.href= '<?php echo $redirectURL; ?>';
	}

	
	function checkFormValidation(formname){
		var filter 		= 	/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		var filter_two 	= 	/^[a-zA-Z\s-, ]+$/;
			
		if($('.'+formname+' .name').val() == ''){
			$('.'+formname+' .frm_name_error').fadeIn();
			hideerr();
			return false ;
		}
		else if (!(filter_two.test($('.'+formname+' .name').val()))){
			$('.'+formname+' .frm_name_error2').fadeIn();
			hideerr();
			return false;
		}
		else if($('.'+formname+' .email').val() == ''){
			$('.'+formname+' .frm_email_error').fadeIn();
			hideerr();
			return false;
		}
		else if (!(filter.test($('.'+formname+' .email').val()))){
			$('.'+formname+' .frm_email_error2').fadeIn();
			hideerr();
			return false ;
		}
		else if($('.'+formname+' .contactno').val() == ''){
			$('.'+formname+' .frm_contactno_error').fadeIn();
			hideerr();
			return false;
		}
		else if($('.'+formname+' .contactno').val().length < 10 || $('.'+formname+' .contactno').val().length > 10){
			$('.'+formname+' .frm_contactno_error2').fadeIn();
			hideerr();
			return false;
		}
		else if(!$.isNumeric($('.'+formname+' .contactno').val())){
			$('.'+formname+' .frm_contactno_error3').fadeIn();
			hideerr();
			return false;
		}
		else if($('.'+formname+' .city').val() == ''){
			$('.'+formname+' .frm_city_error').fadeIn();
			hideerr();
			return false;
		}
		else if ($('.'+formname+' .txtotp').val() == '' || $('.'+formname+' .txtotp').val() == undefined) {
			sweetAlert("Please verify with otp first!", "", "error").then(function () {
				swal.close();
				$('.'+formname+' .txtotp').focus();
			});
			return false;
		}
		else if ($('.'+formname+' .btnVerifySuccess').is(":hidden")) {
			sweetAlert("Please verify your otp first!", "", "error").then(function () {
				swal.close();
				$('.'+formname+' .txtotp').focus();
			});
			return false;
		}
		// else if($("#chkbox").prop('checked') == false) {
		// 	$('.'+formname+' .frm_chkbox_error').fadeIn();
		// 	hideerr();
		// 	return false;
		// }
		else {
			$("."+formname+" .inputID").prop('disabled', true); //disable
			var formdata = new FormData($('.'+formname)[0]);
			console.log('fok====',formdata);
			$.ajax({
				url:'send_email.php',
				type: "POST",
				data: formdata,
				dataType:'json',
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					$("."+formname+" .online-mba-submit").hide();
					$("."+formname+" .online-mba-submiting-form").show();
				},
				success:function(result){			
					$("."+formname+" .inputID").prop('disabled', false);
				}
			});

			//setTimeout(redirectToThanks, 1000);
		}
	}

	 
	// $(document).ready(function(){ 
	// 	$('.servicefrm').submit(function(e){
	// 		e.preventDefault();
	// 		checkFormValidation('servicefrm');
	// 	}); 
		
		
	// 	$(".online-mba-submiting-form").hide();
		
	// });		
 
	function SendOTP(MobileClass) {
		var Mobile = $('.'+MobileClass).val();
		if (Mobile != "" && Mobile.length == 10) {
			$.ajax({
				url: "checkSms2.php",
				data: { Mobile : Mobile } ,
				type: 'POST',
				dataType: 'json',
				success: function (result) {
					/* if (result.type == "success") { */
						$("#OTPCode").val(result.OTP);
						sweetAlert("We have sent 4 digits verification code to your given mobile.", "", "success").then(function () {
							$("#OTPCode").val();
							$(".txtotp"+MobileClass).removeAttr("disabled");
							$('.txtotp'+MobileClass).focus();
						});
					/* }	 */	
				},
				error: function () {
					swal("Error  : otp not sent");
				}
			});
		}
	}


    // Listen for changes in the OTP input field
    $('#dvotp').on('input', function() {
		var txtbxotp = $(".txtotpmobile01").val();
		console.log('otp====>',txtbxotp);    
        if (txtbxotp.length === 4) {        
            verifyOTP(txtbxotp);
        }
    });

	function verifyOTP(otpValue) { 
		console.log('---->');
		var txtbxotp = otpValue;
		if (txtbxotp == "" || txtbxotp == undefined)
		{
			swal("Please Enter OTP Code.");
		}
		else
		{
			var UEntry = otpValue;
			var Real = $("#OTPCode").val();
			if (UEntry == Real) {
				Success = 1;
				submitForm();
			}
			else {
				Success = 0;
				swal("Please Enter Valid OTP Code.");
			}
		}
	}

	function submitForm() {
			//$("."+servicefrm+" .inputID").prop('disabled', true); //disable
			var formdata = new FormData($('.servicefrm')[0]);
			console.log('fok====',formdata);
			$.ajax({
				url:'send_email.php',
				type: "POST",
				data: formdata,
				dataType:'json',
				cache: false,
				contentType: false,
				processData: false,
				// beforeSend: function () {
				// 	$("."+formname+" .online-mba-submit").hide();
				// 	$("."+formname+" .online-mba-submiting-form").show();
				// },
				success:function(result){			
					$("."+servicefrm+" .inputID").prop('disabled', false);
				}
			});

			setTimeout(redirectToThanks, 1000);
		}

	// function ResendCode(MobileClass) {
	// 	SendOTP(MobileClass);
	// }
	
	
	function OnlyAlphaValidationWithSpace(e) {
		if (navigator.appName.toLowerCase() == 'netscape') {
			var key1;
			var keychar1;
			key1 = e.which;
			keychar1 = String.fromCharCode(key1);
			if ((key1 == null) || (key1 == 0) || (key1 == 8) || (key1 == 9) || (key1 == 27) || (key1 == 46) || (key1 == 22)) {
				return true;
			}
			else if ((("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ").indexOf(keychar1) > -1)) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			key1 = e.keyCode;
			keychar1 = String.fromCharCode(key1);
			if ((key1 == null) || (key1 == 0) || (key1 == 8) || (key1 == 9) || (key1 == 27) || (key1 == 46) || (key1 == 22)) {
				return true;
			}
			else if ((("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ").indexOf(keychar1) > -1)) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	
	
	$('.owl-carousel2').owlCarousel({
		loop:true,
		margin:10,
		responsiveClass:true,
		autoplay:false,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			600:{
				items:1,
				nav:true
			},
			1000:{
				items:1,
				nav:true,
				loop:true
			}
		}
	});
		
	$('.alumni-carousel').owlCarousel({
		loop:true,
		margin:10,
		responsiveClass:true,
		autoplay:true,
		responsive:{
			0:{
				items:2,
				nav:true
			},
			600:{
				items:3,
				nav:true
			},
			767:{
				items:4,
				nav:true
			},
			992:{
				items:6,
				nav:true,
				loop:true
			}
		}
	});

	$(document).ready(function () {
		$(document).on("scroll", onScroll);
 
		$('a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			$(document).off("scroll");

			$('a').each(function () {
				$(this).removeClass('active');
			})
			$(this).addClass('active');

			var target = this.hash,
				menu = target;
			$target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top+2
			}, 500, 'swing', function () {
				window.location.hash = target;
				$(document).on("scroll", onScroll);
			});
		});
	});

	function onScroll(event){
		var scrollPos = $(document).scrollTop();
		$('#menu-center a').each(function () {
			var currLink = $(this);
			var refElement = $(currLink.attr("href"));
			if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
				$('#menu-center ul li a').removeClass("active");
				currLink.addClass("active");
			}
			else{
				currLink.removeClass("active");
			}
		});
	}
	
	
	function isNum(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
		$(document).on('input', '#txtContact', function () {
			var phone = $('#txtContact').val();
			if(!isNaN(phone)){
		   // console.log(phone);
			console.log(phone.indexOf('0'));
		 //alert(phone.indexOf('0'));
			if (phone.indexOf('0') == 0) {
				sweetAlert("First digit cannot be zero!", "", "error").then(function () {
					swal.close();
					$('#txtContact').val('');
					$('#txtContact').focus();
				});
				return false;
			}
			}else{ 
			   sweetAlert("Please enter a valid number!", "", "error").then(function () {
					swal.close();
					$('#txtContact').val('');
					$('#txtContact').focus();
				});
			}
		   
		});
	}
</script>