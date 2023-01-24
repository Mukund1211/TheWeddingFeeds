/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */

"use strict";
var shadowcore_extel = {};

shadowcore_extel.init = function() {
    // Init Parallax Elements
    if ( jQuery('.shadowcore-el_parallax-yes').length ) {
        jQuery('.shadowcore-el_parallax-yes').each( function() {
            shadowcore_extel.el_parallax( jQuery(this) );
        });
    }
    
    // Init Parallax BG
    if ( jQuery('.shadowcore-bg_parallax-yes').length ) {
        jQuery('.shadowcore-bg_parallax-yes').each( function(){
            shadowcore_extel.bg_parallax_init( jQuery(this) );
        });
    }
    
    // Init Fullscreen Slide Section
    if ( jQuery('.shadowcore-section-fslide-yes').length ) {
        jQuery('.shadowcore-section-fslide-yes').each( function(){
            var $this_el = jQuery(this),
                this_speed = shadowcore_extel.get_option( $this_el, 'shadowcore-section-speed-' ),
                this_name = shadowcore_extel.get_option( $this_el, 'shadowcore-section-name-' ),
                this_dir = shadowcore_extel.get_option( $this_el, 'shadowcore-section-hides-' );
            
            $this_el.attr( 'data-name', this_name);
            
            if ( !jQuery('body').hasClass('elementor-editor-active') ) {
                jQuery('body').addClass('shadowcore-elementor-frontend');
            }

            $this_el.css( 'transition', this_dir + ' ' + this_speed + 'ms');
        });
        
        jQuery(document).on( 'click', 'a[href*="#"]', function(e) {
            var this_href = jQuery(this).attr('href');
            if ( this_href == '#close_section' ) {
                jQuery('.shadowcore-show-section').removeClass('shadowcore-show-section');
                return false;
            }
            if ( jQuery('[data-name="'+ this_href.substring( 1, this_href.length ) +'"]').length ) {
                jQuery('.shadowcore-show-section').removeClass('shadowcore-show-section');
                jQuery('[data-name="'+ this_href.substring( 1, this_href.length ) +'"]').addClass('shadowcore-show-section');
                return false;
            }
        });
    }
}

shadowcore_extel.el_parallax = function( $this_el ) {
    // Parallax Element Position
    if ( $this_el.hasClass('shadowcore-el_parallax-yes') ) {
        var this_speed = parseInt( $this_el.attr('class').split('shadowcore-el_parallax-speed-')[1].split(' ')[0], 10),
            this_offset_top = $this_el.offset().top,
            current_scroll = ( jQuery(window).scrollTop() - this_offset_top + $this_el.height()/2 )/100,
            set_top = current_scroll*100 - current_scroll*this_speed;
        $this_el.css('transform', 'translate3d(0px, '+ set_top +'px, 0px)');
    } else {
        $this_el.css('transform' , 'translate3d(0, 0, 0)');
    }
}

shadowcore_extel.bg_parallax_init = function( $this_el ) {
    // Parallax Background Init
    if ( $this_el.hasClass('shadowcore-bg_parallax-yes') ) {
        
        // Set Parallax Background Position
        shadowcore_extel.bg_parallax( $this_el );

        // Disable Parallax BG Transitions
        var bg_trans = $this_el.css('transition').split(' ');
        if (bg_trans[0] == 'background') {
            bg_trans[1] = '0s';
        }
        $this_el.css('transition', bg_trans.join(' '));        

    } else {
        // Return Transitions and Remove Parallax Position
        var this_style = $this_el.attr('style'),
            this_style_array = this_style.split(';');
        this_style_array.forEach( function( item, i ) {
            if ( item.indexOf( 'transition:' ) >= 0 ) {
                this_style_array.splice( i , 1);
            }
            if ( item.indexOf( 'background-position:' ) >= 0 ) {
                this_style_array.splice( i , 1);
            }
        });

        $this_el.attr('style', this_style_array.join(';') );
    }
}

shadowcore_extel.bg_parallax = function( $this_el ) {
    if ( $this_el.hasClass('shadowcore-bg_parallax-yes') ) {
        var this_speed = parseInt( $this_el.attr('class').split('shadowcore-bg_parallax-speed-')[1].split(' ')[0], 10),
            this_offset_top = $this_el.offset().top,
            current_scroll = ( jQuery(window).scrollTop() - this_offset_top)/100,
            set_top = current_scroll*100 - current_scroll*this_speed;
        $this_el.css('background-position', 'center '+ set_top +'px');
    } else {
        
    }
}

shadowcore_extel.get_option = function( $this_el, option ) {
    return $this_el.attr('class').split(option)[1].split(' ')[0]
}
shadowcore_extel.in_view = function( this_el ) {
    // Check if Element is in View
    var rect = this_el.getBoundingClientRect()
    return (
        ( rect.height > 0 || rect.width > 0) &&
        rect.bottom >= 0 &&
        rect.right >= 0 &&
        rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.left <= (window.innerWidth || document.documentElement.clientWidth)
    )
}

jQuery(window).on('elementor/frontend/init', function () {
    /*--------------
    EDITOR FUNCTIONS 
    --------------*/
    if (elementorFrontend.isEditMode()) {
        // Column Parallax Actions
        elementor.hooks.addAction( 'panel/open_editor/column', function( panel, model, view ) {            
            panel.$el.on('click', '.elementor-control-column_parallax .elementor-switch-label', function() {
                setTimeout( function(){
                    shadowcore_extel.el_parallax( view.$el );
                }, 100, view.$el);
            });
            panel.$el.on('click', '.elementor-control-column_parallax .elementor-switch-handle', function() {
                setTimeout( function(){
                    shadowcore_extel.el_parallax( view.$el );
                }, 100, view.$el);
            });
            panel.$el.on('change', '.elementor-control-column_parallax_speed input', function() {
                setTimeout( function(){
                    shadowcore_extel.el_parallax( view.$el );
                }, 100, view.$el);
            });
        });
        
        elementor.hooks.addAction( 'panel/open_editor/section', function( panel, model, view ) {            
            // Section Parallax Background Actions
            panel.$el.on('click', '.elementor-control-section_parallax_background .elementor-switch-label', function() {
                setTimeout( function(){
                    shadowcore_extel.bg_parallax_init( view.$el );
                }, 100, view.$el);
            });
            panel.$el.on('click', '.elementor-control-section_parallax_background .elementor-switch-handle', function() {
                setTimeout( function(){
                    shadowcore_extel.bg_parallax_init( view.$el );
                }, 100, view.$el);
            });
            panel.$el.on('change', '.elementor-control-section_parallax_background input', function() {
                setTimeout( function(){
                    shadowcore_extel.bg_parallax_init( view.$el );
                }, 100, view.$el);
            });
            
            // Section Fullscreen Slide Actions
        });
        
        
    }

    /*----------------
    FRONTEND FUNCTIONS 
    ----------------*/
    
    // Init Extensions
    setTimeout('shadowcore_extel.init()', 100);
    
    // Window Scroll Functions
    jQuery(window).on( 'scroll', function() {
        // Parallax Element Movement
        if ( jQuery('.shadowcore-el_parallax-yes').length ) {
            jQuery('.shadowcore-el_parallax-yes').each( function() {
                shadowcore_extel.el_parallax( jQuery(this) );
            });
        }
        // Parallax Background        
        if ( jQuery('.shadowcore-bg_parallax-yes').length ) {
            jQuery('.shadowcore-bg_parallax-yes').each( function(){
                shadowcore_extel.bg_parallax(jQuery(this));
            });
        }
    });
});

jQuery(document).ready(function(){
	
});
jQuery(window).load(function(){
	
});