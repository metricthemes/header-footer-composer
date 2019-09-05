jQuery(document).ready(function ($) {
								 					 
function HFC_Header() {
	
		var hfcheader 	= $('.hfc-sticky-header-on');				
		data_settings 	= hfcheader.data('settings');					
		
		if ( typeof data_settings != 'undefined' ) {
		
			data_scroll_dist 	= data_settings["hfc_sticky_header_scroll_top"];
			var scroll_dist		= data_scroll_dist["size"];				
			
			
			var backgroundcolor = data_settings["hfc_sticky_header_bgcolor"];				
			
			var border_ed 		= data_settings["hfc_sticky_header_border_ed"];						
			if (border_ed) {
				var bordercolor 	= data_settings["hfc_sticky_header_border_color"];								
				var bordersize 		= data_settings["hfc_sticky_header_border_size"];								
				data_border_size 	= data_settings["hfc_sticky_header_border_size"];
				var border_size	 	= data_border_size["size"];		
			}
	
			var devices		= data_settings["hfc_sticky_header_devices"];
			var width 		= $(window).width();
			header_height	= hfcheader.height();		
							
			if( typeof width != 'undefined' && width) {		
				if( width >= 1025 ) {
					var enabled = "desktop";
				}
				else if (width  > 767 && width < 1025  ) {
					var enabled = "tablet";					
				}
				else if (width <= 767 ) {
					var enabled = "mobile";	
				}
			}	
			
			/* Sticky Menu */
			if ($.inArray(enabled, devices)!='-1') {
				var mns = "hfc-sticky-header";
				
				if (scroll_dist) {
					hdr = scroll_dist;
				}
				else {
					hdr = $('.hfc-sticky-header-on').height();
				}
						
				mn = $(".hfc-sticky-header-on");
		
				$(window).scroll(function() {
					if( $(this).scrollTop() > hdr ) {
						mn.addClass(mns);
						$('.hfc-sticky-header-on').css('background-color', backgroundcolor);
							if (border_ed) {
								$('.hfc-sticky-header-on').css('border-bottom-color', bordercolor);
								$('.hfc-sticky-header-on').css('border-bottom-width', border_size);
								$('.hfc-sticky-header-on').css('border-bottom-style', 'solid');				
							}
						} 
						else 
						{
						mn.removeClass(mns);
						$('.hfc-sticky-header-on').css('background-color', '');			
							if (border_ed) {				
								$('.hfc-sticky-header-on').css('border-bottom-color', '');
								$('.hfc-sticky-header-on').css('border-bottom-width', '');				
								$('.hfc-sticky-header-on').css('border-bottom-style', '');								
							}
						}
				});
			}
		}		
    /* Sticky Menu Ends */			
}

HFC_Header();								 

});