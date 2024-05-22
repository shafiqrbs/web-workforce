// Add Your Scripts here
// HAMBURGER-AND-MENU-FUNCTION
$(document).ready(function(){
$('.nav-header').click(function(){
              $('.nav-header').toggleClass('active');
              // $('.collapse-nav').toggle('boxopened', 'easeInQuad');
                $('.collapse-nav').slideToggle("slow");
            });
$('#toggle-menu').click(function(){
			$(this).toggleClass('toggle-menu-visible');
			$(this).toggleClass('toggle-menu-hidden');
            });
});
// HAMBURGER-AND-MENU-FUNCTION-END