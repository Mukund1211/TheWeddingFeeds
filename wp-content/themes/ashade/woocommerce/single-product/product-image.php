<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

# Settings
$lightbox = Ashade_Core::get_mod( 'ashade-wc-lightbox' );
$columns  = Ashade_Core::get_mod( 'ashade-wc-gallery-columns' );
$lazy_state = Ashade_Core::get_mod( 'ashade-lazy-loader' );

$post_thumbnail_id = $product->get_image_id();
$post_gallery = $product->get_gallery_image_ids();

?>
<div class="ashade-single-product-gallery-wrap">
	<div class="ashade-single-product-image--large">
		<?php
		if ( $product->get_image_id() ) {
			$image_id = $product->get_image_id();
			$image_size = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );
			$image_escaped = wp_get_attachment_image( $image_id, $image_size );

			$original_url = wp_get_attachment_url( $image_id );
            $meta = wp_get_attachment_metadata( $image_id );
			if ( ! empty( $meta ) ) {
				$original_width = $meta[ 'width' ];
				$original_height = $meta[ 'height' ];
				
				if ( $lightbox ) {
					$image_post = get_post( $image_id );
					$lightbox_text = '';
					if ( ! empty( $image_post ) ) {
						$lightbox_text = $image_post->post_excerpt;
					}
					echo '
					<a 
						href="'. esc_url( $original_url ) .'" 
						class="ashade-lightbox-link" 
						data-elementor-open-lightbox="no"
						data-gallery = "product_'. esc_attr( $product->get_id() ) .'" 
						'. ( ! empty( $lightbox_text ) ? 'data-caption="'. esc_attr( $lightbox_text ) .'"' : '' ) .'
						data-size="'. esc_attr( $original_width ) . 'x' . esc_attr( $original_height ) .'">
					' . $image_escaped .'</a>';
				} else {
					echo '<div class="ashade-single-product-image--main">'. $image_escaped .'</div>';
				}
			} else {
				echo '<div class="ashade-single-product-image--main">'. $image_escaped .'</div>';
			}
		} else {
			echo '<div class="woocommerce-product-gallery__image--placeholder">';
			echo sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'ashade' ) );
			echo '</div><!-- .woocommerce-product-gallery__image--placeholder -->';
		}
		?>
	</div><!-- .ashade-single-product-gallery--large -->

	<?php if ( ! empty( $post_gallery ) ) {	?>
	<div class="ashade-single-product-gallery ashade-spg-<?php echo esc_attr( $columns ); ?>columns">
		<?php
		foreach ( $post_gallery as  $image_id ) {			
			$thmb_image_width = 512;
			$thmb_image_height = 512;
			
			$original_url = wp_get_attachment_url( $image_id );
            $meta = wp_get_attachment_metadata( $image_id );
			if ( !empty( $meta ) ) {
				$original_width = $meta[ 'width' ];
				$original_height = $meta[ 'height' ];
				
				if ( class_exists( 'Aq_Resize' ) ) {
					$image_url = aq_resize( wp_get_attachment_url( $image_id ), absint( $thmb_image_width ), absint( $thmb_image_height ), true, true, true );
				} else {
					$image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
				}
				echo '<div class="ashade-spg-item">';
				if ( $lightbox ) {
					# Lightbox Supported
					$image_post = get_post( $image_id );
					$lightbox_text = $image_post->post_excerpt;
					?>
					<a 
						href="<?php echo esc_url( $original_url ); ?>" 
						class="ashade-lightbox-link" 
						data-elementor-open-lightbox="no"
						data-gallery = "product_<?php echo esc_attr( $product->get_id() ); ?>" 
						<?php if ( ! empty( $lightbox_text ) ) { ?>
						data-caption="<?php echo esc_attr( $lightbox_text ); ?>"
						<?php } ?>
						data-size="<?php echo esc_attr( $original_width ) . 'x' . esc_attr( $original_height ); ?>">
						<img 
							<?php if ( $lazy_state ) { ?>
							src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $thmb_image_width ); ?>%20<?php echo absint( $thmb_image_height ); ?>'%3E%3C/svg%3E"
							data-src="<?php echo esc_url( $image_url ); ?>"
							class="ashade-lazy" 
							<?php } else { ?>
							src="<?php echo esc_url( $image_url ); ?>"
							<?php } ?>
							alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>" 
							width="<?php echo absint( $thmb_image_width ); ?>" 
							height="<?php echo absint( $thmb_image_height ); ?>">
					</a>
					<?php
				} else {
					# Lightbox Disabled
					?>
						<img 
							<?php if ( $lazy_state ) { ?>
							src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20<?php echo absint( $thmb_image_width ); ?>%20<?php echo absint( $thmb_image_height ); ?>'%3E%3C/svg%3E"
							data-src="<?php echo esc_url( $image_url ); ?>"
							class="ashade-lazy" 
							<?php } else { ?>
							src="<?php echo esc_url( $image_url ); ?>"
							<?php } ?>
							alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>" 
							width="<?php echo absint( $thmb_image_width ); ?>" 
							height="<?php echo absint( $thmb_image_height ); ?>">
					<?php
				}
				echo '</div><!-- .ashade-spg-item -->';
			}
		}
		?>
	</div><!-- .ashade-single-product-gallery -->
	<?php }	?>	
</div><!-- .ashade-single-product-gallery-wrap -->

<?php
/*
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( $product->get_image_id() ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'ashade' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
*/
?>