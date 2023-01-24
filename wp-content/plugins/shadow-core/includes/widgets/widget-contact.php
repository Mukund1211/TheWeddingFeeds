<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Shadow_Contacts_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(            
            'classname' => 'shadow_contacts_widget',
            'description' => esc_html__( 'Displays short contact information.', 'shadowcore' )
        );
        parent::__construct( 'Shadow_Contacts_Widget', wp_get_theme() .' '. esc_html__( 'Contacts (ST)', 'shadowcore' ), $widget_options );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        echo $args[ 'before_widget' ];
        if ( !empty( $title ) )
            echo $before_title . esc_html( $title ) . $after_title;
        
        set_query_var( 'shadow_contacts', $instance );

        get_template_part( 'template-parts/widgets/widget-contacts' );
        
        echo $args[ 'after_widget' ];
    }

    public function form( $instance ) {
        $defaults = array(
            'title' => esc_html__( 'How To Find Us', 'shadowcore' ),
            'descr' => '',
            'email' => '',
            'phone' => '',
            'fax' => '',
            'location' => '',
            'labels' => 0,
            'socials' => 1
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <div class="shadow_widget_settings">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance[ 'title' ]; ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'descr' ); ?>"><?php esc_html_e( 'Description:', 'shadowcore' ); ?></label>
                <textarea id="<?php echo $this->get_field_id( 'descr' ); ?>" name="<?php echo $this->get_field_name( 'descr' ); ?>" class="widefat"><?php echo esc_html( $instance[ 'descr' ] ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'location' ); ?>"><?php esc_html_e( 'Address:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'location' ); ?>" name="<?php echo $this->get_field_name( 'location' ); ?>" value="<?php echo $instance[ 'location' ]; ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php esc_html_e( 'Email:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance[ 'email' ]; ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php esc_html_e( 'Phone:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance[ 'phone' ]; ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php esc_html_e( 'Fax:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php echo $instance[ 'fax' ]; ?>" class="widefat"/>
            </p>
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $instance[ 'labels' ] ); ?> id="<?php echo $this->get_field_id( 'labels' ); ?>" name="<?php echo $this->get_field_name( 'labels' ); ?>" /> <label for="<?php echo $this->get_field_id( 'labels' ); ?>"><?php esc_html_e( 'Show Labels', 'shadowcore' ); ?></label>
                <br/>
                <input class="checkbox" type="checkbox"<?php checked( $instance[ 'socials' ] ); ?> id="<?php echo $this->get_field_id( 'socials' ); ?>" name="<?php echo $this->get_field_name( 'socials' ); ?>" /> <label for="<?php echo $this->get_field_id( 'socials' ); ?>"><?php esc_html_e( 'Show Socials', 'shadowcore' ); ?></label>
            </p>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance[ 'title' ] = esc_attr( $new_instance[ 'title' ] );
        $instance[ 'descr' ] = esc_attr( $new_instance[ 'descr' ] );
        $instance[ 'email' ] = esc_attr( $new_instance[ 'email' ] );
        $instance[ 'phone' ] = esc_attr( $new_instance[ 'phone' ] );
        $instance[ 'fax' ] = esc_attr( $new_instance[ 'fax' ] );
        $instance[ 'location' ] = esc_attr( $new_instance[ 'location' ] );
        
        $instance[ 'labels' ] = $new_instance[ 'labels' ] ? 1 : 0;
        $instance[ 'socials' ] = $new_instance[ 'socials' ] ? 1 : 0;

        return $instance;
    }
}
add_action( 'widgets_init', function() {
	register_widget( 'Shadow_Contacts_Widget' );
});