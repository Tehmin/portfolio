
$(document).ready(function () {

    /*----Form submitting without page refresh------*/

        $("#contact_form").on("submit", function(e){

        e.preventDefault();
        var dataString = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '../parts/contact.php',
            dataType: 'json',
            data: dataString,
            success: function (response) {
                if(response.message){
                    $(".response").html(response.message);
                    $('.has_error').hide();
                } else {
                    if(response.error_name){
                        $(".error_name").html(response.error_name);
                        $("label[for=name]").addClass("has_error")
                    }
                    if(response.error_email){
                        $(".error_email").html(response.error_email);
                        $("label[for=email]").addClass("has_error")
                    }
                    if(response.error_message){
                        $(".error_message").html(response.error_message);
                        $("label[for=message]").addClass("has_error")
                    }
                }
                
            }
        });
        return false;
    });

    $(window).on("scroll", function () {
        /*----header scroll background color------*/
        if ($(this).scrollTop() > 80) {
            $(".header").addClass("header_background");
        } else {
            $(".header").removeClass("header_background");
        }
        /*----scroll top button------*/
        if ($(this).scrollTop() > 250) {
            $('#go_top').fadeIn();
        } else {
            $('#go_top').fadeOut();
        }
    });

    /*----Click event to scroll to top------*/
    $('.scrollToTop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1000);
        return false;
    });

    /*----hamburger menu------*/
    $(".hamburger").add(".primary_menu a").click(function () {
        $(".hamburger").toggleClass("opend");
        if ($(".hamburger").hasClass("opend")) {
            $(".menu_block").addClass("open");
        } else {
            $(".menu_block").removeClass("open");
        }
    });

    /*----'more about me' button scroll------*/
    $('a[href^="#about"]').add('.primary_menu a').on('click', function (event) {
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 800);
    });

    /*----edite button click------*/
    $('.edit').on({
        click: function () {
            $(this).parents('.update_form_wrap').find('form').toggleClass('open');
            $(this).hide();
        }
    })
});

/*---- portfolio fade up------*/
function reveal() {
    let reveals = document.querySelectorAll(".reveal");

    for (let i = 0; i < reveals.length; i++) {
        let windowHeight = window.innerHeight;
        let elementTop = reveals[i].getBoundingClientRect().top;
        let elementVisible = 10;

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("fadeUp");
        } else {
            reveals[i].classList.remove("fadeUp");
        }
    }
}

window.addEventListener("scroll", reveal);
