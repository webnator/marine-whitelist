$(document).ready(function(){
	$('#header_bbva').appear();

	$('#header_bbva').on('disappear', function(event, $all_disappeared_elements) {
    	$('#header_bbva').addClass("fixed-head-bbva");
    	$('.head-bar').hide();
    });


    $('#header_bbva').on('appear', function(event, $all_disappeared_elements) {
    	if($(window).scrollTop() == 0){
    		$('#header_bbva').removeClass("fixed-head-bbva");
    		$('.head-bar').show();
    	}
    });
});



function lightenColor(col,amt) {
    var num = parseInt(col,16);
    var r = (num >> 16) + amt;
    var b = ((num >> 8) & 0x00FF) + amt;
    var g = (num & 0x0000FF) + amt;
    var newColor = g | (b << 8) | (r << 16);
    return newColor.toString(16);
}

function sendSearch(el){

	var form = $(el).closest('form');
	form.submit();
}