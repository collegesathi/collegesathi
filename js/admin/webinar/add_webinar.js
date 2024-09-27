$(document).ready(function(){
		
		
	if($("#starttime").length){
		$("#starttime").on('change', function(e){
			
			var start_time = $("#starttime").val();
		
			getEndTime(start_time);
		});
	}
		
	/** For tooltip */
	$('[data-toggle="tooltip"]').tooltip(); 
	
	
	/**
	* Check profile image
	*/
	$('#profile_image').change(function(){
		checkImageSize('profile_image',IMAGE_UPLOAD_FILE_MAX_SIZE_TWO,'form','image_error_div');
	});
	
	
	/** For webinar date  */	
	$('#webinar_date').bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: js_date_format,
		autoclose : true,
		shortTime: false,
		date: true,
		time: false,
		minDate : moment().add(1, "days"),
	});
		
		
	/** For end time  */		
	showStartEndTimePicker('start_time', 'end_time', JS_HOURS_MINUTES_FORMAT, false, true);
	
	/** For amount field  */
	showAmountField($("#is_paid").val()); 
	 
	$("#is_paid").change(function(e){
		var is_paid	=	$(this).val();
		showAmountField(is_paid);
	});
	
	
	showPrerecordedUrlField($("#webinar_type").val());
	
	$("#webinar_type").change(function(e){
		var webinar_type	=	$(this).val();
		showPrerecordedUrlField(webinar_type);
	});
	
	
	$('.custom-file-upload input[type="file"]').change(function(e){
		$(this).siblings('input[type="text"]').val(e.target.files[0].name);
	});
    
	
});



function showAmountField(is_paid){
	if(is_paid == paid){
		$("#amount_div").show();
	}
	else {
		$("#amount_div").hide();
	}
}


function showPrerecordedUrlField(webinar_type){
	if(webinar_type == prerecorded){
		$("#prerecorded_url_div").show();
		$("#end_time_div").hide();
	}
	else {
		$("#prerecorded_url_div").hide();
		$("#end_time_div").show();
	}
}


/* get tutor time slote  */
function getEndTime(start_time){
	$.ajax({
		url: getEndTimeUrl,
		data: {'start_time' : start_time},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
		beforeSend:function(){
		},
		success: function(data){
			$("#end_time_id_div").empty();
			$("#end_time_id_div").html(data);
			$('#end_time').selectpicker('refresh');
			
		}
	});	
}




