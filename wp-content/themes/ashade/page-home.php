<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 * Template Name: Ashade Home Template
 */
$home_bg_opacity = Ashade_Core::get_rwmb( 'ashade-home-bg-opacity' );
$home_bg_style = Ashade_Core::get_rwmb( 'ashade-home-bg-style' );
$home_label_back_overhead = Ashade_Core::get_rwmb( 'ashade-home-back-overhead' );
$home_label_back_title = Ashade_Core::get_rwmb( 'ashade-home-back-title' );
$home_works_type = Ashade_Core::get_rwmb( 'ashade-home-works-type' );
$lazy_state = Ashade_Core::get_mod( 'ashade-lazy-loader' );

if ( 'masonry' == $home_works_type ) {
    wp_enqueue_script( 'masonry' );
}

get_header();
the_post();
?>
    <!-- Home Background -->
    <?php
    if ( 'static' == $home_bg_style ) {
        $bg_image = Ashade_Core::get_rwmb( 'ashade-home-bg-image' );
        if ( ! empty( $bg_image ) ) {
            foreach ( $bg_image as $item ) {
                $bg_image_url = wp_get_attachment_url( $item[ 'ID' ] );
            }
        } else {
            $bg_image_url = '';
        }
        
        ?>
        <div 
            class="ashade-home-background ashade-page-background is-image" 
            data-opacity="<?php echo absint( $home_bg_opacity )/100; ?>" 
            <?php echo ( ! empty( $bg_image_url ) ? 'data-src="' . esc_url( $bg_image_url ) . '"' : null ); ?>>
        </div><!-- .ashade-home-background -->
        <?php
    }
    if ( 'video' == $home_bg_style ) {
        $bg_video = Ashade_Core::get_rwmb( 'ashade-home-bg-video' );
        $video_mobile = Ashade_Core::get_rwmb( 'ashade-home-bg-video-mobile', 'yes' );

        if ( ! empty( $bg_video ) ) {
            foreach ( $bg_video as $item ) {
                $bg_video_src = $item[ 'src' ];
            }
        } else {
            $bg_video_src = '';
        }
        $bg_poster = Ashade_Core::get_rwmb( 'ashade-home-bg-poster' );
        if ( ! empty( $bg_poster ) ) {
            foreach ( $bg_poster as $item ) {
                $bg_poster_url = wp_get_attachment_url( $item[ 'ID' ] );
            }
        } else {
            $bg_poster_url = '';
        }
        $bg_video_fit = Ashade_Core::get_rwmb( 'ashade-home-bg-video-fit', 'cover' );

        if ( 'no' == $video_mobile && wp_is_mobile() ) {
            # Image Background for Mobile
            ?>
            <div 
                class="ashade-home-background ashade-page-background is-image" 
                data-opacity="<?php echo absint( $home_bg_opacity )/100; ?>" 
                <?php echo ( ! empty( $bg_poster_url ) ? 'data-src="' . esc_url( $bg_poster_url ) . '"' : null ); ?>>
            </div><!-- .ashade-home-background -->
            <?php
        } else {
            # Video Background
        ?>
            <div 
                class="ashade-home-background ashade-page-background is-video bg-video--<?php echo esc_attr( $bg_video_fit ); ?>" 
                data-opacity="<?php echo absint( $home_bg_opacity )/100; ?>">
                <video 
                    <?php echo ( ! empty( $bg_video_src ) ? 'src="' . esc_url( $bg_video_src ) . '"' : null ); ?> 
                    <?php echo ( ! empty( $bg_poster_url ) ? 'poster="' . esc_url( $bg_poster_url ) . '"' : null ); ?> 
                    webkit-playsinline="true" 
                    playsinline="true" 
                    muted autoplay loop>
                </video>
            </div><!-- .ashade-home-background -->
        <?php
        }
    }
    if ( 'slider' == $home_bg_style ) {
        $slider_images = Ashade_Core::get_rwmb( 'ashade-home-bg-gallery' );
        $slider_order = Ashade_Core::get_rwmb( 'ashade-home-bg-gallery-order', 'normal' );
        $slider_transition = Ashade_Core::get_rwmb( 'ashade-home-slider-transition' );
        $slider_delay = Ashade_Core::get_rwmb( 'ashade-home-slider-delay' );
        $slider_zoom = Ashade_Core::get_rwmb( 'ashade-home-slider-zoom' ); /* 100%-200%. Need value/100 */
        ?>
        <div class="ashade-home-background ashade-page-background is-slider" data-opacity="<?php echo absint( $home_bg_opacity )/100; ?>">
            <div 
                class="ashade-kenburns-slider" 
                id="ashade-kenburns01" 
                data-delay="<?php echo esc_attr( $slider_delay ); ?>" 
                data-zoom="<?php echo absint( $slider_zoom )/100; ?>" 
                data-transition="<?php echo esc_attr( $slider_transition ); ?>">
                <?php
                if ( 'random' == $slider_order ) {
                    shuffle( $slider_images );
                }
                if ( 'reverse' == $slider_order ) {
                    $slider_images = array_reverse( $slider_images );
                }
                foreach ( $slider_images as $item ) {
                    $slide_url = wp_get_attachment_url( $item[ 'ID' ] );
                    ?>
                    <div class="ashade-kenburns-slide" data-src="<?php echo esc_url( $slide_url ); ?>"></div>
                    <?php
                }
                ?>
            </div><!-- .ashade-kenburns-slider -->
        </div><!-- .ashade-home-background -->
        <?php
    }
    ?>
    <!-- Home Title and Back Button -->
    <div class="ashade-page-title-wrap is-inactive ">
        <h1 class="ashade-page-title">&nbsp;</h1>
    </div><!-- .ashade-page-title-wrap -->
    
    <div class="ashade-home-return ashade-back-wrap is-inactive">
        <div class="ashade-back is-home-return">
            <a href="#" class="ashade-home-link--a" data-event="back">
                <span><?php echo esc_html( $home_label_back_overhead ); ?></span>
                <span><?php echo esc_html($home_label_back_title ); ?></span>
            </a>
        </div><!-- .ashade-back -->
    </div><!-- .ashade-home-return -->

    <!-- Home Works Part -->
    <?php
    # Home Works Part
    $home_works_state = Ashade_Core::get_rwmb( 'ashade-home-works-state' );
    if ( 'no' !== $home_works_state ) {
        $home_label_works_overhead = Ashade_Core::get_rwmb( 'ashade-home-works-overhead' );
        $home_label_works_title = Ashade_Core::get_rwmb( 'ashade-home-works-title' );
        $home_works_intro = Ashade_Core::get_rwmb( 'ashade-home-works-intro' );
        $home_works_column = Ashade_Core::get_rwmb( 'ashade-home-works-columns' );
        ?>
        <div class="ashade-home-link--works ashade-home-link-wrap">
		    <div class="ashade-home-link is-link <?php echo esc_attr( 'yes' !== $home_works_state ? 'is-link--' . $home_works_state : null ); ?>">
                <?php 
                if ( 'other' == $home_works_state ) {
                    $works_page_id = Ashade_Core::get_rwmb( 'ashade-home-works-page' );
                    echo '<a href="' . esc_url( get_permalink( $works_page_id ) ) . '">';
                } else if ( 'external' == $home_works_state ) {
                    $target = Ashade_Core::get_rwmb( 'ashade-home-works-external-blank' );
                    echo '<a href="' . esc_url( Ashade_Core::get_rwmb( 'ashade-home-works-external' ) ) . '" target="'. ($target ? '_blank' : '_self') .'">';
                } else {
                    echo '<a href="#" class="ashade-home-link--a" data-event="works">';
                }
                ?>
			        <span><?php echo esc_html( $home_label_works_overhead ); ?></span>
                    <span><?php echo esc_html( $home_label_works_title ); ?></span>
                    <?php 
                    echo '</a>';
                ?>
		    </div>
        </div><!-- .ashade-home-link-wrap -->
        
        <?php 
        if ( 'yes' == $home_works_state ) { 
            $filter_state = Ashade_Core::get_rwmb( 'ashade-home-works-filter' );
            $categs = Ashade_Core::get_rwmb( 'ashade-home-works-categs' );
            $tax_name = Ashade_Core::get_mod( 'ashade-cpt-albums-category' );
            $gallery_id = 'ashade-' . $home_works_type . '-gallery' . get_the_ID();
        ?>
        <div id="ashade-home-works">
            <div class="ashade-row">
                <div class="ashade-col col-12">
                    <?php 
                    # Show Intro
                    if ( ! empty ( $home_works_intro ) ) { 
                        echo '<p class="ashade-intro">' . esc_html( $home_works_intro ) . '</p>';
                    } 

                    # Show Filter
                    if ( 'show' == $filter_state ) { ?>
                        <div class="ashade-filter-wrap" data-id="<?php echo esc_attr( $gallery_id ); ?>" data-label="<?php echo esc_attr__( 'Filter', 'ashade' ); ?>">
                            <?php 
                            $tax_terms = array();
                            if ( ! empty( $categs ) && 'all' !== $categs[0] && 'none' !== $categs[0] ) {
                                foreach ( $categs as $cat_slug ) {
                                    array_push( $tax_terms, get_term_by( 'slug', $cat_slug, $tax_name )->term_id );
                                }
                            }
                            $filter_terms = get_terms(array(
                                'taxonomy' => $tax_name, 
                                'field' => 'slug', 
                                'include' => $tax_terms
                            ));
                            if ( count( $filter_terms ) > 0 ) {
                                echo '<a href="#" data-category="*" class="is-active">' . esc_html__( 'All', 'ashade' ) . '</a>';
                            }
                            if ( is_array( $filter_terms ) ) {
                                foreach ( $filter_terms as $cat ) {
                                    echo '<a href="#" data-category=".ashade-category--'. esc_attr( $cat->slug ) .'">'. esc_attr( $cat->name ) .'</a>';
                                }
                            }
                            ?>
                        </div>
                    <?php 
                    }
                    ?>
                    <div id="<?php echo esc_attr( $gallery_id ); ?>" class="
                        ashade-albums-grid 
                        ashade-grid 
                        ashade-grid-<?php echo esc_attr( $home_works_column ); ?>cols 
                        <?php echo ( 'masonry' == $home_works_type ? 'is-masonry' : '' ); ?> 
                        <?php echo ( 'show' == $filter_state ? 'has-filter' : '' ); ?> 
                        <?php echo ( 'adjusted' == $home_works_type ? 'ashade-gallery-adjusted' : '' ); ?>">
                    <?php
                        $args = array(
                            'post_type'      => 'ashade-albums',
                            'post_status'    => 'publish',
                            'posts_per_page' => -1,
                            'paged'          => -1,
                            'orderby'        => esc_attr( Ashade_Core::get_rwmb( 'ashade-home-works-orderby', 'date' ) ),
	                        'order'          => esc_attr( Ashade_Core::get_rwmb( 'ashade-home-works-order', 'DESC' ) ),
                        );
                        if ( ! empty( $categs ) && 'all' !== $categs[0] && 'none' !== $categs[0] ) {
                            $tax_terms = array();
                            foreach ( $categs as $cat_slug ) {
                                array_push( $tax_terms, get_term_by( 'slug', $cat_slug, $tax_name )->term_id );
                            }
                            $query_tax = array(
                                array(
                                    'taxonomy' => $tax_name,
                                    'field'    => 'id',
                                    'terms'    => $tax_terms
                                )
                            );
                            $args['tax_query'] = $query_tax;
                        }

                        $query = new WP_Query( $args );
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $category_list = get_the_terms( get_the_id(), Ashade_Core::get_mod( 'ashade-cpt-albums-category' ) );
                                $category_filter = '';
                                $category_string = '';

                                if ( is_array( $category_list ) ) {
                                    foreach ( $category_list as $cat ) {
                                        $category_string .= $cat->name . ", ";
                                        if ( 'show' == $filter_state ) {
                                            $category_filter .= 'ashade-category--' . $cat->slug . " ";
                                        }
                                    }
                                    $category_string = substr( $category_string, 0, -2 );
                                    if ( 'show' == $filter_state ) {
                                        $category_filter = substr( $category_filter, 0, -1 );
                                    }
                                } else {
                                    $category_string = esc_attr__( 'Uncategorized', 'ashade' );
                                }

                                $featured_image_url = Ashade_Core::get_fimage_url();
                                $featured_image_meta = wp_get_attachment_metadata( get_post_thumbnail_id() );
                                if ( $featured_image_url ) {
                                    if ( class_exists( 'Aq_Resize' ) ) {
                                        $thmb_width = 960;
                                        if ( 'grid' == $home_works_type ) {
                                            $thmb_height = 640;
                                        } else {
                                            $ratio = $featured_image_meta[ 'height' ]/$featured_image_meta[ 'width' ];
                                            $thmb_height = $thmb_width*$ratio;
                                        }
                                        $thmb_url = aq_resize( $featured_image_url, absint( $thmb_width ), absint( $thmb_height ), true, true, true );
                                    } else {
                                        $thmb_url = $featured_image_url;
                                        $thmb_width = $featured_image_meta[ 'width' ];
                                        $thmb_height = $featured_image_meta[ 'height' ];
                                    }
                                    ?>
                                    <div id="album-<?php the_ID(); ?>" <?php post_class( array( 'ashade-album-item', 'ashade-grid-item', esc_attr( $category_filter ) ) ); ?>>
                                        <div class="ashade-grid-item--inner">
                                            <div class="ashade-album-item__image">
                                                <img
                                                    <?php if ( $lazy_state ) { ?>
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $thmb_width ); ?>%20<?php echo absint( $thmb_height ); ?>'%3E%3C/svg%3E"
                                                    data-src="<?php echo esc_url( $thmb_url ); ?>"
                                                    class="ashade-lazy" 
                                                    <?php } else { ?>
                                                    src="<?php echo esc_url( $thmb_url ); ?>"
                                                    <?php } ?>
                                                    alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); ?>">
                                            </div>
                                            <h5>
                                                <span><?php echo esc_html( $category_string ); ?></span>
                                                <?php the_title(); ?>
                                            </h5>
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="ashade-album-item__link"></a>
                                        </div><!-- .ashade-grid-item--inner -->
                                    </div><!-- .ashade-album-item -->
                                    <?php
                                }
                            }
                        } else {
                            echo '<p>' . esc_html__( 'You do not have any albums. Create your first album to show here.', 'ashade' ) . '</p>';
                        }
                        wp_reset_query();
                    ?>
                    </div><!-- .ashade-albums-grid -->
                </div><!-- .ashade-col -->
            </div><!-- .ashade-row -->
        </div><!-- #ashade-home-works -->
        <?php
        }
    }

    # Home Contacts Part
    $home_contacts_state = Ashade_Core::get_rwmb( 'ashade-home-contacts-state' );
    if ( 'no' !== $home_contacts_state ) {
        $home_label_contacts_overhead = Ashade_Core::get_rwmb( 'ashade-home-contacts-overhead' );
        $home_label_contacts_title = Ashade_Core::get_rwmb( 'ashade-home-contacts-title' );
        $home_contacts_intro = Ashade_Core::get_rwmb( 'ashade-home-contacts-intro' );
        $home_contacts_shortcode = Ashade_Core::get_rwmb( 'ashade-home-contacts-shortcode' );
        ?>
        <!-- Home Contacts Part -->
        <div class="ashade-home-link--contacts ashade-home-link-wrap">
            <div class="ashade-home-link is-link <?php echo esc_attr( 'yes' !== $home_contacts_state ? 'is-link--' . $home_contacts_state : null ); ?>">
            <?php 
            if ( 'other' == $home_contacts_state ) {
                $contacts_page_id = Ashade_Core::get_rwmb( 'ashade-home-contacts-page' );
                echo '<a href="' . esc_url( get_permalink( $contacts_page_id ) ) . '">';
            } else if ( 'external' == $home_contacts_state ) {
                $target = Ashade_Core::get_rwmb( 'ashade-home-contacts-external-blank' );
                echo '<a href="' . esc_url( Ashade_Core::get_rwmb( 'ashade-home-contacts-external' ) ) . '" target="'. ($target ? '_blank' : '_self') .'">';
            } else {
                echo '<a href="#" class="ashade-home-link--a" data-event="contacts">';
            }
            ?>
                <span><?php echo esc_html( $home_label_contacts_overhead ); ?></span>
                <span><?php echo esc_html( $home_label_contacts_title ); ?></span>
            <?php 
                echo '</a>';
            ?>
            </div>
	    </div><!-- .ashade-home-link-wrap -->

        <?php
        if ( 'yes' == $home_contacts_state ) {
            $contacts_list_state = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-state' ); /* yes / no */

            if ( 'yes' == $contacts_list_state ) {
                $contacts_list__overhead = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-overhead' );
                $contacts_list__title = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-title' );
                $contacts_list__icons = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-icons' ); /* sw */
                $contacts_list__location = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-location' );
                $contacts_list__phone = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-phone' );
                $contacts_list__email = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-email' );
                $contacts_list__socials = Ashade_Core::get_rwmb( 'ashade-home-contacts-list-socials' ); /* sw */
            }
        ?>
        <div id="ashade-home-contacts">
            <?php if ( ! empty ( $home_contacts_intro ) ) { ?>
            <div class="ashade-row">
                <div class="ashade-col col-12">
                    <p class="ashade-intro"><?php echo esc_html( $home_contacts_intro ); ?></p>
                </div>
            </div><!-- .ashade-row -->
            <?php } ?>
            <div class="ashade-row">
                <?php if ( 'yes' == $contacts_list_state ) { ?>
                <div class="ashade-col col-4">
                    <div class="ashade-contact-details">
                        <h4 class="ashade-contact-details__title">
                            <span><?php echo esc_html( $contacts_list__overhead ); ?></span>
                            <?php echo esc_html( $contacts_list__title ); ?>
                        </h4>
                        <ul class="ashade-contact-details__list <?php echo ( true == $contacts_list__icons ? 'has-labels' : '' ); ?>">
                            <li>
                                <?php 
                                echo ( true == $contacts_list__icons ? '<i class="ashade-contact-icon asiade-icon--location"></i>' : null );
                                echo esc_html( $contacts_list__location );
                                ?>
                            </li>
                            <li>
                                <?php 
                                echo ( true == $contacts_list__icons ? '<i class="ashade-contact-icon asiade-icon--phone"></i>' : null );
                                echo '<a href="tel:' . esc_attr( strtr( $contacts_list__phone, [' ' => '', '(' => '', ')' => '', '-' => ''] ) ) . '">' . esc_attr( $contacts_list__phone ) . '</a>';
                                ?>
                            </li>
                            <li>
                                <?php 
                                echo ( true == $contacts_list__icons ? '<i class="ashade-contact-icon asiade-icon--email"></i>' : null );
                                echo '<a href="mailto:' . sanitize_email( $contacts_list__email ) . '">' . sanitize_email( $contacts_list__email ) . '</a>';
                                ?>
                            </li>
                            <?php if ( $contacts_list__socials ) { ?>
                            <li class="ashade-contact-socials">
                                <?php 
                                echo ( true == $contacts_list__icons ? '<i class="ashade-contact-icon asiade-icon--socials"></i>' : null );
                                Ashade_Core::the_social_links();
                                ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </div><!-- .ashade-contact-details -->
                </div><!-- .ashade-col -->
                <?php } ?>
                <div class="ashade-col col-<?php echo ( 'yes' == $contacts_list_state ? '8' : '12' ); ?>">
                    <?php 
                    if ( ! empty( $home_contacts_shortcode ) ) {
                        echo do_shortcode( $home_contacts_shortcode );
                    }
                    ?>
                </div><!-- .ashade-col -->
            </div><!-- .ashade-row -->
        </div><!-- #ashade-home-contacts -->
        <?php
        }
    }

get_template_part( 'template-parts/footer-part' ); 
get_template_part( 'template-parts/aside' );
get_template_part( 'template-parts/page-ui' );

get_footer();