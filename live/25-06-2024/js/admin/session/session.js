function open_model_box(modelId, popUpURL){
	$.ajax({
		type: "POST",
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
		beforeSend:function(){
			$("#overlay").show();
		},
		url: popUpURL,
		data: {wiziq_session_id:modelId},
		success: function(result){
			$("#overlay").hide();
			if(result){
				$("#studentCSVModal").html(result);
				$("#studentCSVModal").modal();
			}			
		}
	});
}

 

$(document).ready(function(){
	$("#subject_id").change(function(){
		var subject_id = $(this).val();
		$.ajax({
			url : getSubjectTopicUrl,
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			data:{'subject_id':subject_id},
			beforeSend:function(e){
				$("#overlay").show();
			},
			success: function(data){
				$("#overlay").hide();
				if(data.status == "success"){
					$('#topic_div').html(data.view);
					$('#topic_id').selectpicker();
				}
			}
		});
			
		
	});
});
