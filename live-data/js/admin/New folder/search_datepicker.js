
/**
* Function for show time picker
* @params start_time_id as id of start_time input box
* @params end_time_id as id of end_time input box
*/
function showTimePicker(start_time_id, end_time_id, date_time_formate, dateTrueFalse, timeTrueFalse){
	$('#'+end_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_time_formate,
		autoclose : true,
		shortTime: false,
		date: dateTrueFalse,
		time: timeTrueFalse,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setMaxDate', copiedDate);
	});
	
	$('#'+start_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_time_formate,
		autoclose : true,
		shortTime: false,
		date: dateTrueFalse,
		time: timeTrueFalse
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setMinDate', copiedDate);
	}); 
}
