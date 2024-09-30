$(document).on('ready', function() {
  
  // rqual height 
	equalheight = function(container){

	var currentTallest = 0,
		 currentRowStart = 0,
		 rowDivs = new Array(),
		 $el,
		 topPosition = 0;
	 $(container).each(function() {

	   $el = $(this);
	   $($el).height('auto')
	   topPostion = $el.position().top;

	   if (currentRowStart != topPostion) {
		 for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		   rowDivs[currentDiv].height(currentTallest);
		 }
		 rowDivs.length = 0; // empty the array
		 currentRowStart = topPostion;
		 currentTallest = $el.height();
		 rowDivs.push($el);
	   } else {
		 rowDivs.push($el);
		 currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
	  }
	   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		 rowDivs[currentDiv].height(currentTallest);
	   }
	 });
	 
	}

	$(window).load(function() {
		equalheight('.column');
	});
	$(window).resize(function(){
		equalheight('.column');
	});
	
  
  // Student Reviews slider code
  
  $(".regular").slick({
	dots: false,
	autoplay: false,
	infinite: true,
	slidesToShow: 3,
	slidesToScroll: 1,
	responsive: [
	{
	  breakpoint: 1024,
	  settings: {
		slidesToShow: 3,
		slidesToScroll: 1,
		infinite: true,
		dots: true
	  }
	},
	{
	  breakpoint: 750,
	  settings: {
		slidesToShow: 2,
		slidesToScroll: 1
	  }
	},
	{
	  breakpoint: 600,
	  settings: {
		slidesToShow: 2,
		slidesToScroll: 1
	  }
	},
	{
	  breakpoint: 480,
	  settings: {
		slidesToShow: 1,
		slidesToScroll: 1
	  }
	}
  ]
  });
 
	
	
	// mobile menu
	$('#nav-icon').click(function(){
		$(this).toggleClass('open');$('.social-icon-bg').slideToggle();
	});
	
	// sticky header
	 $(window).on('scroll', function() {
	   var scroll = $(window).scrollTop();
	   if (scroll >= 300) {
		   $("header").addClass("fixed-header");
	   } else { 
		   $("header").removeClass("fixed-header");
	   }
	});
	
	
	// careers option accordion
	//$(".demo-accordion").accordionjs();	
	
	
function hideerr(){
	setTimeout(function(){ 
		$('.errormsg').fadeOut();
	}, 3000);
}
$('#togglediv').on('click', '#btn-submit', function(e) {	
		e.preventDefault();
		var regex = /^[6789]\d{9}$/ ;
		var regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var name = $('#name').val();
		var email = $('#email').val() ; 
		var mobile = $('#contactno').val() ;
		var city = $('#city').val() ;
		var center = $('#center').val() ;
		var chk = $("#chkbox-check").prop('checked');
		if(name==""){
			$('#frm_name_error').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		} else if(email==""){
			$('#frm_email_error').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if(regexEmail.test(email)== false){
			$('#frm_email_error2').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		} 
		else if(mobile==""){
			$('#frm_contactno_error').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if(mobile.length != 10){
			//alert('10');
			$('#frm_contactno_error2').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if(regex.test(mobile) == false){
			//alert('987');
			$('#mobile-error').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if(city==""){
			$('#frm_city_error').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if(center==""){
			$('#frm_regional_error').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if(chk==false){
			$('#chkbox-check-msg').show(1).delay(1500).hide(1);
			hideerr();
			return false;
		}else if($('#chkbox-check').is(":not(:checked)")){			
			$('#chkbox-check-msg').fadeIn();
			hideerr();
			return false ;
		}else{
			var formdata = new FormData($('#servicefrm')[0]);
			$('#btn-submit').prop("disabled", true);
			$('#btn-submit').css("opacity", "0.3");
			$('#btn-submit').css("cursor", "not-allowed");
			$.ajax({
			url:'send-data-from.php',
			type: "POST",
			data: formdata,
			dataType:'json',			
			cache: false,
			contentType: false,
			processData: false,
			success:function(html){
				// alert(html.LeadId);
				//console.log(html);
				window.location='thank-you.php?LeadId='+html.LeadId;
			}		
			});
		}

		/*var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if($('#togglediv').find('#name').val() == ''){
			//$('#Frm_name_error').show();
			$('#frm_name_error').fadeIn();
			hideerr();
			return false ;
		}else if($('#email').val() == ''){  
			$('#frm_email_error').fadeIn();
			hideerr();
			return false ;
		}else if (!(filter.test($('#email').val()))){
			$('#frm_email_error').fadeIn();
			hideerr();
			return false ;
		}else if($('#contactno').val() == ''){
			$('#frm_contactno_error').fadeIn();
			hideerr();
			return false;
		}else if($('#contactno').val().length < 10 || $('#contactno').val().length > 10){
			$('#frm_contactno_error').fadeIn();
			hideerr();
			return false;
		}else if($('#otpID').val() == ''){
			$('#frm_otp_error').fadeIn();
			hideerr();
			return false;
		}else if($('#city').val() == ''){
			$('#frm_city_error').fadeIn();
			hideerr();
			return false ;
		}else if($('#center').val() == ''){
			$('#frm_regional_error').fadeIn();
			hideerr();
			return false ;
		}else if($("#chkbox-check").prop('checked') == false){
			$('#chkbox-check-msg').fadeIn();
			hideerr();
			return false ;
		}else{
			var formdata = new FormData($('#servicefrm')[0]);
			$.ajax({
			url:'send-data-from.php',
			type: "POST",
			data: formdata,
			dataType:'json',			
			cache: false,
			contentType: false,
			processData: false,
			success:function(html){
				//alert(html.LeadId);
				//console.log(html);
				window.location='thank-you.php?LeadId='+html.LeadId;
			}		
			});
		}*/
});
$('#togglediv').on('change', '#otpID', function() {
		$('#fail-error').hide();
		$('#sucess-error').hide();
		var otpAdded = $('#otpID').val();
		$.ajax({
				type:'post',
				url: "verifyotp.php",
				dataType: 'text',
				data:{otpAdded:otpAdded},
				success: function(result){
					if(result != 0){
						$('#frm_otp_error').show(1).delay(1500).hide(1);
					}else{
						$('#sucess-otp-error').hide();
						$('#sucess-error').show();
						$('#btn-submit').prop("disabled", false);
						$('#btn-submit').css("background", "#d02630");
						$('#btn-submit').css("opacity", "1");
						$('#btn-submit').css("cursor", "pointer");
					}
				}
		});
		
});

      $(document).ready(function() {
         //$('.js-example-basic-single').select2();
		 $('#togglediv').on('change', '#city', function() {
				sstate = $(this).val();
				changecity(sstate);
		});
         
      });
      function changecity(state){
          
		var citys =$('#city').val();
		if(citys.trim()==''){
			$('#togglediv').find('#center').append('<option value="">Select center</option>');
		}else{
         $('#togglediv').find('#center').html('');
         $('#togglediv').find('#center').append('<option value="">Select center</option>');
         for(i=0; i<data.length; i++){
            if(state == data[i].state){
               $('#togglediv').find('#center').append('<option value="'+data[i].value+'">'+data[i].name+'</option>');
            }
         }}
      }
/*  */
$('#togglediv').on('click', '#btn-Generate', function() {
		var regex = /^[6789]\d{9}$/ ;
		var regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var name = $('#name').val();
		var email = $('#email').val() ; 
		var mobile = $('#contactno').val() ;
		if(name==""){
			$('#frm_name_error').show(1).delay(1500).hide(1);
			return false;
		} else if(email==""){
			$('#frm_email_error').show(1).delay(1500).hide(1);
			return false;
		}else if(regexEmail.test(email)== false){
			$('#frm_email_error2').show(1).delay(1500).hide(1);
			return false;
		} 
		else if(mobile==""){
			$('#frm_contactno_error').show(1).delay(1500).hide(1);
			return false;
		}else if(mobile.length != 10){
			//alert('10');
			$('#frm_contactno_error2').show(1).delay(1500).hide(1);
			return false;
		}else if(regex.test(mobile) == false){
			//alert('987');
			$('#mobile-error').show(1).delay(1500).hide(1);
			return false;
		
		}
		else{
			$('#name-error').hide();
			$('#mobile-error').hide();
			$('#mobile-error').hide();
			var otpmy;
			$.ajax({
				type:'post',
				url: "otp.php",
				dataType: 'text',
				data:{mobile:mobile},
				success: function(result){
					  $('#sucess-otp-error').show();
				}
			});
			
		}
		
});

$('#togglediv').on("keypress","#contactno",numbersonly);

function numbersonly(e){
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
	if (unicode<48||unicode>57) //if not a number
	return false //disable key press
	}
}
$('#togglediv').on('keypress','#name',function(e) {
e = e || window.event;
var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
var charStr = String.fromCharCode(charCode);
if (/\d/.test(charStr)) {
return false;
}



});
$('#togglediv').on('keyup','#name',function()
{
var yourInput = $(this).val();
re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
var isSplChar = re.test(yourInput);
if(isSplChar)
{
var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
$(this).val(no_spl_char);
}
});
});

