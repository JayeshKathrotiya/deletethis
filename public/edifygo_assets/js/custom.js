$(document).ready(function () {

    $(window).scroll(function() {                
        var scroll = $(window).scrollTop();    
        if (scroll >= 200) {
            $(".main-header").addClass("sticky-header");
            $(".filter-sidebar").addClass("sticky-sidebar");
        } 
        else {
            $(".main-header").removeClass("sticky-header");
            $(".filter-sidebar").removeClass("sticky-sidebar");
        }
    });

    $('#filterCollapse').on('click', function () {
        $('.filter-fields').addClass('in');
        $('body').addClass('filteropen');
    });
    $('#filterClose').on('click', function () {
        $('.filter-fields').removeClass('in');
        $('body').removeClass('filteropen');
    });

    // $('.cshare').on("click", function () {
    //     $(this).toggleClass('open');
    //     $('.class-social li').toggleClass('scale-on');
    // });

    $('.class-share .shareall').on('click', function () {
        $(this).parent('li').parent('ul').parent('.class-share').toggleClass('share-active');
    });
    // $('.class-share').click(function(e) {
    //     e.stopPropagation(); // stops the event to bubble up to the parent element.
    // });

    $('#main-slider').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: false,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });


    $('#courses-slider').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        margin:10,
        nav:true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });

    $('#coursecat-slider').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: false,
        autoplay:true,
        animateOut:'fadeOut',
        autoplayTimeout:3000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    $('#advertisement-slider').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: false,
        autoplay:true,
        animateOut:'fadeOut',
        autoplayTimeout:3000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });


$('#upcomming-course-slider').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        margin:10,
        nav:false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    
    $('#sponsored-slider').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        margin:10,
        nav:false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    $('#stud-quotes').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots: false,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    $('#promoters-slider').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        margin:10,
        nav:false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    $('#blog-slider').owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:5000,
        margin:10,
        nav:true,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

     $('.myvideo-grid').lightGallery();
     $('#group-video').lightGallery();
     $('#group-image').lightGallery();
     $('#group-image1').lightGallery();

});

$(function () {
    $('#filterBy').on('click', function (e) {
        $('#filter-list').toggleClass('in');
        
    });

    $('#filter-list').click(function(e) {
        e.stopPropagation(); // stops the event to bubble up to the parent element.
    });

    $(document).on("click", function(e) {
        if ($(e.target).is("#filterBy, #filter-list") === false) {
          $("#filter-list").removeClass("in");
        }
    });


    $('#sortBy').on('click', function (e) {
        $('#sort-list').toggleClass('in');
        
    });

    $('#sort-list').click(function(e) {
        e.stopPropagation(); // stops the event to bubble up to the parent element.
    });

    $(document).on("click", function(e) {
        if ($(e.target).is("#sortBy, #sort-list") === false) {
          $("#sort-list").removeClass("in");
        }
    });
});

// jQuery(document).ready(function(){

// });

// jQuery(function ($) {
	
// });

// $(document).ready(function () {
    

// });

// (function ($) {
//     "use strict";
   
// })(jQuery);