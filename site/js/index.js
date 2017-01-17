
// Compile our scss
// This 'includes' the SCSS index file which webpack then reads and 
// compiles into the necessary css files
require('../scss/index.scss');

/**
 * On page load
 **/
$(document).ready( function(){
	// Start your website!
	console.log('Loaded!');
	PageSetup();
});

function PageSetup(){
    MobileNav();
    ToggleContent();
}

function MobileNav(){
    $('.hamburglar').click( function(){
    	$(this).toggleClass('open');
        $('.mainnav').slideToggle();
    });
}

function ToggleContent(){
    $('.toggle-button').click(function(e){
    	e.preventDefault();
        $(this).parent('.togglable').children('.togglable-content').slideToggle(200);
        $(this).toggleClass('open');
        if( $(this).children('.fa').length ){
        	$(this).children('.fa').toggleClass('fa-plus');
        	$(this).children('.fa').toggleClass('fa-minus');
        }
    });
}
