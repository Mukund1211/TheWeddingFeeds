<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Shadow_Socials_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(            
            'classname' => 'shadow_socials_widget',
            'description' => esc_html__( 'Displays social icons, defined in Customizer.', 'shadowcore' )
        );
        parent::__construct( 'Shadow_Socials_Widget', wp_get_theme() .' '. esc_html__( 'Socials (ST)', 'shadowcore' ), $widget_options );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        echo $args[ 'before_widget' ];
        if ( !empty( $title ) )
            echo $before_title . esc_html( $title ) . $after_title;
        
        echo '<div class="'. esc_attr( $instance[ 'align' ] ) .'">';
        get_template_part( 'template-parts/widgets/widget-socials' );
        echo '</div>';
        
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $defaults = array(
            'title' => esc_html__( 'Follow Us', 'shadowcore' ),
            'align' => 'align-left',
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <div class="shadow_widget_settings">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance[ 'title' ]; ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php esc_html_e( 'Align:', 'shadowcore' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>" class="widefat">
                    <option value="align-left" <?php selected( $instance[ 'align' ], 'align-left' ); ?>><?php esc_html_e( 'Left', 'shadowcore' ); ?></option>
                    <option value="align-center" <?php selected( $instance[ 'align' ], 'align-center' ); ?>><?php esc_html_e( 'Center', 'shadowcore' ); ?></option>
                    <option value="align-right" <?php selected( $instance[ 'align' ], 'align-right' ); ?>><?php esc_html_e( 'Right', 'shadowcore' ); ?></option>
                </select>
            </p>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;        
        $instance[ 'title' ] = esc_attr( $new_instance[ 'title' ] );
        $instance[ 'align' ] = esc_attr( $new_instance[ 'align' ] );
        
        return $instance;
    }
}
add_action( 'widgets_init', function() {
	register_widget( 'Shadow_Socials_Widget' );
});