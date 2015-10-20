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

    $('.ul-menu-box>li').on('click', function(){
        var aUrl = $(this).children('a').first().attr('href');
        window.location.href = aUrl;
    });


    $('.service-container').on('click', function(){
        //Removes all checked states
        $('.service-container').each(function(){
            $(this).children('.circle-check').first().removeClass('circle-checked');
        });
        $(this).children('.circle-check').first().addClass('circle-checked');

        $('#hidden_subscription_type').val($(this).data('subscription-type'));
    });
	
});


function sendClientForm(){
    var theForm = $('#clientForm');
    var valid = true;
    var msgToShow = '';
    var formFields = {};
    $(theForm).find(':input').each(function(){
        if($(this).attr('type') != 'button'){
            if($(this).val() == ''){
                valid = false;
                var instructions = $(this).data('instructions');
                if(instructions != '' && instructions != undefined){
                    msgToShow = instructions;
                }else{
                    msgToShow = 'All fields are mandatory';
                }
                return false;
            }else{
                formFields[$(this).attr('id')] = $(this).val();
            }
        }
    });
    if(valid == true){
        $.ajax({
            url: $(theForm).attr('action'),
            method: 'POST',
            data: formFields,
        }).done(function(data) {
            data = jQuery.parseJSON(data);
            switch(data.status){
                case 'OK':
                    window.location.replace(data.url);
                break;
                case 'LOGGED':
                    alert("You're already registered and logged in. You can't register again");
                break;
                case 'EXISTS':
                    alert("This email is already registered, go to the login page to log in");
                break;
                default:
                    alert("There was an error processing your registration, please try again or contact the administrator");
                break;
            }
            
        }).fail(function() {
            alert("There was an error processing your registration, please try again or contact the administrator");
        });
    }else{
        alert(msgToShow);
    }
}

function sendProviderForm(){
    var theForm = $('#providerForm');
    var valid = true;
    var msgToShow = '';
    var formFields = {};
    $(theForm).find(':input').each(function(){
        if($(this).attr('type') != 'button'){
            if($(this).val() == ''){
                valid = false;
                var instructions = $(this).data('instructions');
                if(instructions != '' && instructions != undefined){
                    msgToShow = instructions;
                }else{
                    msgToShow = 'All fields are mandatory';
                }
                return false;
            }else{
                formFields[$(this).attr('id')] = $(this).val();
            }
        }
    });
    if(valid == true){
        $.ajax({
            url: $(theForm).attr('action'),
            method: 'POST',
            data: formFields,
        }).done(function(data){
            data = jQuery.parseJSON(data);
            switch(data.status){
                case 'OK':
                    window.location.replace(data.url);
                break;
                case 'LOGGED':
                    alert("You're already registered and logged in. You can't register again");
                break;
                case 'EXISTS':
                    alert("This email is already registered, go to the login page to log in");
                break;
                default:
                    alert("There was an error processing your registration, please try again or contact the administrator");
                break;
            }
        }).fail(function() {
            alert("There was an error processing your registration, please try again or contact the administrator");
        });
    }else{
        alert(msgToShow);
    }
}


function sendClientLogin(){
    var theForm = $('#clientLoginForm');
    var valid = true;
    var msgToShow = '';
    var formFields = {};
    $(theForm).find(':input').each(function(){
        if($(this).attr('type') != 'button'){
            if($(this).val() == ''){
                valid = false;
                var instructions = $(this).data('instructions');
                if(instructions != '' && instructions != undefined){
                    msgToShow = instructions;
                }else{
                    msgToShow = 'All fields are mandatory';
                }
                return false;
            }else{
                formFields[$(this).attr('id')] = $(this).val();
            }
        }
    });
    if(valid == true){
        $.ajax({
            url: $(theForm).attr('action'),
            method: 'POST',
            data: formFields,
        }).done(function(data) {
            data = jQuery.parseJSON(data);
            switch(data.status){
                case 'OK':
                    window.location.replace(data.url);
                break;
                case 'LOGGED':
                    alert("You're already logged in. You can't log in again");
                break;
                case 'NO_USR':
                    alert("The email is not registered in our system. Go to our registration page");
                break;
                case 'NO_PWD':
                    alert("Wrong password, please try again");
                break;
                default:
                    alert("There was an error processing your registration, please try again or contact the administrator");
                break;
            }
            
        }).fail(function() {
            alert("There was an error processing your request, please try again or contact the administrator");
        });
    }else{
        alert(msgToShow);
    }
}

