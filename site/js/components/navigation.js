/**
 * On page load
 **/
$(document).ready( function(){
	MobileNav();
});

function MobileNav(){
    $('.hamburglar').click( function(){
    	$(this).toggleClass('open');
        $('.mainnav').slideToggle();
    });
}
