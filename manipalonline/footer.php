<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-logo"><img src="images/manipal-whie-logo.webp" alt="image"></div>
				<p>Manipal University Jaipur (MUJ) was launched in 2011 on an invitation from the Government of
					Rajasthan. Manipal University started an online MBA, MCA, and BBA, and the first cohort of
					students’ classes began in April 2021. In addition to this, it will offer online BCom and MCom
					degrees in December 2021.</p>


			</div>
			<div class="col-md-4">

				<h2>More courses</h2>
				<ul class="footerlink">
					<li>BCA - Bachelor of Computer Application</li>
					<li>BBA - Bachelor of Business Administration</li>
					<li>B.COM - Bachelor of Commerce</li>
					<li>MBA - Master of Business Administration</li>
					<li>MCA - Master of Computer Application</li>
					<li>M.COM - Master of Commerce</li>
					<li>MJMC - Master of Journalism & Mass Communication</li>
				</ul>

			</div>
			<div class="col-md-4">
				<h2>Recognization & Approvals</h2>
				<p>University Grant commision (UGC) , National Institutional Ranking Framework (NIRF), All India
					Council for Technical Education (AICTE), The World University Ranking 2022</p>
			</div>
		</div>
		<div class="row mt-4">

			<div class="col-md-5">

				<h2>Contact Us</h2>
				<p>Main Campus, Library Building, Mahal, Jagatpura, Jaipur, Rajasthan – 302017</p>
			</div>
			<div class="col-md-4">
				<h2>Make A Step Towards A Success Journey</h2>
				<p><strong class="d-block">Have Any Query?</strong>
					Take Acaedmic Mentor Guidance</p>
			</div>
			<div class="col-md-3">
				<div class="request-call"><a href="#" class="btn btn-outline"><i class="fa fa-phone"></i>Request a
						Call Back</a></div>

			</div>

		</div>
		<p class="copyright">© Copyright Online Manipal University</p>
	</div>
</footer>

<script src="js/jquery-min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/wow.min.js"></script>
<!-- OTP IN HIDDEN -->
<input id="OTPCode" name="OTPCode" type="hidden" value="" /> 
<!-- OTP IN HIDDEN -->
<script>
	new WOW().init();
	$('.approvals-carousel').owlCarousel({
		loop: true,
		margin: 20,
		nav: false,
		responsive: {
			0: {
				items: 2,
				mouseDrag: true,
			},
			480: {
				items: 3,
				mouseDrag: true,
			},
			768: {
				items: 4,
				mouseDrag: true,
			},
			992: {
				items: 6,
				mouseDrag: true,
			},

			1199: {
				items: 8,
				mouseDrag: false,
			}
		}
	});

	$(".data-img-bg").css('background', function () {
		var bg = ('url(' + $(this).data("image-src") + ') no-repeat');
		return bg;
	});

	$(document).ready(function () {
		$('#nav-menus').click(function () {
			$(this).toggleClass('open');
			$('body').toggleClass('stop-scroll');
		});
	});
	$(document).on('click', '.anchor-link', function (e) {
		e.preventDefault();
		var target = this.hash,
			$target = $(target);
		$('html, body').stop().animate({
			'scrollTop': $target.offset().top - 0
		}, 600, 'swing', function () {
		});
	});

	$(document).ready(function () {
		$('.anchor-link').click(function () {
			$('.navbar-collapse').removeClass('show');
		});
	});
	
	
	
	
	function hideerr(){
		setTimeout(function(){
			$('.errormsg').fadeOut();
		}, 10000);
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
		else if($('.'+formname+' .course').val() == ''){
			$('.'+formname+' .frm_course_error').fadeIn();
			hideerr();
			return false;
		}
		else if($('.'+formname+' .state').val() == ''){
			$('.'+formname+' .frm_state_error').fadeIn();
			hideerr();
			return false;
		}
		else {
			$("."+formname+" .inputID").prop('disabled', true); //disable
			var formdata = new FormData($('.'+formname)[0]);
			
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
					$("."+formname+" .submitting_form").show();
				},
				success:function(result){			
					$("."+formname+" .inputID").prop('disabled', false);
				}
			});

			setTimeout(redirectToThanks, 1000);
		}
	}
	
	
	$(document).ready(function(){
		$('.servicefrm').submit(function(e){
			e.preventDefault();
			checkFormValidation('servicefrm');
		}); 
		
		$('.servicefrm_footer').submit(function(e){
			e.preventDefault();
			checkFormValidation('servicefrm_footer');
		});
	
		$(".servicefrm .submitting_form").hide();	
		$(".servicefrm_footer .submitting_form").hide();	
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

	function VerifyOTP(MobileClass) { 
		var txtbxotp = $(".txtotp"+MobileClass).val();
		if (txtbxotp == "" || txtbxotp == undefined)
		{
			swal("Please Enter OTP Code.");
		}
		else
		{
			var UEntry = $(".txtotp"+MobileClass).val();
			console.log('UEntry===',UEntry);
			var Real = $("#OTPCode").val();
			console.log('Real===',Real);
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