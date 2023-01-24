<?php
/** 
 * Author: Shadow Themes
 * Author URL: http://shadow-themes.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class Shadow_Posts_Widget extends WP_Widget {

    public function __construct() {
        $widget_options = array(            
            'classname' => 'shadow_posts_widget',
            'description' => esc_html__( 'Displays Posts with different options', 'shadowcore' )
        );
        parent::__construct( 'Shadow_Posts_Widget', wp_get_theme() .' '. esc_html__( 'Posts (ST)', 'shadowcore' ), $widget_options );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        
        $title = apply_filters( 'widget_title', $instance[ 'title' ] );
        echo $args[ 'before_widget' ];
        if ( !empty( $title ) )
            echo $before_title . esc_html( $title ) . $after_title;
        
        // Widget Content Functions
        $query_args = array(
            'post_type' => 'post',
            'order' => esc_attr( $instance[ 'order' ] ),
            'orderby' => esc_attr( $instance[ 'orderby' ] ),
            'post_status' => 'publish',
            'posts_per_page' => absint( $instance[ 'posts_count' ] ),
            'ignore_sticky_posts' => 1
        );
        
        $widget_query = new WP_Query( $query_args );

        echo '<div class="shadow_posts_widget_wrapper content_align_'. esc_attr( $instance[ 'align' ] ) .' image_state_'. esc_attr( $instance[ 'image_state' ] ) .'">';
        while ( $widget_query->have_posts() ) : $widget_query->the_post();
            get_template_part( 'template-parts/widgets/widget-post' );
        endwhile;
        wp_reset_query();
        echo '</div><!-- .shadow_posts_widget_wrapper -->';
        
        echo $args[ 'after_widget' ];
    }

    public function form( $instance ) {
        $defaults = array(
            'title' => esc_html__( 'Recent Posts', 'shadowcore' ),
            'posts_count' => '2',
            'order' => 'desc',
            'orderby' => 'date',
            'align' => 'right',
            'image_state' => 'show',
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        ?>
        <div class="shadow_widget_settings">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'shadowcore' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance[ 'title' ]; ?>" class="widefat"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'posts_count' ); ?>"><?php esc_html_e( 'Posts Count:', 'shadowcore' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'posts_count' ); ?>" name="<?php echo $this->get_field_name( 'posts_count' ); ?>" class="widefat">
                    <option value="1" <?php selected( absint( $instance[ 'posts_count' ] ), 1 ); ?>>1</option>
                    <option value="2" <?php selected( absint( $instance[ 'posts_count' ] ), 2 ); ?>>2</option>
                    <option value="3" <?php selected( absint( $instance[ 'posts_count' ] ), 3 ); ?>>3</option>
                    <option value="4" <?php selected( absint( $instance[ 'posts_count' ] ), 4 ); ?>>4</option>
                    <option value="5" <?php selected( absint( $instance[ 'posts_count' ] ), 5 ); ?>>5</option>
                    <option value="6" <?php selected( absint( $instance[ 'posts_count' ]  ), 6 ); ?>>6</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php esc_html_e( 'Order:', 'shadowcore' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" class="widefat">
                    <option value="desc" <?php selected( $instance[ 'order' ], 'desc' ); ?>><?php esc_html_e( 'Descending', 'shadowcore' ); ?></option>
                    <option value="asc" <?php selected( $instance[ 'order' ], 'asc' ); ?>><?php esc_html_e( 'Ascending', 'shadowcore' ); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e( 'Order By:', 'shadowcore' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
                    <option value="date" <?php selected(  $instance[ 'orderby' ], 'date' ); ?>><?php esc_html_e( 'Post Date', 'shadowcore' ); ?></option>
                    <option value="rand" <?php selected( $instance[ 'orderby' ], 'rand' ); ?>><?php esc_html_e( 'Random', 'shadowcore' ); ?></option>
                    <option value="ID" <?php selected( $instance[ 'orderby' ], 'ID' ); ?>><?php esc_html_e( 'Post ID', 'shadowcore' ); ?></option>
                    <option value="title" <?php selected( $instance[ 'orderby' ], 'title' ); ?>><?php esc_html_e( 'Post Title', 'shadowcore' ); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php esc_html_e( 'Content Align:', 'shadowcore' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>" class="widefat">
                    <option value="left" <?php selected( $instance[ 'align' ], 'left' ); ?>><?php esc_html_e( 'Left', 'shadowcore' ); ?></option>
                    <option value="right" <?php selected( $instance[ 'align' ], 'right' ); ?>><?php esc_html_e( 'Right', 'shadowcore' ); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image_state' ); ?>"><?php esc_html_e( 'Featured Image:', 'shadowcore' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'image_state' ); ?>" name="<?php echo $this->get_field_name( 'image_state' ); ?>" class="widefat">
                    <option value="show" <?php selected( $instance[ 'image_state' ], 'show' ); ?>><?php esc_html_e( 'Show', 'shadowcore' ); ?></option>
                    <option value="hide" <?php selected( $instance[ 'image_state' ], 'hide' ); ?>><?php esc_html_e( 'Hide', 'shadowcore' ); ?></option>
                </select>
            </p>
        </div><!-- .shadow_widget_settings -->
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance[ 'title' ] = esc_attr( $new_instance[ 'title' ] );
        $instance[ 'posts_count' ] = absint( $new_instance[ 'posts_count' ] );
        $instance[ 'order' ] = esc_attr( $new_instance[ 'order' ] );
        $instance[ 'orderby' ] = esc_attr( $new_instance[ 'orderby' ] );
        $instance[ 'align' ] = esc_attr( $new_instance[ 'align' ] );
        $instance[ 'image_state' ] = esc_attr( $new_instance[ 'image_state' ] );
        
        return $instance;
    }
}
add_action( 'widgets_init', function() {
	register_widget( 'Shadow_Posts_Widget' );
});