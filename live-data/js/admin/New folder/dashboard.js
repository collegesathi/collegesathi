$(document).ready(function(){
	
	showMonthField($("#year").val());
	
	$("#year").change(function(e){
		var year	=	$(this).val();
		showMonthField(year);
	});
});



function showMonthField(year){
	if(year){
		$("#month").val(searchMonth);
		$("#month_div").show();
	}
	else {
		$("#month").val(searchMonth);
		$("#month_div").hide();
	}
}