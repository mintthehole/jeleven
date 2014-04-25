(function ($) {
	$(document).ready(function(){
		//alert("from file");
		$(".sermonbox").colorbox({iframe:true, innerWidth:640, innerHeight:390});

		$('.book_chapter_load > a').live('click',function(event){
			event.preventDefault();
			$('#book_and_you').hide();
			$( "#chapter_content").show();
			$('.chap_li').removeClass('active');
			$.get($(this).attr('href'), function( data ) {
				$( "#chapter_content").html("loading");
				$( "#chapter_content").html( data );


			});
			$(this).closest('.book_chapter_load').addClass('active');
		});
		$('.about_book > a').live('click',function(event){
			event.preventDefault();
			$('.chap_li').removeClass('active');
			$( "#chapter_content").hide();
			$('#book_and_you').show();
			$(this).closest('.about_book').addClass('active');
		});

		// function fixDiv() {
		//     var $div = $("#navwrap");
		//     if ($(window).scrollTop() > $div.data("top")) {
		//         $div.css({'position': 'fixed', 'top': '0', 'width': '20%'});
		//     }
		//     else {
		//         $div.css({'position': 'static', 'top': 'auto'});
		//     }
		// }

		// $("#navwrap").data("top", $("#navwrap").offset().top); // set original position on load
		// $(window).scroll(fixDiv);
		$('.scroll').jscroll({
    loadingHtml: '<img src="loading.gif" alt="Loading" /> Loading...',
    padding: 20,
    nextSelector: '.jscroll-next:first >a',
		});
	});

	})(jQuery);