/**
 * Theme Main sript handler file
 * 
 */
jQuery(document).ready(function($) { // on document ready
    var stickey_header_one, themeUrl = themeVar.themeUrl, author = themeVar.author, footerTxt = themeVar.footerTxt;

    //trigger the effect on scroll
    if( stickey_header_one ) {
        $('.site-header').waypoint(function(direction) {  
            $('.main-navigation-section-wrap').toggleClass('fixed_header');
        }, { offset: - 0 });
    }

    /**
     * Header Toggle Sidebar handler
     * 
     */
    var header_sidebar_trigger = $( ".header-sidebar-trigger" )
    if( header_sidebar_trigger.length ) {
        header_sidebar_trigger.on( "click", function() {
            $("body").toggleClass( "header_toggle_sidebar_active" )
            $(this).next(".header-sidebar-content").toggleClass( "isActive" ).toggle( "slow" )
        })

        // on close trigger
        $(document).on( "click", ".header-sidebar-content.isActive .header-sidebar-trigger-close", function() {
            $("body").toggleClass( "header_toggle_sidebar_active" )
            $(this).parent( ".header-sidebar-content" ).toggleClass( "isActive" ).toggle( "slow" )
        })

        // close on click outside of popup
        $(document).on( "mouseup", function(e) {
            container = $( ".header-sidebar-content.isActive" )
            if( !container.is(e.target) && container.has(e.target).length === 0 ) {
                    $("body").toggleClass( "header_toggle_sidebar_active" )
                    container.toggleClass( "isActive" ).toggle( "slow" )
            }
        })
    }

    $(window).scroll(function() {
        if ( $(this).scrollTop() > 800 ) {
            $('#news-cast-scroll-to-top').addClass('show');
        } else {
            $('#news-cast-scroll-to-top').removeClass('show');
        }
    }); 

    /**
     * Render author link
     * 
     */
    $( 'body #bottom-footer .bottom-footer-inner' ).append( '<div class="site-info">' + footerTxt + '<a href="' + themeUrl + '">' + author +  '</a></div>' );
});