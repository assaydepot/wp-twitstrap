<?php

require_once('settings.php');

register_nav_menu('header', 'Header Menu');
register_nav_menu('primary', 'Primary Menu');

show_admin_bar( false );

add_action('admin_menu', 'twitstrap_settings_menu');
add_action('admin_init', 'twitstrap_register_settings');

function twitstrap_settings_menu() {
    add_theme_page( __('Twitstrap Options', 'twitstrap'),
                    __('Twitstrap Options', 'twitstrap'),
                    'edit_theme_options',
                    'twitstrap_settings',
                    'twitstrap_render_settings');
}

function twitstrap_get_settings() {
    $output = array();

    $output['twitstrap_option_name']     = 'twitstrap_options'; // the option name as used in the get_option() call.
    $output['twitstrap_page_title']      = __('Twitstrap Options', 'twitstrap'); // the settings page title
    $output['twitstrap_page_sections']   = twitstrap_options_page_sections(); // the setting section
    $output['twitstrap_page_fields']     = ''; // the setting fields
    $output['twitstrap_contextual_help'] = ''; // the contextual help

    return $output;
}

function twitstrap_render_settings() {
    $settings_output = twitstrap_get_settings();
    ?>
    <div class="wrap">
        <div class="icon32" id="icon-options-general"></div>
        <h2><?php echo $settings_output['twitstrap_page_title']; ?></h2>

        <form action="options.php" method="post">
            <?php
            settings_fields($settings_output['twitstrap_option_name']);
            do_settings_sections(__FILE__);
            ?>
            <p class="submit">
                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes','twitstrap'); ?>" />
            </p>
        </form>
    </div><!-- wrap -->
<?php
}

function twitstrap_register_settings() {
    $settings_output = twitstrap_get_settings();
    $twitstrap_option_name = $settings_output['twitstrap_option_name'];

    register_setting($twitstrap_option_name,
                     $twitstrap_option_name,
                     'twitstrap_validate_options');

    if( ! empty($settings_output['twitstrap_page_sections']) ) {
        foreach ( $settings_output['twitstrap_page_sections'] as $id => $title ) {
            add_settings_section( $id, $title, 'twitstrap_section_fn', __FILE__);
        }
    }
}

function twitstrap_validate_options($input) {
    $valid_input = array();
    return $valid_input;
}

function  twitstrap_section_fn($desc) {
    echo "<p>" . __('Settings for this section','twitstrap') . "</p>";
}

?>