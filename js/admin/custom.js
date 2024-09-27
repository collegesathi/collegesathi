$(function(){
	
	$(document).on('click', '.confirm_box', function(e){
		url 				= $(this).attr('data-href');
		confirmMessage 		= $(this).attr('data-confirm-message');
		confirmHeading 		= $(this).attr('data-confirm-heading');	
		
		 swal({
			title: confirmHeading,
			text: confirmMessage,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			closeOnConfirm: false
		}, function () {
		   window.location.replace(url);
		});
	
	});
	
	
	
	
	$(document).on('click', '.error_alert_box', function(e){
		confirmMessage 		= $(this).attr('data-confirm-message');
		confirmHeading 		= $(this).attr('data-confirm-heading');	
		swal({
			title: '',
			text: confirmMessage,
			type: "error",
		});
	
	});
	


$(document).on('click', '.confirm_box_document', function(e){
		documentId 			= $(this).attr('data-document-id');
		confirmMessage 		= $(this).attr('data-confirm-message');
		confirmHeading 		= $(this).attr('data-confirm-heading');	
		page_from 			= $(this).attr('data-from');	
		swal({
			title: confirmHeading,
			text: confirmMessage,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			closeOnConfirm: false
		}, function () {
			$('.cancel').trigger('click');
			if(page_from == 'approve'){
				setTimeout(function(){
					$("#document_id_val").val(documentId);
					$("#approve_document").modal('show');
				},500);
			}else{
				setTimeout(function(){
					$("#document_id_reject_val").val(documentId);
					$("#reject_document").modal('show');
				},500);
			}
		});
  });
});



