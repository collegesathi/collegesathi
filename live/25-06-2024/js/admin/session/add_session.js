$(document).ready(function(){
	
	/******For Topics ******/
	$("#subject_id").on('change', function(e){  
		var tutor_id = $("#tutor_id").val();
		var subject_id = $("#subject_id").val();
		
		$(".subject_id_error").html('');
		getTutorTopics(subject_id, tutor_id);
		
	});


	/******For Timeslots ******/
	$("#tutor_id").on('change', function(e){  
		var tutor_id = $("#tutor_id").val();
		$(".tutor_id_error").html('');
		getTutorSubjects(tutor_id);
		getTutorTopics('', tutor_id);
		let sessionDate = $("#session_date").val();
		getTutorTimeSlot(sessionDate, $("#tutor_id").val());
		
	});

	
	/******For DatePicker start from tomorrow******/
	$('#session_date').bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_format,
		autoclose : true,
		shortTime: false,
		date: true,
		time: false,
		minDate : moment().add(1, "days"),
	}).on('change', function(e, date) {
		var sessionDate = $("#session_date").val();
		getTutorTimeSlot(sessionDate, $("#tutor_id").val());
	});
	
	
	
	/******For DatePicker start from tomorrow******/
	$('#org_session_date').bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_format,
		autoclose : true,
		shortTime: false,
		date: true,
		time: false,
		minDate : moment().add(1, "days"),
	});
});	



/* get tutor time slote  */
function getTutorTopics(subject_id, tutor_id ){
	$.ajax({
		url: getTutorTopicUrl,
		data: {'subject_id' : subject_id,'tutor_id' : tutor_id},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
		beforeSend:function(){
			$("#overlay").show();
		},
		success: function(data){
			$("#overlay").hide();
			if(data.status == 'success'){
				$("#tutor_topic_id_div").html(data.view);
			}
		}
	});	
}



/* get tutor time slote  */
function getTutorSubjects(tutor_id){
	$.ajax({
		url: getTutorSubjectUrl,
		data: {'tutor_id' : tutor_id},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
		beforeSend:function(){
			$("#overlay").show();
		},
		success: function(data){
			if(data.status == 'success'){
				$("#overlay").hide();
				$("#subject_id_div").html(data.view);
				$('#subject_id').selectpicker();
			}
			
		}
	});	
}
	
	
/* get tutor time slote  */
function getTutorTimeSlot(sessionDate, tutor_id ){
	$.ajax({
		url: getTutorTimeSlotUrl,
		data: {'sessionDate' : sessionDate,'tutor_id' : tutor_id},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
		beforeSend:function(){
			$("#overlay").show();
		},
		success: function(data){
			
			if(data.status == 'success'){
				$("#overlay").hide();
				$("#tutor_time_slot_id_div").html(data.view);
				$('#tutor_time_slot_id').selectpicker();
			}
		}
	});	
}


/* get tutor time slote  */
function getTutorTopics(subject_id, tutor_id ){
	$.ajax({
		url: getTutorTopicUrl,
		data: {'subject_id' : subject_id,'tutor_id' : tutor_id},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
		beforeSend:function(){
			$("#overlay").show();
		},
		success: function(data){
			$("#overlay").hide();
			if(data.status == 'success'){
				$("#tutor_topic_id_div").html(data.view);
				$('#topic_id').selectpicker();
			}
		}
	});	
}
