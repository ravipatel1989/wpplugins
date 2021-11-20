<?php
class create_wpd_widget{
    public function init(){
        add_action( 'widgets_init', array($this,'Wpd_ws_example_widget') );
    }
    public function Wpd_ws_example_widget() {
        register_widget( 'Wpd_ws_example_widget' );
    }
}
$newwidgetObj = new create_wpd_widget();
$newwidgetObj->init();


class Wpd_ws_example_widget extends WP_Widget {
  
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'Wpd_ws_example_widget', 
        
        // Widget name will appear in UI
        __('Wpd ws example widget', 'Wpd_ws_example_widget'), 
        
        // Widget description
        array( 'description' => __( 'Wpd ws example widget', 'Wpd_ws_example_widget' ), ) 
        );
    }
    // Creating widget front-end
      
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $first_name = apply_filters( 'widget_title', $instance['first_name'] );
        $last_name = apply_filters( 'widget_title', $instance['last_name'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo __( '<h1>'.$title.'</h1>', 'Wpd_ws_example_widget' );
        if($first_name!=""){
            echo __("Hello, My name is $first_name $last_name");
        }
        echo $args['after_widget'];
    }
              
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Title', 'Wpd_ws_example_widget' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
        if ( isset( $instance[ 'first_name' ] ) ) {
            $first_name = $instance[ 'first_name' ];
        }
        else {
            $first_name = __( 'First Name', 'Wpd_ws_example_widget' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'first_name' ); ?>"><?php _e( 'First Name:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'first_name' ); ?>" name="<?php echo $this->get_field_name( 'first_name' ); ?>" type="text" value="<?php echo esc_attr( $first_name ); ?>" />
        </p>
        <?php
        if ( isset( $instance[ 'last_name' ] ) ) {
            $last_name = $instance[ 'last_name' ];
        }
        else {
            $last_name = __( 'Last Name', 'Wpd_ws_example_widget' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'last_name' ); ?>"><?php _e( 'Last Name:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'last_name' ); ?>" name="<?php echo $this->get_field_name( 'last_name' ); ?>" type="text" value="<?php echo esc_attr( $last_name ); ?>" />
        </p>
        <?php 
        if ( isset( $instance[ 'gender' ] ) ) {
            $gender = $instance[ 'gender' ];
        }
        else {
            $gender = __( 'Gender', 'Wpd_ws_example_widget' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'gender' ); ?>"><?php _e( 'Gender:' ); ?></label> 
        <select class="widefat" id="<?php echo $this->get_field_id( 'gender' ); ?>" name="<?php echo $this->get_field_name( 'gender' ); ?>">
            <option value="">- Select gender -</option>
            <option value="male" <?php if($gender == "male"){ echo 'selected'; } ?>>Male</option>
            <option value="female" <?php if($gender =="female"){echo 'selected'; }  ?>>Female</option>
        </select>
        </p>
        <?php
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['first_name'] = ( ! empty( $new_instance['first_name'] ) ) ? strip_tags( $new_instance['first_name'] ) : '';
        $instance['last_name'] = ( ! empty( $new_instance['last_name'] ) ) ? strip_tags( $new_instance['last_name'] ) : '';
        $instance['gender'] = ( ! empty( $new_instance['gender'] ) ) ? strip_tags( $new_instance['gender'] ) : '';

        return $instance;
    }
     
// Class wpb_widget ends here
} 