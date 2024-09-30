<footer>
	<div class="container">
		<div class="footer d-md-flex justify-content-between">
			<ul>
				<li>
					<figure><img src="images/logofooter.svg" alt="logo"></figure>
				</li>
				<li><strong>Made in India <img src="images/flag-image.png" alt="image"></strong></li>
				<li><a target="_blank" href="https://www.facebook.com/collegesathi/"><i class="fa fa-facebook" aria-hidden="true"></i>
					</a> <a target="_blank" href="https://www.youtube.com/@collegesathi"><i class="fa fa-linkedin" aria-hidden="true"></i>
					</a> <a target="_blank" href="https://www.instagram.com/collegesathicom/"><i class="fa fa-instagram" aria-hidden="true"></i>
					</a></li>

			</ul>

			<div class="hurry-up-area">
				<figure><img src="images/hurry-images.svg" alt="image"></figure>
				<p> only few seats left.<br>
					Reserve your seat now.</p>

			</div>
		</div>
	</div>

	<div class="copyrite text-left">
		<div class="container">
			<p>© 2024 All Rights Reserved. | <a href="privacy-policy.php" target="_blank">Privacy Policy</a></p>
		</div>
	</div>

</footer>

<!-- Modal -->
<button type="button" class="enquire-btn" data-bs-toggle="modal" data-bs-target="#exampleModal_uni">
	Enquire Now
</button>


<div class="modal fade" id="exampleModal_uni" tabindex="-1" aria-labelledby="exampleModalLabel_uni" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="Inquire-head">
					<h2>Inquire Now</h2>
					<div class="admission-number"> Admission Number : <span><a href="tel:18008911987">18008911987</a></span></div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="inquire-form">
					<form class="popupinquire" name="popupinquire">
					<input type="hidden" id="mx_Website_Page" name="mx_Website_Page" value="Pop up Enquire Now">
						<?php
$mobileTextClass = 'mobile02';
include 'form_with_university.php';?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="Inquire-head">
					<h2>Inquire Now</h2>
					<div class="admission-number"> Admission Number: <span><a href="tel:18008911987">18008911987</a></span></div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="inquire-form">
					<form class="universitiesPopupinquire" name="popupinquire">
					<input type="hidden" id="mx_Website_Page" name="mx_Website_Page" value="Pop up Enquire Now">
						<?php
							$mobileTextClass = 'mobile03';
							include 'form.php';?>
						<input type="hidden" name="mx_University_Name" class="university_name" value="">
						<input type="hidden" name="pdf_name" class="pdf_name" value="">
						<input type="hidden" name="download_broch" class="download_broch" value="no">

					</form>
				</div>
			</div>
		</div>
	</div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom-script.js"></script>

<!-- OTP IN HIDDEN -->
<input id="OTPCode" name="OTPCode" type="hidden" value="" />
<!-- OTP IN HIDDEN -->

<script type="text/javascript">

	$(".data-img-bg").css('background', function () {
		var bg = ('url(' + $(this).data("image-src") + ') no-repeat');
		return bg;
	});

	$(document).ready(function () {
		$('#nav-menus').click(function () {
			$(this).toggleClass('open');
			$('body').toggleClass('stop-scroll');
		});


		$('.contactno, #contactno').keyup(function () {
			this.value = this.value.replace(/[^0-9\.]/g,'');
		});

	});

	$(document).on('click', '.anchor-link', function (e) {
		e.preventDefault();
		var target = this.hash,
			$target = $(target);
		$('html, body').stop().animate({
			'scrollTop': $target.offset().top - 0
		}, 1200, 'swing', function () {
		});
	});

	$(".btn-close").click(function() {
		$(".popupinquire")[0].reset();
	});

	$(".online-mba-submiting-form").hide();
	$(".online-counsel-submiting-form").hide();

	function hideerr(){
		setTimeout(function(){
			$('.errormsg').fadeOut();
		}, 5000);
	}


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

	function redirectToThanksnew() {
		<?php
		$redirectparams	=	[];
		$redirectStr	=	'';
		$redirectURL	=	"thanks_footer.php";

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
		else if($('.'+formname+' .specialization').val() == ''){
			$('.'+formname+' .frm_specialization_error').fadeIn();
			hideerr();
			return false;
		}
		else if($('.'+formname+' .mx_University_Name').val() == ''){
			$('.'+formname+' .frm_university_error').fadeIn();
			hideerr();
			return false;
		}
		else if($('.'+formname+' .city').val() == ''){
			$('.'+formname+' .frm_city_error').fadeIn();
			hideerr();
			return false;
		} else if ($('.'+formname+' .txtotp').val() == '' || $('.'+formname+' .txtotp').val() == undefined) {
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
		else {
			$("."+formname+" .inputID").prop('disabled', true); //disable
			var formdata = new FormData($('.'+formname)[0]);

			var universityName 	=	$("#exampleModal .modal-content form .university_name").val();
			var downloadBroch 	=	$("#exampleModal .modal-content form .download_broch").val();

			/* formdata.mx_University_Name	=	universityName; */
			formdata.download_broch		=	downloadBroch;

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
					$("."+formname+" .inputID").prop('disabled', false); //enable
				}
			});


			/** FOR DOWNLOAD PDF Brochure
			if(formname == 'popupinquire'){
				var universityName 	=	$("#exampleModal .modal-content form .university_name").val();
				var downloadBroch 	=	$("#exampleModal .modal-content form .download_broch").val();

				if((downloadBroch == 'yes') && (universityName != '')){
					var link 		= 	document.createElement('a');
					var url 		= 	'/online-all-mba-colleges-india/pdf/'+universityName+'.pdf';
					link.href 		= 	url;
					link.setAttribute('target', '_blank');
					link.download 	=	"file_" + new Date() + ".pdf";
					link.click();
					link.remove();
				}
			}
			*/

			setTimeout(redirectToThanks, 1500);
		}
	}


	$(document).ready(function(){
		$(".university_list").click(function(){
			var test = $(this).attr('rel');
			$("#exampleModal .modal-content form .university_name").val(test);
			$("#exampleModal .modal-content form .pdf_name").val('');
			$("#exampleModal .modal-content form .download_broch").val("no");
		})

		$(".download_brochure").click(function(){
			var test = $(this).attr('rel');
			var pdfName = $(this).attr('data-pdf-name');
			$("#exampleModal .modal-content form .university_name").val(test);
			$("#exampleModal .modal-content form .pdf_name").val(pdfName);
			$("#exampleModal .modal-content form .download_broch").val("yes");
		})

		$('.servicefrm').submit(function(e){
			e.preventDefault();
			checkFormValidation('servicefrm');
		});

		$('.popupinquire').submit(function(e){
			e.preventDefault();
			checkFormValidation('popupinquire');
		});

		$('.universitiesPopupinquire').submit(function(e){
			e.preventDefault();
			checkFormValidation('universitiesPopupinquire');
		});


		$('.talk-expert').submit(function(e){
			e.preventDefault();
			var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
			var filter_two = /^[a-zA-Z\s-, ]+$/;
			if($('#fname').val() == ''){
				$('#form_fname_error').fadeIn();
				hideerr();
				return false ;
			}
			else if (!(filter_two.test($('#fname').val()))){
				$('#form_fname_error2').fadeIn();
				hideerr();
				return false;
			}
			else if($('#lname').val() == ''){
				$('#form_lname_error').fadeIn();
				hideerr();
				return false ;
			}
			else if (!(filter_two.test($('#lname').val()))){
				$('#form_lname_error2').fadeIn();
				hideerr();
				return false;
			}
			else if($('#email').val() == ''){
				$('#form_email_error').fadeIn();
				hideerr();
				return false;
			}
			else if (!(filter.test($('#email').val()))){
				$('#frm_email_error2').fadeIn();
				hideerr();
				return false ;
			}
			else if($('#contactno').val() == ''){
				$('#form_contactno_error').fadeIn();
				hideerr();
				return false;
			}
			else if($('#contactno').val().length < 10 || $('#contactno').val().length > 10){
				$('#form_contactno_error2').fadeIn();
				hideerr();
				return false;
			}
			else if(!$.isNumeric($('#contactno').val())){
				$('#form_contactno_error3').fadeIn();
				hideerr();
				return false;
			}

			else if($('#mx_University_Name').val() == ''){
				$('#form_university_error').fadeIn();
				hideerr();
				return false;
			}
			else{
				$(".talk-expert .inputID").prop('disabled', true); //disable
				var formdata = new FormData($('.talk-expert')[0]);
				$.ajax({
					url:'send_email_footer.php',
					type: "POST",
					data: formdata,
					dataType:'json',
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function () {
						$(".online-counsel-submit").hide();
						$(".online-counsel-submiting-form").show();
					},
					success:function(result){					

						$(".talk-expert .inputID").prop('disabled', false); //enable
					}
				});

				setTimeout(redirectToThanksnew, 2000);
			}
		});
	});

        function SendOTP(MobileClass) {

            var Mobile = $('.'+MobileClass).val();
            if (Mobile != "" && Mobile.length == 10) {
                $.ajax({
                    url: "checkSms2.php",
                    data: { Mobile : Mobile } ,
                    type: 'POST',
                    dataType: 'json',
                    success: function (result) {
						if (result.type == "success") {
							$("#OTPCode").val(result.OTP);
							sweetAlert("We have sent 4 digits verification code to your given mobile.", "", "success").then(function () {
								$("#OTPCode").val();
								$(".txtotp"+MobileClass).removeAttr("disabled");
								$('.txtotp'+MobileClass).focus();
							});
						}
                    },
                    error: function () {
                        swal("Error  : otp not sent");
                    }
                });
            }
            else {
            //  swal("Please select Qualification");
            }
        }

        function VerifyOTP(MobileClass) {

            var txtbxotp = $(".txtotp"+MobileClass).val();
            if (txtbxotp == "" || txtbxotp == undefined)
            {
                swal("Please Enter OTP Code.");
            }
            else
            {
                var UEntry = $(".txtotp"+MobileClass).val();
                var Real = $("#OTPCode").val();
                if (UEntry == Real) {
                    Success = 1;
                    $("#btnVerify"+MobileClass).hide();
                    $("#btnResend"+MobileClass).hide();
                    $("#btnVerifySuccess"+MobileClass).show();
                }
                else {
                    Success = 0;
                    swal("Please Enter Valid OTP Code.");
                }
            }
        }

		function ResendCode(MobileClass) {
            SendOTP(MobileClass);
        }
</script>