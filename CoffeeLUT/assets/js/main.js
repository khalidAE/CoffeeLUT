$(function () {
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 400) {
            $('.navbar').addClass('active');
            // $('.navbar').removeClass('navbar-dark');
            // $('.navbar').addClass('navbar-light');
            // $('.logo').html('<img src="logo.png" width="80px">');
            $('.logo').find('img').addClass('white')

        } else {
            $('.navbar').removeClass('active');
            // $('.navbar').removeClass('navbar-light');
            // $('.navbar').addClass('navbar-dark');
            // $('.logo').html('<img src="logo-light.png" width="80px">');
            $('.logo').find('img').removeClass('white')
        }
    });
});



$(document).ready(function() {
    $(".header-banner").css("display", "none");
    $(".header-banner").fadeIn(1000);
 
    // $("a").click(function(event){
    //     event.preventDefault();
    //     linkLocation = this.href;
    //     $("body").fadeOut(1000, redirectPage);      
    // });
    // function redirectPage() {
    //     window.location = linkLocation;
    // }
});

    	

// function toggleChevron(e) {
//     $(e.target)
//             .prev('.panel-heading')
//             .find("i.indicator")
//             .toggleClass('fa-caret-down fa-caret-right');
// }
// $('#accordion').on('hidden.bs.collapse', toggleChevron);
// $('#accordion').on('shown.bs.collapse', toggleChevron);