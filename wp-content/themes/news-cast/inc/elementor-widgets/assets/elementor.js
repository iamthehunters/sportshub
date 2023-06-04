/**
 * Elementor live preview handler
 * 
 */
 jQuery(document).ready(function($) {
    if( window.elementorFrontend ) {
        if( typeof( elementorFrontend.hooks ) != 'undefined' ) {
            /**
             * Slider elementor preview
             * 
             */
            elementorFrontend.hooks.addAction( 'frontend/element_ready/post-carousel.default', function( $scope, $ ) {
                var newID = $scope.find( ".bmm-post-carousel-wrapper" );
                var blockSliderdots = newID.data( "dots" );
                var blockSliderloop = newID.data( "loop" );
                var blockSlidercontrol = newID.data( "control" );
                var blockSliderauto = newID.data( "auto" );
                var blockSlidertype = newID.data( "type" );
                var blockSliderspeed = newID.data( "speed" );
                var blockpostCarouselColumn = newID.data( "column" );
                newID.slick({
                    dots: ( blockSliderdots == '1' ),
                    arrows: ( blockSlidercontrol == '1' ),
                    infinite: ( blockSliderloop == '1' ),
                    autoplay: ( blockSliderauto == '1' ),
                    fade: ( blockSlidertype == '1' ),
                    speed: blockSliderspeed,
                    slidesToShow: blockpostCarouselColumn,
                    prevArrow: '<span class="prev-icon"><i class="fas fa-chevron-left"></i></span>',
                    nextArrow: '<span class="next-icon"><i class="fas fa-chevron-right"></i></span>',
                });
            });
        }
    }

    $( ".bmm-post-carousel-wrapper" ).each(function() {
        var parentID = $( this ).parents( ".bmm-post-carousel-block" ).attr( "id" );
        var newID = $( "#" + parentID + " .bmm-post-carousel-wrapper" );
        var blockpostCarouseldots = newID.data( "dots" );
        var blockpostCarouselloop = newID.data( "loop" );
        var blockpostCarouselcontrol = newID.data( "control" );
        var blockpostCarouselauto = newID.data( "auto" );
        var blockpostCarouseltype = newID.data( "type" );
        var blockpostCarouselspeed = newID.data( "speed" );
        var blockpostCarouselColumn = newID.data( "column" );
        newID.slick({
            dots: ( blockpostCarouseldots == '1' ),
            arrows: ( blockpostCarouselcontrol == '1' ),
            infinite: ( blockpostCarouselloop == '1' ),
            autoplay: ( blockpostCarouselauto == '1' ),
            fade: ( blockpostCarouseltype == '1' ),
            speed: blockpostCarouselspeed,
            slidesToShow: blockpostCarouselColumn,
            responsive: [
                {
                    breakpoint:991,
                    settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                    }
                  },
                {
                    breakpoint: 480,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
            ],
            prevArrow: '<span class="slickArrow prev-icon"><i class="fas fa-chevron-left"></i></span>',
            nextArrow: '<span class="slickArrow next-icon"><i class="fas fa-chevron-right"></i></span>',
        });
    });
})