<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 
/**
 * custom option and settings
 */
function mysettings_settings_init() {
    if(isset($_POST['mysettings_options'])){
        $upload_path = "";
        if(isset($_FILES['mysettings_options']['name'])){
            $uploadDir = wp_upload_dir();
            $filename = strtotime("now").basename($_FILES["mysettings_options"]["name"]["mysettings_field_image"]);
            $upload_path = $uploadDir['path'].'/'.$filename;
            if(move_uploaded_file($_FILES['mysettings_options']["tmp_name"]["mysettings_field_image"], $upload_path)){
                $_POST['mysettings_options']['uploaded_image'] = $uploadDir['url'].'/'.$filename;
            }
        }
        if(isset($_POST['editor_content'])){
            $_POST['mysettings_options']['editor_content'] = filter_input(INPUT_POST,'editor_content');
        }
        
        $args = array(
            'my_setting_values'=> filter_input(INPUT_POST,'mysettings_options'),
        );
        register_setting( 'mysettings_options', 'my_setting_values', $args );
    }
    // Register a new setting for "mysettings" page.
    register_setting( 'mysettings', 'mysettings_options' );
 
    // Register a new section in the "mysettings" page.
    add_settings_section(
        'mysettings_section_developers',
        __( 'WP settings and widget page', 'mysettings' ), 'mysettings_section_developers_callback',
        'mysettings'
    );
 
    // Register a new field in the "mysettings_section_developers" section, inside the "mysettings" page.
    add_settings_field(
        'mysettings_field_title', 
            __( 'Title', 'mysettings' ),
        'mysettings_field_title_cb',
        'mysettings',
        'mysettings_section_developers',
        array(
            'label_for'         => 'mysettings_field_title',
            'class'             => 'mysettings_row',
        )
    );
    add_settings_field(
        'mysettings_field_description', 
            __( 'Description', 'mysettings' ),
        'mysettings_field_description_cb',
        'mysettings',
        'mysettings_section_developers',
        array(
            'label_for'         => 'mysettings_field_description',
            'class'             => 'mysettings_row',
        )
    );
    add_settings_field(
        'mysettings_field_content', 
            __( 'Content', 'mysettings' ),
        'mysettings_field_content_cb',
        'mysettings',
        'mysettings_section_developers',
        array(
            'label_for'         => 'mysettings_field_content',
            'class'             => 'mysettings_row',
        )
    );
    add_settings_field(
        'mysettings_field_date', 
            __( 'Date', 'mysettings' ),
        'mysettings_field_date_cb',
        'mysettings',
        'mysettings_section_developers',
        array(
            'label_for'         => 'mysettings_field_date',
            'class'             => 'mysettings_row',
        )
    );
    add_settings_field(
        'mysettings_field_image', 
            __( 'Image', 'mysettings' ),
        'mysettings_field_image_cb',
        'mysettings',
        'mysettings_section_developers',
        array(
            'label_for'         => 'mysettings_field_image',
            'class'             => 'mysettings_row',
        )
    );
    add_settings_field(
        'mysettings_field_color', 
            __( 'Color', 'mysettings' ),
        'mysettings_field_color_cb',
        'mysettings',
        'mysettings_section_developers',
        array(
            'label_for'         => 'mysettings_field_color',
            'class'             => 'mysettings_row',
        )
    );
}
 
add_action( 'admin_init', 'mysettings_settings_init' );
 
function mysettings_section_developers_callback( $args ) {
}
 
function mysettings_field_title_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'mysettings_options' );
    ?>
    <input class="widefat" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mysettings_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo __($options['mysettings_field_title']);?>" />
    <p>Enter the title</p>
    <?php
}

function mysettings_field_description_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'mysettings_options' );
    ?>
    <textarea name="mysettings_options[<?php echo esc_attr( $args['label_for'] ); ?>]" id="<?php echo esc_attr( $args['label_for'] ); ?>" cols="120" rows="5"><?php echo __($options['mysettings_field_description']);?></textarea>
    <p>Enter the description</p>
    <?php
}

function mysettings_field_content_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'mysettings_options' );
    
    wp_editor( $options['editor_content'], 'editor_content');
}

function mysettings_field_date_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'mysettings_options' );
    ?>
    <input class="widefat" id="datepicker" name="mysettings_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo __($options['mysettings_field_date']);?>" />
    <?php
}

function mysettings_field_image_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'mysettings_options' );
    ?>
    <input type="file" class="widefat" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mysettings_options[<?php echo esc_attr( $args['label_for'] ); ?>]" />
    <?php
    if(isset($options['uploaded_image'])){
        echo '<img src="'.$options['uploaded_image'].'" width="100" />';
    }
}

function mysettings_field_color_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'mysettings_options' );
    $palette = '';
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mysettings_options[<?php echo esc_attr( $args['label_for'] ); ?>]" maxlength="6" value="<?php echo __($options['mysettings_field_color']);?>" class="widefat" />
    <?php
}
/**
 * Add the top level menu page.
 */
function mysettings_options_page() {
    add_menu_page(
        'mysettings',
        'mysettings Options',
        'manage_options',
        'mysettings',
        'mysettings_options_page_html'
    );
}

add_action( 'admin_menu', 'mysettings_options_page' );
 

function mysettings_options_page_html() {
    // check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'mysettings_messages', 'mysettings_message', __( 'Settings Saved', 'mysettings' ), 'updated' );
    }
    settings_errors( 'mysettings_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo __('WP settings and widget page');?></h1>
        <form action="options.php" method="post" enctype="multipart/form-data">
            <?php
            settings_fields( 'mysettings' );
            do_settings_sections( 'mysettings' );
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}