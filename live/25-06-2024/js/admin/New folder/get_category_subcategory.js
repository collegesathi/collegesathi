$(document).ready(function(){
	/* for getting state list*/
	$(document).on('change','#catagory_id',function(){ 
		$.ajax({
			url		: getSubCategoryUrl,
			data	: {'category_id' : $("#catagory_id").val()},
			headers	: { 'X-CSRF-TOKEN': csrf_token },
			type	: "POST",
			beforeSend:function(){
				$("#overlay").show();
			},
			success: function(res){
				$("#overlay").hide();
				$('#sub_category_id_div').html(res.html);
				$('#sub_category_id').selectpicker();
			}
		});	
	});
});
	
