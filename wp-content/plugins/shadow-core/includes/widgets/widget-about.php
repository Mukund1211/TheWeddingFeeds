<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Shadow_About_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(            
            'classname' => 'shadow_about_widget',
            'description' => esc_html__( 'Displays short about information.', 'shadowcore' )
        );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_media' ] );
        parent::__construct( 'Shadow_About_Widget', wp_get_theme() .' '. esc_html__( 'About (ST)', 'shadowcore' ), $widget_options );
    }
	
    public function enqueue_media() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('shadow-media-upload', SHADOWCORE_ASSETS_URL . 'js/shadow-media-upload.js', array( 'jquery' )) ;
		
		wp_enqueue_style('thickbox');
	}
	
    public function widget( $args, $instance ) {
        extract( $args );
        
        echo $args[ 'before_widget' ];
        
        set_query_var( 'shadow_about', $instance );

        get_template_part( 'template-parts/widgets/widget-about' );
        
        echo $args[ 'after_widget' ];
    }

    public function form( $instance ) {
        $defaults = array(
            'title' => '',
			'caption' => '',
            'descr' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tincidunt sagittis nisi sit amet tempor. Quisque nec sollicitudin urna, eget vulputate mauris.',
            'image_id' => '',
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
		$this_image_id = $instance[ 'image_id' ];
        ?>
        <div class="shadow_widget_settings">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance[ 'title' ]; ?>" class="widefat"/>
            </p><p>
                <label for="<?php echo $this->get_field_id( 'caption' ); ?>"><?php esc_html_e( 'Caption:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'caption' ); ?>" name="<?php echo $this->get_field_name( 'caption' ); ?>" value="<?php echo $instance[ 'caption' ]; ?>" class="widefat"/>
            </p>
			<p class="shadow-media-control"
				data-title="<?php esc_attr_e( 'Choose an Image', 'shadowcore' ); ?>"
				data-update-text="<?php esc_attr_e( 'Update Image', 'shadowcore' ); ?>"
				data-target=".shadow-image-id"
				data-remove="<?php esc_attr_e( 'Remove Image', 'shadowcore' ); ?>"
				data-select-multiple="false">
				
				<label><?php esc_html_e( 'Select Image:', 'shadowcore' ); ?></label>
				<input type="hidden" name="<?php echo $this->get_field_name( 'image_id' ); ?>" id="<?php echo $this->get_field_id( 'image_id' ); ?>" value="<?php echo $instance[ 'image_id' ]; ?>" class="shadow-image-id shadow-media-control-target">
				
				<span class="shadow-image-select-wrap">
					<?php 
					if ( ! empty ( $this_image_id ) ) {
						echo wp_get_attachment_image( $this_image_id, 'thumbnail', false );
					}
					?>
				</span>
				<?php
					if ( ! empty ( $this_image_id ) ) {
						echo '<a href="#" class="button shadow-media-control-remove">'. esc_attr__( 'Remove Image', 'shadowcore' ) .'</a>';
					}
					echo '<a href="#" 
							data-caption-select="'. esc_attr__( 'Select an Image', 'shadowcore' ) .'"
							data-caption-change="'. esc_attr__( 'Change an Image', 'shadowcore' ) .'"
							class="button shadow-media-control-choose">
							'. (empty ( $this_image_id ) ? esc_html__( 'Select an Image', 'shadowcore' ) : esc_html__( 'Change an Image', 'shadowcore' ) ) .'
					</a>';
				?>
			</p>
            <p>
                <label for="<?php echo $this->get_field_id( 'descr' ); ?>"><?php esc_html_e( 'Description:', 'shadowcore' ); ?></label>
                <textarea id="<?php echo $this->get_field_id( 'descr' ); ?>" name="<?php echo $this->get_field_name( 'descr' ); ?>" class="widefat"><?php echo esc_html( $instance[ 'descr' ] ); ?></textarea>
            </p>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance[ 'title' ] = esc_attr( $new_instance[ 'title' ] );
        $instance[ 'caption' ] = esc_attr( $new_instance[ 'caption' ] );
        $instance[ 'descr' ] = esc_attr( $new_instance[ 'descr' ] );
        $instance[ 'image_id' ] = esc_attr( $new_instance[ 'image_id' ] );
        return $instance;
    }
}
add_action( 'widgets_init', function() {
	register_widget( 'Shadow_About_Widget' );
});