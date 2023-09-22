jQuery(function($){
	$('.btn-load-post').click(function(){
		$(this).text('Download...');
		var data = {
			'action': 'readmore',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url: ajaxurl,
			data: data,
			type: 'POST',
			success:function(data){
				if( data ) { 
					$('.btn-load-post').text('Download more');
                    $('.news-list').append( data );
                    // console.log( data );

					current_page++;
					if (current_page == max_pages) $(".btn-load-post").remove();
				} else {
					$('.btn-load-post').remove();
				}
			}
		});
	});
});