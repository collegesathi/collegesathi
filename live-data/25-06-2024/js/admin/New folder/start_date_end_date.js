/**
* Function for start date and end date
* @param start_date_id as start date field id
* @param end_date_id as end date field id
* @param date_format as date format
* @return datePicker
*/
function start_end_date(start_date_id, end_date_id, date_format){
	
	/** Set default start date**/
	if($("#"+start_date_id).val() != ''){
		var sdate = new Date($("#"+start_date_id).val());			
	}else{
		var sdate = new Date();
	}
	
	/** Set default end date**/
	if($("#"+end_date_id).val() != ''){
		var edate = new Date($("#"+end_date_id).val());
	}else{
		var edate = '';
	}
	
	
	/** For Datepicker */
	$("#"+start_date_id).datepicker({
		format : date_format,
		endDate: edate,
		autoclose : true
	}).on("changeDate",function (e) {			
	  $("#"+end_date_id).datepicker("setStartDate", e.date);
	});
	
	$("#"+end_date_id).datepicker({
		format : date_format,
		startDate: sdate,
		autoclose : true,
	}).on("changeDate",function (e) {
	  $("#"+start_date_id).datepicker("setEndDate", e.date);
	});
}