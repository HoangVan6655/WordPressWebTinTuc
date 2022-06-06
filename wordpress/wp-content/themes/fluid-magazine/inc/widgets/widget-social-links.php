<?php
/**
 * Widget Social Networks
 *
 * @package Fluid_Magazine
 */

// register Fluid_Magazine_Social_Networks widget 
function fluid_magazine_register_social_networks_widget() {
    register_widget( 'Fluid_Magazine_Social_Networks' );
}
add_action( 'widgets_init', 'fluid_magazine_register_social_networks_widget' );

if ( ! class_exists( 'Fluid_Magazine_Social_Networks' ) ):   
 /**
 * Adds Fluid_Magazine_Social_Networks widget.
 */
class Fluid_Magazine_Social_Networks extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'fluid_magazine_social_networks', // Base ID
			esc_html__( 'RARA: Social Networks', 'fluid-magazine' ), // Name
			array( 'description' => esc_html__( 'A Social Networks Widget', 'fluid-magazine' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	   
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : '';		
        $facebook       = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '' ;
        $twitter        = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '' ;
        $google_plus    = ! empty( $instance['google_plus'] ) ? $instance['google_plus'] : '' ;
        $linkedin       = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '' ;
        $pinterest      = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '' ;
        $instagram      = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '' ;
        $youtube        = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '' ;
        $ok             = ! empty( $instance['ok'] ) ? esc_url( $instance['ok'] ) : '' ;
        $vk             = ! empty( $instance['vk'] ) ? esc_url( $instance['vk'] ) : '' ;
        $xing           = ! empty( $instance['xing'] ) ? esc_url( $instance['xing'] ) : '' ;
        
        if( $facebook || $instagram || $twitter || $google_plus || $pinterest || $linkedin || $youtube || $ok || $vk || $xing  ){ 
        echo $args['before_widget'];
        if($title )
        echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
        ?>
            <ul class="social-networks">
				<?php if( $facebook ){ ?>
                    <li><a href="<?php echo esc_url( $facebook ) ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'fluid-magazine' ); ?>"><i class="fab fa-facebook-f"></i></a></li>
				<?php } if( $twitter ){ ?>
                    <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'fluid-magazine' ); ?>"><i class="fab fa-twitter"></i></a></li>
                <?php } if( $google_plus ){ ?>
                    <li><a href="<?php echo esc_url( $google_plus ); ?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'fluid-magazine' ); ?>" ><i class="fab fa-google-plus-g"></i></a></li>
                <?php } if( $linkedin ){ ?>
                    <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" title="<?php esc_attr_e( 'Linkedin', 'fluid-magazine' ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                <?php } if( $pinterest ){ ?>
                    <li><a href="<?php echo esc_url( $pinterest ); ?>"  target="_blank" title="<?php esc_attr_e( 'Pinterest', 'fluid-magazine' ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                <?php } if( $instagram ){ ?>
                    <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'fluid-magazine' ); ?>"><i class="fab fa-instagram"></i></a></li>
                <?php } if( $youtube ){ ?>
                    <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'fluid-magazine' ); ?>"><i class="fab fa-youtube"></i></a></li>
                <?php } if( $ok ){ ?>
                    <li><a href="<?php echo esc_url( $ok ); ?>" target="_blank" title="<?php esc_attr_e( 'OK', 'fluid-magazine' ); ?>"><i class="fab fa-odnoklassniki"></i></a></li>
                <?php } if( $vk ){ ?>
                    <li><a href="<?php echo esc_url( $vk ); ?>" target="_blank" title="<?php esc_attr_e( 'VK', 'fluid-magazine' ); ?>"><i class="fab fa-vk"></i></a></li>
                <?php } if( $xing ){ ?>
                    <li><a href="<?php echo esc_url( $xing ); ?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'fluid-magazine' ); ?>"><i class="fab fa-xing"></i></a></li>
                <?php } ?>
			</ul>
        <?php
        echo $args['after_widget'];
        }
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $title          = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';       
        $facebook       = ! empty( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '' ;
        $twitter        = ! empty( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '' ;
        $pinterest      = ! empty( $instance['pinterest'] ) ? esc_url( $instance['pinterest'] ) : '' ;
        $linkedin       = ! empty( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '' ;
        $instagram      = ! empty( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '' ;
        $youtube        = ! empty( $instance['youtube'] ) ? esc_url( $instance['youtube'] ) : '' ;
        $google_plus    = ! empty( $instance['google_plus'] ) ? esc_url( $instance['google_plus'] ) : '' ;
        $ok             = ! empty( $instance['ok'] ) ? esc_url( $instance['ok'] ) : '' ;
        $vk             = ! empty( $instance['vk'] ) ? esc_url( $instance['vk'] ) : '' ;
        $xing           = ! empty( $instance['xing'] ) ? esc_url( $instance['xing'] ) : '' ;
        
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>"><?php esc_html_e( 'Goolge Plus', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" type="text" value="<?php echo esc_attr( $google_plus ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
		</p>
                
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'YouTube', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ok' ) ); ?>"><?php _e( 'OK', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ok' ) ); ?>" type="text" value="<?php echo esc_url( $ok ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php _e( 'VK', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" value="<?php echo esc_url( $vk ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>"><?php _e( 'Xing', 'fluid-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'xing' ) ); ?>" type="text" value="<?php echo esc_url( $xing ); ?>" />
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']          = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) :'';
        $instance['facebook']       = ! empty( $new_instance['facebook'] ) ? esc_url_raw( $new_instance['facebook'] ) : '';
        $instance['instagram']      = ! empty( $new_instance['instagram'] ) ? esc_url_raw( $new_instance['instagram'] ) : '';
        $instance['twitter']        = ! empty( $new_instance['twitter'] ) ? esc_url_raw( $new_instance['twitter'] ) : '';
        $instance['pinterest']      = ! empty( $new_instance['pinterest'] ) ? esc_url_raw( $new_instance['pinterest'] ) : '';
        $instance['linkedin']       = ! empty( $new_instance['linkedin'] ) ? esc_url_raw( $new_instance['linkedin'] ) : '';
        $instance['google_plus']    = ! empty( $new_instance['google_plus'] ) ? esc_url_raw( $new_instance['google_plus'] ) : '';
        $instance['youtube']        = ! empty( $new_instance['youtube'] ) ? esc_url_raw( $new_instance['youtube'] ) : '';
        $instance['ok']             = ! empty( $new_instance['ok'] ) ? esc_url_raw( $new_instance['ok'] ) : '' ;
        $instance['vk']             = ! empty( $new_instance['vk'] ) ? esc_url_raw( $new_instance['vk'] ) : '' ;
        $instance['xing']           = ! empty( $new_instance['xing'] ) ? esc_url_raw( $new_instance['xing'] ) : '' ;
		
        return $instance;
                
	}

} // class Fluid_Magazine_Social_Links 
endif;