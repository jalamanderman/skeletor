/**
 * On page load
 **/
$(document).ready( function(){
	// Start your website!
	console.log('Loaded!');
	PageSetup();
});

function PageSetup(){
    ToggleContent();
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
