<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$about_data = get_query_var( 'shadow_about' );
?>
<div class="ashade-widget--about">
	<div class="ashade-widget--about__head">
		<?php
		if ( ! empty( $about_data[ 'image_id' ] ) ) {
			$image_url = aq_resize( wp_get_attachment_url( $about_data[ 'image_id' ] ), '300', '300', true, true, true );
			echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_post_meta(  $about_data[ 'image_id' ], '_wp_attachment_image_alt', true ) ) . '"/>';
		}
		?>
		<h5>
			<span><?php echo esc_html( ! empty( $about_data[ 'caption' ] ) ? $about_data[ 'caption' ] : '' ); ?></span>
			<?php echo esc_html( ! empty( $about_data[ 'title' ] ) ? $about_data[ 'title' ] : '' ); ?>
		</h5>
	</div>
	<div class="ashade-widget--about__content"><?php echo wp_specialchars_decode( ! empty( $about_data[ 'descr' ] ) ? $about_data[ 'descr' ] : '' ); ?></div>
</div>