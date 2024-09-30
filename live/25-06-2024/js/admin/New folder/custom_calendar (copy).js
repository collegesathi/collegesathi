/**
* Function for show time picker
* @params start_time_id as id of start_time input box
* @params end_time_id as id of end_time input box
* @params date_formate as date format
*/
function showStartEndDate(start_time_id, end_time_id, date_formate){
	$('#'+end_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		autoclose : true,
		shortTime: false,
		date: true,
		maxDate : new Date(),
		time: false,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setMaxDate', copiedDate);
	});
	
	$('#'+start_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		autoclose : true,
		shortTime: false,
		maxDate : new Date(),
		date: true,
		time: false,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setMinDate', copiedDate);
	}); 
}

/**
* Function for show time picker
* @params start_time_id as id of start_time input box
* @params end_time_id as id of end_time input box
* @params date_formate as date format
*/
function showStartEndDateFuture(start_time_id, end_time_id, date_formate){
	var currentDate = new Date();
	$('#'+end_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		autoclose : true,
		shortTime: false,
		date: true,
		minDate : new Date(),
		time: false,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		if(copiedDate < currentDate){
			$(this).val("");
			return false;
		}else{	
			$('#'+start_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
			$('#'+start_time_id).bootstrapMaterialDatePicker('setMaxDate', copiedDate);
		}
	});
	
	$('#'+start_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		autoclose : true,
		shortTime: false,
		minDate : new Date(),
		date: true,
		time: false,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		if(copiedDate < currentDate){
			$(this).val("");
			return false;
		}else{	
			$('#'+end_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
			$('#'+end_time_id).bootstrapMaterialDatePicker('setMinDate', copiedDate);
		}
	}); 
}

/**
* Function for show time picker
* @params start_time_id as id of start_time input box
* @params end_time_id as id of end_time input box
* @params date_formate as date format
*/
function showPlanStartEndDate(start_time_id, end_time_id, date_formate){
	var currentDate = new Date();
	var tomorrow 	= new Date(currentDate.getTime() + 24 * 60 * 60 * 1000);
	
	$('#'+end_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		autoclose : true,
		shortTime: false,
		date: true,
		time: false,
		minDate: tomorrow,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setMaxDate', copiedDate);
	});
	
	$('#'+start_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		autoclose : true,
		shortTime: false,
		date: true,
		time: false,
		minDate: tomorrow,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setMinDate', copiedDate);
	}); 
}



/**
* Function for show time picker
* @params start_time_id as id of start_time input box
* @params end_time_id as id of end_time input box
*/
function showStartEndTimePicker(start_time_id, end_time_id, time_format){
	$('#'+end_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: time_format,
		autoclose : true,
		shortTime: false,
		date: false
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		copiedDate.setHours(copiedDate.getHours()-1);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+start_time_id).bootstrapMaterialDatePicker('setMaxDate', copiedDate);
	});
	
	$('#'+start_time_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: time_format,
		autoclose : true,
		date: false,
		shortTime: false,
	}).on('change', function(e, date) {
		var copiedDate = new Date(date);
		copiedDate.setHours(copiedDate.getHours()+1);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
		$('#'+end_time_id).bootstrapMaterialDatePicker('setMinDate', copiedDate);
	}); 
}


/**
* Function for show date picker
* @params field_id as id of dob field
* @params date_formate as date format
*/
function calendarForDOB(field_id, date_formate){
	
	var currentDate = new Date();
	currentDate.setYear(currentDate.getFullYear()-18);


	var currentStamp = toTimestamp(currentDate);

	
	
	$('#'+field_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		shortTime: false,
		date: true,
		time: false,
		maxDate : currentDate,
		autoclose : true,
	}).on('change', function(e, date) {
		
		var datum = Date.parse(date);
   		var timeCode = datum/1000;

   		if(timeCode > currentStamp) {
   			$('#'+field_id).val('');	
   		}

		
	});
}


function toTimestamp(strDate){
   var datum = Date.parse(strDate);
   return datum/1000;
}


/**
* Function for show date picker
* @params field_id as id of dob field
* @params date_formate as date format
*/
function showDatePicker(field_id, date_formate, showDate, showTime){
	$('#'+field_id).bootstrapMaterialDatePicker({
		weekStart: 0, 
		format: date_formate,
		shortTime: false,
		date: showDate,
		time: showTime,
		autoclose : true,
	});
}





/**
* Function for show time picker
* @params start_time_id as id of start_time input box
* @params end_time_id as id of end_time input box
* @params date_formate as date format
*/
function showStartEndDateInPast(start_time_id, end_time_id, date_formate){
	var currentDate = new Date();

    $('#' + end_time_id).bootstrapMaterialDatePicker({
        weekStart: 0,
        format: date_formate,
        autoclose: true,
        shortTime: false,
        date: true,
        time: false,
        maxDate: currentDate,
    }).on('change', function (e, date) {
        var copiedDate = new Date(date);
        //copiedDate.setHours(copiedDate.getHours()-1);
        $('#' + start_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
        $('#' + start_time_id).bootstrapMaterialDatePicker('setMaxDate', copiedDate);
    });

    $('#' + start_time_id).bootstrapMaterialDatePicker({
        weekStart: 0,
        format: date_formate,
        autoclose: true,
        shortTime: false,
        date: true,
        time: false,
        maxDate: currentDate,
    }).on('change', function (e, date) {
        var copiedDate = new Date(date);
        // copiedDate.setHours(copiedDate.getHours()+1);
        $('#' + end_time_id).bootstrapMaterialDatePicker('setDate', copiedDate);
        $('#' + end_time_id).bootstrapMaterialDatePicker('setMinDate', copiedDate);
    });
}
