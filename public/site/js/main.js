$(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:1,
        pagination:true,
        navigation:false,
        navigationText:["",""],
        slideSpeed:1000,
        responsive:{
            400:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:2
            }
        },
        autoPlay:true
    });

    $('.owl-carousel.owl-carousel-scrennshots').owlCarousel({
        center: true,
        items:1,
        loop:true,
        margin:20,
        rtl:true,
        autoPlay:{
            delay:3000,
        },
        responsive:{
            400:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
      });

      wow = new WOW(
        {
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
      }
      )
      wow.init();

      
});