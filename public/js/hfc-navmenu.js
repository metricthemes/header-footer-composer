(function($) {

  $.fn.menumaker = function(options) {
      
      var cssmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
        cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        cssmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          cssmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else cssmenu.addClass('dropdown');

        if (settings.sticky === true) cssmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {
            cssmenu.find('ul').show();
          }

          if ($(window).width() <= 768) {
            cssmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
		  
/*
$(window).load(function () {

	var screenwidth = $(window).width();
	
	if (screenwidth <= 375) {
		var toggleheight = $('.hfc-navbar').height();
		var leftpull = screenwidth - 675;
		$(".hfc-nav-menu-top").css({"position":"absolute", "width": screenwidth, "left": leftpull, "top": toggleheight, "background-color": "#000000" });
	}
	
	if (screenwidth <= 768) {
		var toggleheight = $('.hfc-navbar').height();
		var leftpull = screenwidth - 1000;
		$(".hfc-nav-menu-top").css({"position":"absolute", "width": screenwidth, "left": leftpull, "top": toggleheight, "background-color": "#000000" });
	}	

});
*/
		  
$(document).ready(function(){

$(".hfc-navbar").menumaker({
   title: "&#xf0c9;",
   format: "multitoggle"
});

});
})(jQuery);
