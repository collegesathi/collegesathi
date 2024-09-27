$(document).ready(function(){
	
	/** For tooltip */
	$('[data-toggle="tooltip"]').tooltip();   
	
	
	
	showStartEndDateFuture('startdate', 'lastdate', cal_date_format);
	
	
	var discount_type	=	$('#discount_type').val();
	if(discount_type == 'percentage'){
		$('#max_discount').show();
	}
	else{
		$('#max_discount').hide();
	}


	$(document).on('change','#discount_type',function(){
		var discount	=	$(this).val();
		if(discount == 'percentage'){
			$('#max_discount').show();
		}
		else{
			$('#max_discount').hide();
		}
	});

	/* quantity div hide and show */
	var user_limit = $('#usage_limit').val();
	if(user_limit == N_TIME_USEAGE_LIMIT){
		$('#quantity_div').show();
	}
	else{
		$('#quantity_div').hide();
	}

	$(document).on('change','#usage_limit',function(){
		var discount	=	$(this).val();
		if(discount == N_TIME_USEAGE_LIMIT){
			$('#quantity_div').show();
		}
		else{
			$('#quantity_div').hide();
		}
	});
	/* quantity div hide and show */
	
	
	/** For genrate coupon */
    $(".random_code").click(function(){
		randomString();
	});
	
	
	$('#sendMailPopup').on('hidden.bs.modal', function () {
       $('form')[0].reset();
       $('.email_err').html('');
       $('#sendCouponMailBtn').attr("disabled", false);
    });
	
	
	$('#itemList').on("change", function(e) {
		$('#sendCouponMailBtn').attr("disabled", false);
	});
	
	
});
	 

/** For open email popup **/
function getPopupClient(couponID){
	$('#couponID').val(couponID);
	$("#sendMailPopup").modal('show');
};

 
/** For send email to buyers **/
function sendCouponMailToUser(btnId){
	$('#'+btnId).attr("disabled", true);
	var emails = $('#itemList').val();
	
	if(emails == null){
		$('.email_err').html('Please select email.');
	}else{
		$.ajax({
			type 		: 	"POST",
			url  		: 	sendCouponMail,
			headers		: 	{ 'X-CSRF-TOKEN': csrf_token },
			data		:	$("#sendCouponMailForm").serialize(),
			beforeSend	: 	function(xhr) {
				$('#overlay').show();
			},
			success : function(data){
				$('#overlay').hide();
				if(data.status == "success"){
					window.location.reload();
				}else{
					$('.email_err').html(data.msg);
				}
			}
		});
	}	
}
	

/** For genrate coupon */	
function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZ";
	var string_length = 8;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	$('#DealDiscountPromoCode').val(randomstring);
}
