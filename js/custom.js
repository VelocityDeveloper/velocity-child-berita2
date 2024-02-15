jQuery(function($) {
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        if (scroll >= 200) {
            $(".scrollHeader").addClass("fixedHeader");
        } else {
            $(".scrollHeader").removeClass("fixedHeader");
        }
    });
    
    // $('.module-vdposts-carousel').flickity({
    //     cellAlign: 'left',
    //     groupCells: true,
    //     autoPlay: true,
    //     autoPlay: 2000,
    //     wrapAround: true,
    //     lazyLoad: true,
    //     pageDots: false,
    //     arrowShape: {x0: 10, x1: 60, y1: 50, x2: 65, y2: 40, x3: 25}
    // });

    $('.vertical-post-header').slick({
        autoplay: true,
        infinite: true,
        speed: 800,
		autoplaySpeed: 1000,
        slidesToShow: 1,
        fade: true,
        arrows: false,
        cssEase: 'linear',
    });

    $('.module-vdposts-carousel').slick({
        dots: false,
        infinite: false,
        speed: 400,
        autoplay: false,
        autoplaySpeed: 2000,
        slidesToShow: 2,
        slidesToScroll: 1,
        prevArrow: '<div class="prev-arrow px-1 bg-secondary text-white"><i class="fa fa-caret-left fa-2x" aria-hidden="true"></i></div>',
        nextArrow: '<div class="next-arrow px-1 bg-secondary text-white"><i class="fa fa-caret-right fa-2x" aria-hidden="true"></i></div>',
        responsive: [
          {
            breakpoint: 1024,
      
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
        ]
    });
});