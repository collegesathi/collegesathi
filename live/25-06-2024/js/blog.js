$(document).ready(function() {


	$('.related-blog-slider').owlCarousel({
        loop:false,
        margin:30,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1,
                mouseDrag:true,
                touchDrag:true,
                },
            567:{
                items:1,
                mouseDrag:true,
                touchDrag:true,
                },
            768:{
                items:2,
                mouseDrag:true,
                touchDrag:true,
                },     
            768:{
                items:2,
                mouseDrag:true,
                touchDrag:true,
            },
            992:{
                items:3
            },
            1200:{
               items:4
            }
        }
	});

	$(document).on('click', '.load_more', function(e){
		
		blockedUI();

		var pageNumber = $(this).attr('data-page');
		
		$.ajax({
			url: WEBSITE_URL+"blog-load-more?"+pageNumber,
			method: 'get',
			contentType: "application/json; charset=utf-8",
			success: function(result){

				unblockedUI();

				if(result.status == 'success'){
					
					$('.blog-append-list').append(result.html);

					setTimeout( resizeequalheight(), 250);
						
					function resizeequalheight() {
						equalHeight($(".blog-single-equal"));
					}
									
					if(result.html != ''){
						var latestPage = result.search_string;
						$('.load_more').attr('data-page',latestPage);
					} else {
						$('.load_more').hide();
					}
					
					if(result.page == result.last_page){
						$('.load_more').hide();
					}
					
				} 

				if(result.status == 'error'){
				}
			}	
		});
	});
	
});		 
