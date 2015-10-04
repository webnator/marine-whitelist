$(document).ready(function(){
    $('.dropdown').on('mouseover', function(){
        $(this).children('.dropdown-menu').show();
        $(this).addClass('active');
    });
    $('.dropdown').on('mouseout', function(){
        $(this).children('.dropdown-menu').hide();
        $(this).removeClass('active');
    });

    $('.header-toggler').on('click', function(){
        $("#"+$(this).data('toggler-target')).slideToggle();
    });

    $('.close-box-btn').on('click', function(){
        $(this).parent().slideToggle();
    });
	
});

