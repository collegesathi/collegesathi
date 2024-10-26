var title  		= 	"Are you sure";
var text  		= 	"Are you sure you want to perform this action?";
var msg			=	"Are you sure you want to change status?";
var delete_msg	=	"Are you sure you want to delete this?";


/**
 * Function to delete the user
 *
 * @param null
 *
 * @return void
 */
$(document).on('click', '.delete_user', function(e){ 
	e.stopImmediatePropagation();
	url = $(this).attr('href');
	bootbox.confirm(delete_msg,
	function(result){
		if(result){
			window.location.replace(url);
		}
	});
	e.preventDefault();
});

	
/**
 * Function to change status
 *
 * @param null
 *
 * @return void
 */
	$(document).on('click', '.activate_action', function(e){ 
		e.stopImmediatePropagation();
		url = $(this).attr('href');
		msg	=  msg;
		if($(this).attr('rel')){
			msg	=	$(this).attr('rel');
		}

		bootbox.confirm(msg,
		function(result){
			if(result){
				window.location.replace(url);
			}
		});
		e.preventDefault();
	});

$(function(){
	
	/**
	 * function to perform diffrent actions
	 * Check uncheck main checkbox
	 */
	$('.checkAllUser').click(function(e){
		
		$('#powerwidgets').find(':checkbox').prop('checked', $(this).prop("checked"));
		
		if($('.checkAllUser:checked').length > 0){
			$('#powerwidgets').find('.items-inner').addClass('highlightBox');
		}else{
			$('#powerwidgets').find('.items-inner').removeClass('highlightBox');
		} 
		 
		
		$('.checkAllUser').css('outline-color', '');
		$('.checkAllUser').css('outline-style', '');
		$('.checkAllUser').css('outline-width', '');
		
		//Perform Action
		var allVals = [];
		$('#powerwidgets').find(':checkbox').each(function() {
			if($(this).is(":checked")){
				allVals.push($(this).val());
			}
		});
		
		
		if(($('.checkAllUser').prop('checked') == true) && ($('.deleteall option:selected').val() != '')){
			$(this).prop('checked',true);
			 var actionType = $('.deleteall option:selected').val();
				e.stopImmediatePropagation();
				swal({
					title: title,
					text: text,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes",
					closeOnConfirm: false
				}, function () {
						$.ajax({
							url: action_url,
							type: 'post',
							headers: {
								'X-CSRF-TOKEN': csrf_token
							},
							data: { ids: allVals, type : actionType },
							beforeSend: function() { 
								$("#overlay").show();
							},
							success:function(data) {
								$("#overlay").hide();
								window.location.href=window.location.href;
							}
						});
				});
			e.preventDefault();
		}
		//end Perform action
	});
	
	/**
	* function to perform select and unselect all check box	
	*/
	
	//when particular checkboc is checked
	$('.userCheckBox').click(function(){
		$(this).prop('checked', $(this).prop("checked"));
		$(this).closest('.items-inner').toggleClass('highlightBox');
		
		
		if($('.userCheckBox:checked').length  ==  $('.userCheckBox').length){
			$('.checkAllUser').prop('checked', true);
		}else{
			$('.checkAllUser').prop('checked', false);
		}
	});
	
	
	/**
	* function to perform selected action for  all selected users
	* for change the action 	
	*/ 
	 
	$('.deleteall').change(function(e){
		
		var allVals = [];
		$('#powerwidgets').find(':checkbox').each(function() {
			if($(this).is(":checked")){
				allVals.push($(this).val());
			}
		});
		/*if($('.checkAllUser').prop('checked') == true){*/
		if($('.userCheckBox:checked').length){
			var actionType = $('.deleteall option:selected').val();
			var dropdownType = $('#dropdown_type').val();
			
		
			$('.deleteall').selectpicker('refresh');
			e.stopImmediatePropagation();
			if($(this).val() != '') {
				swal({
					title: title,
					text: text,
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes",
					closeOnConfirm: true
				}, function (inputValue) {
					if (inputValue===false) {
						$('.deleteall').val('');
						$('.deleteall').selectpicker('refresh');
					}
					else {
						$.ajax({
							url: action_url,
							type: 'post',
							headers: {
								'X-CSRF-TOKEN': csrf_token
							},
							data: { ids: allVals, type : actionType, dropdown_type : dropdownType },
							beforeSend: function() { 
								$("#overlay").show();
							},
							success:function(data) {
								$("#overlay").hide();
								window.location.href=window.location.href;
							}
						});
					}
						
				});
			}
			e.preventDefault();
		}else{
			if($(this).val() != ''){
			
			swal({
				type: 'error',
				title : 'Error',
				text: 'Please select at least one row.',
				showConfirmButton: true,
				timer: 10000000
			});
			$('.deleteall').val('');
			}
			
			$('.checkAllUser').css('outline-color', '#5897fb');
			$('.checkAllUser').css('outline-style', 'solid');
			$('.checkAllUser').css('outline-width', 'thin');
		}
	});
});

