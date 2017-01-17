
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
}

function MobileNav(){
    $('.hamburglar').click( function(){
    	$(this).toggleClass('open');
        $('.mainnav').slideToggle();
    });
}
