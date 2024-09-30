$(document).ready(function(){

	$(document).on('change','#country',function(){

			$.ajax({
				url		: getStateUrl,
				data	: {'country_id' : $("#country").val()},
				headers	: { 'X-CSRF-TOKEN': csrf_token },
				type	: "POST",
				beforeSend:function(){
					$("#overlay").show();
				},
				success: function(res){
					$("#overlay").hide();
					$('#state_div').html(res.html);
					$('#city_div').html(res.cityHtml);
					$('#state').selectpicker();
					$('#city').selectpicker();

				}
			});
	});
	
 
	/* for getting city list*/
	$(document).on('change','#state',function(){
		country_id	=	$("#country").val();

		$.ajax({
			url		: getCityUrl,
			data	: {'country_id' : country_id ,'state_id' : $("#state").val()},
			headers	: {'X-CSRF-TOKEN': csrf_token },
			type	: "POST",
			beforeSend:function(){
				$("#overlay").show();
			},
			success: function(res){
				$("#overlay").hide();
				$('#city_div').html(res.html);
				$('#city').selectpicker();
			}
		});
	});
});

