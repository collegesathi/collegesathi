<!-- For flash messages -->
@if(Session::has('flash_notice'))
<script>
var message 	=	'<?php echo Session::get("flash_notice"); ?>';
//function notify flash success message
$(document).ready(function(){
	noty({
			layout : 'topRight', 
			theme : 'noty_theme_default', 
			type : 'success',     
			text: message,   
			timeout : 10000,
			closeButton:true,
			animation : {
				easing: 'swing',
				speed: 150 // opening & closing animation speed
			}		
		});
});
</script>
@endif

@if(Session::has('error'))
<script>
var message 	=	'<?php echo Session::get("error"); ?>';
//function notify flash error message
$(document).ready(function(){
	noty({
			layout : 'topRight', 
			theme : 'noty_theme_default', 
			type : 'error',     
			text: message,     
			timeout : 10000,
			closeButton:true,
			animation : {
				easing: 'swing',
				speed: 150 // opening & closing animation speed
			}		
		});
});
</script>
@endif

@if(Session::has('success'))
<script>
var message 	=	'<?php echo Session::get("success"); ?>';
//function notify flash success message
$(document).ready(function(){
	noty({
			layout : 'topRight', 
			theme : 'noty_theme_default', 
			type : 'success',
			text: message,    
			timeout : 10000,
			closeButton:true,
			animation : {
				easing: 'swing',
				speed: 150 // opening & closing animation speed
			}		
		});
});
</script>
@endif