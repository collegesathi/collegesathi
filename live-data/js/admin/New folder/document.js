$(function(){
	$(document).on('click', '#price_save', function(e){
			$.ajax({
				url		: addDocumentPriceUrl,
				data	: $("#document_price").serialize(),
				headers	: { 'X-CSRF-TOKEN': csrf_token },
				type	: "POST",
				beforeSend:function(){
					$("#overlay").show();
				},
				success: function(res){
				if(res.status == "error"){ 
					$( ".error-message").empty(); 
					$.each(res.errors, function( index, value ) { 
						  $("."+index ).html(value);
					});	
				}else{
						window.location.reload(true);
				}
				}
			});
	});
	
	
	$(document).on('click', '#reason_save', function(e){
			$.ajax({
				url		: addDocumentRejectReasonUrl,
				data	: $("#document_reject").serialize(),
				headers	: { 'X-CSRF-TOKEN': csrf_token },
				type	: "POST",
				beforeSend:function(){
					$("#overlay").show();
				},
				success: function(res){
				if(res.status == "error"){ 
					$( ".error-message").empty(); 
					$.each(res.errors, function( index, value ) { 
						  $("."+index ).html(value);
					});	
				}else{
						window.location.reload(true);
				}
				}
			});
	});
});



