<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$images = Ashade_Core::get_rwmb( 'ashade-albums-images' );
$ribbon_style = Ashade_Core::get_prefer( 'ashade-albums-ribbon-layout' );
$lazy_state = Ashade_Core::get_mod( 'ashade-lazy-loader' );
$gallery_id = mt_rand( 0, 99999 );
$images_direction = Ashade_Core::get_prefer( 'ashade-albums-direction' );
wp_enqueue_script( 'ashade-ribbon' );

$lightbox = Ashade_Core::get_prefer( 'ashade-albums-ribbon-lightbox' );
if ( 'vertical' !== $ribbon_style ) {
    if ( Ashade_Core::get_mod( 'ashade-albums-back-state' ) == true ) {
        ?>
        <div class="ashade-ribbon-return ashade-back-wrap">
            <div class="ashade-back albums-go-back">
                <span><?php echo esc_html__( 'Return', 'ashade' ); ?></span>
                <span><?php echo esc_html__( 'Back', 'ashade' ); ?></span>
            </div>
        </div><!-- .ashade-back-wrap -->
        <?php
    }
}
$gallery_type = Ashade_Core::get_rwmb( 'ashade-albums-media-type', 'images' );
if ( 'mixed' == $gallery_type ) {
    $images = Ashade_Core::get_rwmb( 'ashade-albums-media' );
    wp_enqueue_script( 'vimeo-player', 'https://player.vimeo.com/api/player.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'youtube-player', 'https://www.youtube.com/iframe_api', array( 'jquery' ), false, true );
} else if ( 'video' == $gallery_type ) {
    $images = Ashade_Core::get_rwmb( 'ashade-albums-video' );
} else {
    $images = Ashade_Core::get_rwmb( 'ashade-albums-images' );
}
?>

<div class="ashade-albums-carousel is-<?php echo esc_attr( $ribbon_style ); ?>" id="ribbon-<?php echo mt_rand( 0, 99999 ); ?>">
    <?php 
	if ( 'reverse' == $images_direction ) {
		$images = array_reverse( $images );
	}
	if ( 'random' == $images_direction ) {
		shuffle( $images );
	}
    foreach ( $images as $item ) {
        if ( 'mixed' == $gallery_type ) {
        # Mixed Gallery
            $has_image = false;
            $media_post = false;
            $image_caption = '';
            $lightbox_text = '';
            $alt_text = '';
            $video_ratio = 0.5625;

            // Detect Type
            if ( ! empty( $item[ 'video' ] ) ) {
                if ( ! empty( $item[ 'image' ] ) ) {
                    $has_image = true;
                    $img_ID    = $item[ 'image' ];
                }
                $link_type  = 'video';
                $video_ID   = $item[ 'video' ];
                $video_type = $item[ 'type' ];
                if ( 'video' == $video_type ) {
                    $image_url = wp_get_attachment_url( $video_ID );
                } else {
                    $image_url = esc_attr( $video_ID );
                }
            } else if ( ! empty( $item[ 'image' ] ) ) {
                $link_type = 'image';
                $img_ID    = $item[ 'image' ];
            } else {
                $link_type = 'empty';
            }

            // Captions
            if ( 'image' == $link_type ) {
                $media_post = get_post( $img_ID );
            }
            if ( 'video' == $link_type ) {
                if ( 'video' == $video_type ) {
                    $media_post = get_post( $video_ID );
                } else if ( $has_image ) {
                    $media_post = get_post( $img_ID );
                }
            }
            if ( $media_post ) {
                $lightbox_text = $media_post->post_excerpt;
            }

            // Thumbnail Image
            if ( 'image' == $link_type ) {
                $meta = wp_get_attachment_metadata( $img_ID );
                $thmb_image_width  = $original_image_width  = $meta[ 'width' ];
                $thmb_image_height = $original_image_height = $meta[ 'height' ];
                
                $alt_text = get_post_meta( $img_ID, '_wp_attachment_image_alt', true );
                if ( class_exists( 'Aq_Resize' ) ) {
                    $image_url = $original_image_url = aq_resize( wp_get_attachment_url( $img_ID ), absint( $thmb_image_width ), absint( $thmb_image_height ), true, true, true );
                } else {
                    $image_url = $original_image_url = esc_url( wp_get_attachment_url( $img_ID ) );
                }
            } else if ( 'video' == $link_type ) {
                $original_image_width = 1920;
                $original_image_height = 1080;
                if ( 'video' == $video_type ) {
                    $media_meta = wp_get_attachment_metadata( $video_ID );
                    if ( ! empty( $media_meta[ 'width' ] )  && ! empty( $media_meta[ 'height' ] ) ) {
                        $original_image_width = $media_meta[ 'width' ];
                        $original_image_height = $media_meta[ 'height' ];
                    }
                    $original_image_url = wp_get_attachment_url( $video_ID );
                } else if ( 'youtube' == $video_type ) {
                    $original_image_url = 'https://www.youtube.com/embed/' . esc_attr( $video_ID );
                } else if ( 'vimeo' == $video_type ) {
                    $original_image_url = 'https://player.vimeo.com/video/' . esc_attr( $video_ID );
                }
            }
        } else if ( 'video' == $gallery_type ) {
        # Video Gallery
            $link_type  = $video_type = 'video';
            $video_ID   = $item[ 'ID' ];
            $media_post = get_post( $video_ID );
            $media_meta = wp_get_attachment_metadata( $video_ID );

            // Lightbox Caption
            if ( $media_post ) {
                $lightbox_text = $media_post->post_excerpt;
            } else {
                $lightbox_text = '';
            }

            // Preview Size
            if ( ! empty( $media_meta[ 'width' ] )  && ! empty( $media_meta[ 'height' ] ) ) {
                $original_image_width = $media_meta[ 'width' ];
                $original_image_height = $media_meta[ 'height' ];
            } else {
                $original_image_width  = 1920;
                $original_image_height = 1080;
            }
            $image_url = $original_image_url = wp_get_attachment_url( $video_ID );
        } else if ( 'images' == $gallery_type ) {
        # Image Gallery
            $link_type = 'image';
            $img_ID = $item[ 'ID' ];
            $image_url = $original_image_url = wp_get_attachment_url( $img_ID );
            $meta = wp_get_attachment_metadata( $img_ID );
            $original_image_width = $meta[ 'width' ];
            $original_image_height = $meta[ 'height' ];
            $image_post = get_post( $img_ID );
            $lightbox_text = $image_post->post_excerpt;
        }
        if ( 'empty' !== $link_type ) { ?>
            <div class="ashade-album-item" data-type="<?php echo esc_attr( $link_type ); ?>">
                <div class="ashade-album-item__inner">
                <?php if ( $lightbox ) { ?>
                    <a 
                        href="<?php echo esc_url( $original_image_url ); ?>" 
                        class="ashade-lightbox-link" 
                        data-elementor-open-lightbox="no"
                        data-gallery = "ribbon-<?php echo esc_attr( $gallery_id ); ?>" 
                        <?php if ( ! empty( $lightbox_text ) ) { ?>
                        data-caption="<?php echo esc_attr( $lightbox_text ); ?>"
                        <?php } ?>
                        data-type="<?php echo esc_attr( $link_type ); ?>" 
                        <?php if ( 'image' == $link_type ) { ?>
                        data-size="<?php echo esc_attr( $original_image_width ) . 'x' . esc_attr( $original_image_height ); ?>"
                        <?php } else if ( 'image' !== $gallery_type ) { ?>
                        data-video-type="<?php echo esc_attr( $video_type ); ?>" 
                        <?php } ?>
                    >
                <?php } 
                    if ( 'image' == $link_type ) { ?>
                        <img 
                            <?php if ( $lazy_state ) { ?>
                            src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $original_image_width ); ?>%20<?php echo absint( $original_image_height ); ?>'%3E%3C/svg%3E" 
                            data-src="<?php echo esc_url( $image_url ); ?>" 
                            class="ashade-lazy" 
                            <?php } else { ?>
                            src="<?php echo esc_url( $image_url ); ?>" 
                            <?php } ?>
                            alt="<?php echo esc_attr( get_post_meta( $img_ID, '_wp_attachment_image_alt', true ) ); ?>" 
                            width="<?php echo esc_attr( $original_image_width ); ?>" 
                            height="<?php echo esc_attr( $original_image_height ); ?>">
                        <?php
                        if ( $lightbox ) {
                            echo '</a>';
                        }
                    }
                    if ( 'video' == $link_type ) {
                        if ( 'video' == $video_type ) {
                            ?>
                            <div class="ashade-grid-item-holder is-cover">
                                <video class="ashade-video-preview" 
                                    src="<?php echo esc_url( $image_url ); ?>"
                                    webkit-playsinline="true" 
                                    playsinline="true" muted loop></video>
                                <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $original_image_width ); ?>%20<?php echo absint( $original_image_height ); ?>'%3E%3C/svg%3E" width="<?php echo absint( $original_image_width ); ?>" height="<?php echo absint( $original_image_height ); ?>">
                            </div>
                            <?php
                            if ( $lightbox ) {
                                echo '</a>';
                            }
                        } else {
                            if ( $lightbox ) {
                                echo '</a>';
                            }
                            ?>
                            <div class="ashade-slide-embed ashade-slide-embed--<?php echo esc_attr( $video_type ); ?>" data-video-id="<?php echo esc_attr( $image_url ); ?>">
                                <img src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $original_image_width ); ?>%20<?php echo absint( $original_image_height ); ?>'%3E%3C/svg%3E" width="<?php echo absint( $original_image_width ); ?>" height="<?php echo absint( $original_image_height ); ?>">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div><!-- .ashade-album-item__inner -->
            </div><!-- .ashade-album-item -->
    <?php 
        }
    } 
    ?>
</div><!-- .ashade-albums-carousel -->
