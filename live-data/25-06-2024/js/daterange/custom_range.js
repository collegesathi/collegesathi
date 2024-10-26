
var range = {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        };


function showStartEndDateInPast(date_range_picker, start_date, end_date, cal_date_format) {
    
    /*var start = moment().subtract(0, 'days');
    var end = moment();*/

    var max_date =  new Date();

    $('#' + date_range_picker).daterangepicker({
        maxDate:max_date,
		autoUpdateInput: false,
		locale: {
		  format: cal_date_format
		},
        ranges : range
    });

    $('#' + date_range_picker).on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format(cal_date_format) + ' - ' + picker.endDate.format(cal_date_format));
        $('#'+ start_date).val(picker.startDate.format(cal_date_format));
        $('#'+ end_date).val(picker.endDate.format(cal_date_format));
    });
	
	$('#' + date_range_picker).on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
        $('#'+ start_date).val('');
        $('#'+ end_date).val('');
    });

}

function showStartEndDateInFuture(date_range_picker, start_date, end_date, cal_date_format) {
    
    var max_date =  new Date();

    $('#' + date_range_picker).daterangepicker({
        minDate:max_date,
        autoUpdateInput: false,
		locale: {
		  format: cal_date_format
		}
		/*ranges : range*/
    });

    $('#' + date_range_picker).on('apply.daterangepicker', function(ev, picker) {
		$(this).val(picker.startDate.format(cal_date_format) + ' - ' + picker.endDate.format(cal_date_format));
        $('#'+ start_date).val(picker.startDate.format(cal_date_format));
        $('#'+ end_date).val(picker.endDate.format(cal_date_format));
    });
	
	$('#' + date_range_picker).on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
        $('#'+ start_date).val('');
        $('#'+ end_date).val('');
    });

}


function showStartEndDateAllTime(date_range_picker, start_date, end_date, cal_date_format) {
    
    $('#' + date_range_picker).daterangepicker({
        autoUpdateInput: false,
		/*ranges : range*/
		locale: {
		  format: cal_date_format
		}
    });

    $('#' + date_range_picker).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format(cal_date_format) + ' - ' + picker.endDate.format(cal_date_format));
		$('#'+ start_date).val(picker.startDate.format(cal_date_format));
        $('#'+ end_date).val(picker.endDate.format(cal_date_format));
    });
	
	$('#' + date_range_picker).on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
        $('#'+ start_date).val('');
        $('#'+ end_date).val('');
    });

}




function showDob(dobId, dob_min_age, cal_date_format){
	
	$(dobId).attr('readonly', true);
	$(dobId).daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		maxDate : moment().subtract(dob_min_age, 'year'),
		locale: {
		  format: cal_date_format
		}
	});
}


