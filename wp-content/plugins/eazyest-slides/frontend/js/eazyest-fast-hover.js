(function($) {
	$(document).ready(function() {
		$('.hs-section').click(function() {
			if ( $('.animate').length ){
				$('.hs-titles').addClass('clickable').click(function(){
					var element;
					$(this).children('span').each(function(){
						if( $(this).css('z-index') == 1001 ){
							element = $(this);
						}
					});
					document.location.href = element.children('a:first').attr('href');
					return false;
				});				
				$('.animate').removeClass('animate').addClass('clicked');
			} else if ( $('.clicked').length ) {
				$('.clicked').removeClass('clicked').addClass('animate');
				$('.hs-titles').removeClass('clickable').unbind('click');
				return false;
			}
			return false;
		})
	})
}(jQuery));