<?php
/**
 * Twitstrap Function File
 *
 * Much of the Admin Panel settings are courtesy of Sarah Neuber, as
 * posted on wp tuts+. Some parts were modified based on changes to
 * the WP API since the tutorial was written, others based on need for
 * different functionality. Tutorial can be found here:
 * http://goo.gl/gJYbZ
 */


define('TWITSTRAP_SHORTNAME', 'twitstrap');
define('TWITSTRAP_PAGE_BASENAME', 'twitstrap_settings');

require_once('settings.php');
require_once('twitstrap_widgets.php');
register_sidebars(4);

/**
 * Register and create the three nav menus that can be used.
 */
add_action('init', 'register_navmenus');
function register_navmenus() {
    register_nav_menus(array(
                             'header_nav' => __('Header Menu', 'twitstrap'),
                             'inpage_nav' => __('In-Page Menu', 'twitstrap'),
                             'footer_nav' => __('Footer Menu', 'twitstrap')
                             )
                       );

    // Create base for all menus. This can be customised by the user later.
    $menus[] = array('menu-item-type' => 'custom',
                     'menu-item-url' => get_home_url('/'),
                     'menu-item-title' => 'Home' );

    // Check if menus exists, make them if not
    if (!is_nav_menu('Header Menu')) {
        $menu_id = wp_create_nav_menu('Header Menu');
        foreach ($menus as $menu) {
            wp_update_nav_menu_item($menu_id, $menu);
        }
    }

    if (!is_nav_menu('In-Page Menu')) {
        $menu_id = wp_create_nav_menu('In-Page Menu');
        foreach ($menus as $menu) {
            wp_update_nav_menu_item($menu_id, 0, $menu);
        }
    }

    if (!is_nav_menu('Footer Menu')) {
        $menu_id = wp_create_nav_menu('Footer Menu');
        foreach ($menus as $menu) {
            wp_update_nav_menu_item($menu_id, 0, $menu);
        }
    }
}

show_admin_bar( false );

function twitstrap_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
      <p>
        <?php _e('Pingback:', 'twitstrap'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'twitstrap'), '<span class="edit-link">', '</span>'); ?>
      </p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <div class="alert alert-info clearfix">
                <div class="comment-author vcard">
                    <?php
                        $avatar_size = 60;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 32;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twitstrap' ),
                            sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s at %2$s', 'twitstrap' ), get_comment_date(), get_comment_time() )
                            )
                        );
                    ?>

                </div><!-- .comment-author .vcard -->
                <?php edit_comment_link( __( 'Edit', 'twitstrap' ), '<span class="pull-right">', ' <i class="icon-edit"></i></span>' ); ?>

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twitstrap' ); ?></em>
                    <br />
                <?php endif; ?>

            </div>

            <div class="comment-content">
              <?php comment_text(); ?>
            </div>

            <div class="reply clearfix">
              <span class="btn btn-primary btn-small pull-right">
                <?php echo comment_reply_link(array('reply_text' => 'Reply <i class="icon-comment icon-white"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'])); ?>
              </span>
            </div><!-- .reply -->
            <br />
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}


/**
 * Option Page Stuff
 */
add_action('admin_menu', 'twitstrap_add_menu');
add_action('admin_init', 'twitstrap_register_settings');

function twitstrap_get_global_options() {
    $twitstrap_options = array();

    // collect option names as declared in twitstrap_get_settings()
    $twitstrap_option_names = array (
                                     'twitstrap_settings_general',
                                     'twitstrap_settings_main_page',
                                     'twitstrap_settings_footer',
                                     'twitstrap_settings_blog_page',
                                     'twitstrap_settings_posts',
                                     'twitstrap_settings_sidebar'
                                     );

    // loop for get_option
    foreach ($twitstrap_option_names as $twitstrap_option_name) {
        if (get_option($twitstrap_option_name) != FALSE) {
            $option = get_option($twitstrap_option_name);

            // now merge in main $twitstrap_option array!
            $twitstrap_options = array_merge($twitstrap_options, $option);
        }
    }
    return $twitstrap_options;
}

$twitstrap_options = twitstrap_get_global_options();

function twitstrap_scripts(){
    wp_enqueue_style('twitstrap_settings_css',
                     get_template_directory_uri() . '/twitstrap_settings.css');
    wp_enqueue_script('twitstrap_settings_js',
                      get_template_directory_uri() . '/twitstrap_settings.js',
                      array('jquery'));
}

function twitstrap_add_menu() {
    global $twitstrap_settings_page_1;
    global $twitstrap_settings_page_2;

    add_menu_page(__('Twitstrap Settings'),
                  __('Twitstrap Settings','Twitstrap'),
                  'manage_options',
                  TWITSTRAP_PAGE_BASENAME,
                  'twitstrap_render_settings',
                  '',
                  58);

    $twitstrap_settings_page_1 = add_submenu_page(TWITSTRAP_PAGE_BASENAME,
                                                  __('Twitstrap Settings'),
                                                  __('Twitstrap Settings','twitstrap'),
                                                  'manage_options',
                                                  TWITSTRAP_PAGE_BASENAME,
                                                  'twitstrap_render_settings');
    if ($twitstrap_settings_page_1) {
        add_action('load-'.$twitstrap_settings_page_1, 'twitstrap_scripts');
    }

}

function twitstrap_settings_page_help($page) {
    global $twitstrap_settings_page_1;

    $screen = get_current_screen();

    switch ($page) {
        case 1:
            if ($screen->id != $twitstrap_settings_page_1) {
                return;
            }
            $screen->add_help_tab(array(
                                        'id' => 'twitstrap_help1',
                                        'title' => 'Twitstrap Settings Help',
                                        'content' => '<p>This is where the help information goes. This will be filled in soon.<p>'
                                        )
                                  );
            break;
        default:
            break;
    }
}

function twitstrap_get_settings() {
    $output = array();

    $page = twitstrap_get_admin_page();
    $tab = twitstrap_get_the_tab();

    // define variables according to registered admin menu page
    switch ($page) {
        case TWITSTRAP_PAGE_BASENAME:
            $twitstrap_option_name         = 'twitstrap_settings';
            $twitstrap_settings_page_title = __('Twitstrap Settings','twitstrap');
            $twitstrap_page_sections       = twitstrap_options_page_sections();
            $twitstrap_page_fields         = twitstrap_options_page_fields();
            $twitstrap_page_tabs           = twitstrap_options_page_tabs();

            // define a new option name according to tab
            switch ($tab) {
                case 'general':
                    $twitstrap_option_name = $twitstrap_option_name . '_general';
                    break;

                case 'main_page':
                    $twitstrap_option_name = $twitstrap_option_name . '_main_page';
                    break;

                case 'footer':
                    $twitstrap_option_name = $twitstrap_option_name . '_footer';
                    break;

                case 'blog_page':
                    $twitstrap_option_name = $twitstrap_option_name . '_blog_page';
                    break;

                case 'posts':
                    $twitstrap_option_name = $twitstrap_option_name . '_posts';
                    break;

                case 'sidebar':
                    $twitstrap_option_name = $twitstrap_option_name . '_sidebar';
                    break;
            }
            break;
    }

    // put together the output array
    $output['twitstrap_option_name']   = (isset($twitstrap_option_name) ? $twitstrap_option_name : '');
    $output['twitstrap_page_title']    = (isset($twitstrap_settings_page_title) ? $twitstrap_settings_page_title : '');
    $output['twitstrap_page_tabs']     = (isset($twitstrap_page_tabs) ? $twitstrap_page_tabs : '');
    $output['twitstrap_page_sections'] = (isset($twitstrap_page_sections) ? $twitstrap_page_sections : '');
    $output['twitstrap_page_fields']   = (isset($twitstrap_page_fields) ? $twitstrap_page_fields : '');

    return $output;
}

function create_settings_field( $args = array() ) {
    // default array to overwrite when calling the function
    $defaults = array(
                      'id'      => 'default_field',         // ID in options array, and ID of HTML form element
                      'title'   => 'Default Field',         // label for the HTML form element
                      'desc'    => 'Default Description.',  // description displayed under the HTML form element
                      'std'     => '',                      // default value for this setting
                      'type'    => 'text',                  // HTML form element to use
                      'section' => 'main_section',          //  section this setting belongs to
                      'choices' => array(),                 // (optional): values in radio buttons or a drop-down menu
                      'class'   => ''                       // the HTML form element class
                      );

    extract( wp_parse_args( $args, $defaults ) );

    $field_args = array(
                        'type'      => $type,
                        'id'        => $id,
                        'desc'      => $desc,
                        'std'       => $std,
                        'choices'   => $choices,
                        'label_for' => $id,
                        'class'     => $class
                        );

    add_settings_field( $id, $title, 'twitstrap_form_field', __FILE__, $section, $field_args );
}

function twitstrap_render_settings() {
    $settings_output = twitstrap_get_settings();
    ?>
    <div class="wrap">
        <?php echo twitstrap_settings_page_header(); ?>
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

    //sections
    if (!empty($settings_output['twitstrap_page_sections'])) {
        foreach ( $settings_output['twitstrap_page_sections'] as $id => $title ) {
            add_settings_section( $id, $title, 'twitstrap_section_fn', __FILE__);
        }
    }

    //fields
    if (!empty($settings_output['twitstrap_page_fields'])) {
        foreach ($settings_output['twitstrap_page_fields'] as $option) {
            create_settings_field($option);
        }
    }
}

function twitstrap_validate_options($input) {
    // for enhanced security, create a new empty array
    $valid_input = array();

    // get the settings sections array
    $settings_output = twitstrap_get_settings();

    $options = $settings_output['twitstrap_page_fields'];

    // run a foreach and switch on option type
    foreach ($options as $option) {

        switch ($option['type']) {
            case 'text':
            case 'hex-text':
                //switch validation based on the class!
                switch ($option['class']) {
                    //for numeric
                    case 'numeric':
                        //accept the input only when numeric!
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : 'Expecting a Numeric value!';

                        // register error
                        if (is_numeric($input[$option['id']]) == FALSE) {
                            add_settings_error(
                                               $option['id'], // setting title
                                               TWITSTRAP_SHORTNAME . '_txt_numeric_error', // error ID
                                               __('Expecting a Numeric value! Please fix the input.','twitstrap'), // error message
                                               'error' // type of message
                                               );
                        }
                        break;

                    //for multi-numeric values (separated by a comma)
                    case 'multinumeric':
                        //accept the input only when the numeric values are comma separated
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace

                        if ($input[$option['id']] !='') {
                            // /^-?\d+(?:,\s?-?\d+)*$/ matches: -1 | 1 | -12,-23 | 12,23 | -123, -234 | 123, 234  | etc.
                            $valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : __('Expecting comma separated numeric values','twitstrap');
                        } else {
                            $valid_input[$option['id']] = $input[$option['id']];
                        }

                        // register error
                        if ($input[$option['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {
                            add_settings_error(
                                               $option['id'], // setting title
                                               TWITSTRAP_SHORTNAME . '_txt_multinumeric_error', // error ID
                                               __('Expecting comma separated numeric values! Please fix the input.','twitstrap'), // error message
                                               'error' // type of message
                                               );
                        }
                        break;

                    //for no html
                    case 'nohtml':
                        //accept the input only after stripping out all html, extra white space etc!
                        $input[$option['id']] = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                        break;

                    //for CSS HEX values
                    case 'hexval':
                        //accept the input only if it is a HEX value
                        $input[$option['id']] = ltrim($input[$option['id']], "#");
                        if (strtolower($input[$option['id']]) == dechex(hexdec($input[$option['id']])) ) {
                            $valid_input[$option['id']] = "#" . strtoupper($input[$option['id']]);
                        } elseif (empty($input[$option['id']])) {
                            $valid_input[$option['id']] = '';
                        } else {
                            add_settings_error(
                                               $option['id'], // setting title
                                               TWITSTRAP_SHORTNAME . '_txt_hexvalue_error', // error ID
                                               __('Expecting a HEX value! Please fix the input.','twitstrap'), // error message
                                               'error' // type of message
                                               );
                        }
                        break;

                    //for url
                    case 'url':
                        //accept the input only when the url has been sanited for database usage with esc_url_raw()
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $valid_input[$option['id']] = esc_url_raw($input[$option['id']]);
                        break;

                    //for email
                    case 'email':
                        //accept the input only after the email has been validated
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        if ($input[$option['id']] != '') {
                            $valid_input[$option['id']] = (is_email($input[$option['id']])!== FALSE) ? $input[$option['id']] : __('Invalid email! Please re-enter!','twitstrap');
                        } elseif ($input[$option['id']] == '') {
                            $valid_input[$option['id']] = __('This setting field cannot be empty! Please enter a valid email address.','twitstrap');
                        }

                        // register error
                        if (is_email($input[$option['id']])== FALSE || $input[$option['id']] == '') {
                            add_settings_error(
                                               $option['id'], // setting title
                                               TWITSTRAP_SHORTNAME . '_txt_email_error', // error ID
                                               __('Please enter a valid email address.','twitstrap'), // error message
                                               'error' // type of message
                                               );
                        }
                        break;

                    // a "cover-all" fall-back when the class argument is not set
                    default:
                        // accept only a few inline html elements
                        $allowed_html = array(
                                              'a' => array('href' => array (),'title' => array ()),
                                              'b' => array(),
                                              'em' => array (),
                                              'i' => array (),
                                              'strong' => array()
                                              );

                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $input[$option['id']] = force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
                        $input[$option['id']] = wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                        break;
                }
                break;

            case "multi-text":
                // this will hold the text values as an array of 'key' => 'value'
                unset($textarray);

                $text_values = array();
                foreach ($option['choices'] as $k => $v ) {
                    // explode the connective
                    $pieces = explode("|", $v);

                    $text_values[] = $pieces[1];
                }

                foreach ($text_values as $v ) {

                    // Check that the option isn't empty
                    if (!empty($input[$option['id'] . '|' . $v])) {
                        // If it's not null, make sure it's sanitized, add it to an array
                        switch ($option['class']) {
                            // different sanitation actions based on the class create you own cases as you need them

                            //for numeric input
                        case 'numeric':
                            //accept the input only if is numberic!
                            $input[$option['id'] . '|' . $v]= trim($input[$option['id'] . '|' . $v]); // trim whitespace
                            $input[$option['id'] . '|' . $v]= (is_numeric($input[$option['id'] . '|' . $v])) ? $input[$option['id'] . '|' . $v] : '';
                            break;

                            // a "cover-all" fall-back when the class argument is not set
                        default:
                            // strip all html tags and white-space.
                            $input[$option['id'] . '|' . $v]= sanitize_text_field($input[$option['id'] . '|' . $v]); // need to add slashes still before sending to the database
                            $input[$option['id'] . '|' . $v]= addslashes($input[$option['id'] . '|' . $v]);
                            break;
                        }
                        // pass the sanitized user input to our $textarray array
                        $textarray[$v] = $input[$option['id'] . '|' . $v];

                    } else {
                        $textarray[$v] = '';
                    }
                }
                // pass the non-empty $textarray to our $valid_input array
                if (!empty($textarray)) {
                    $valid_input[$option['id']] = $textarray;
                }
                break;

            case 'textarea':
                //switch validation based on the class!
                switch ( $option['class'] ) {
                    //for only inline html
                    case 'inlinehtml':
                        // accept only inline html
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $input[$option['id']] = force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
                        $input[$option['id']] = addslashes($input[$option['id']]); //wp_filter_kses expects content to be escaped!
                        $valid_input[$option['id']] = wp_filter_kses($input[$option['id']]); //calls stripslashes then addslashes
                        break;

                    //for no html
                    case 'nohtml':
                        //accept the input only after stripping out all html, extra white space etc!
                        $input[$option['id']] = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                        break;

                    //for allowlinebreaks
                    case 'allowlinebreaks':
                        //accept the input only after stripping out all html, extra white space etc!
                        $input[$option['id']] = wp_strip_all_tags($input[$option['id']]); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                        break;

                    // a "cover-all" fall-back when the class argument is not set
                    default:
                        // accept only limited html
                        //my allowed html
                        $allowed_html = array(
                                              'a' => array('href' => array (),'title' => array ()),
                                              'b' => array(),
                                              'blockquote' => array('cite' => array ()),
                                              'br' => array(),
                                              'dd' => array(),
                                              'dl' => array(),
                                              'dt' => array(),
                                              'em' => array (),
                                              'i' => array (),
                                              'li' => array(),
                                              'ol' => array(),
                                              'p' => array(),
                                              'q' => array('cite' => array ()),
                                              'strong' => array(),
                                              'ul' => array(),
                                              'h1' => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                                              'h2' => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                                              'h3' => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                                              'h4' => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                                              'h5' => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                                              'h6' => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ())
                                              );

                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $input[$option['id']] = force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup
                        $input[$option['id']] = wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                        break;
                }
                break;

            case 'select':
                // check to see if the selected value is in our approved array of values!
                $valid_input[$option['id']] = (in_array( $input[$option['id']], $option['choices']) ? $input[$option['id']] : '');
                break;

            case 'select2':
                // process $select_values
                $select_values = array();
                foreach ($option['choices'] as $k => $v) {
                    // explode the connective
                    $pieces = explode("|", $v);

                    $select_values[] = $pieces[1];
                }
                // check to see if selected value is in our approved array of values!
                $valid_input[$option['id']] = (in_array( $input[$option['id']], $select_values) ? $input[$option['id']] : '');
                break;

            case 'checkbox':
                // if it's not set, default to null!
                if (!isset($input[$option['id']])) {
                    $input[$option['id']] = null;
                }
                // Our checkbox value is either 0 or 1
                $valid_input[$option['id']] = ( $input[$option['id']] == 1 ? 1 : 0 );
                break;

            case 'multi-checkbox':
                unset($checkboxarray);
                $check_values = array();
                foreach ($option['choices'] as $k => $v ) {
                    // explode the connective
                    $pieces = explode("|", $v);

                    $check_values[] = $pieces[1];
                }

                foreach ($check_values as $v ) {
                    // Check that the option isn't null
                    if (!empty($input[$option['id'] . '|' . $v])) {
                        // If it's not null, make sure it's true, add it to an array
                        $checkboxarray[$v] = 'true';
                    } else {
                        $checkboxarray[$v] = 'false';
                    }
                }
                // Take all the items that were checked, and set them as the main option
                if (!empty($checkboxarray)) {
                    $valid_input[$option['id']] = $checkboxarray;
                }
                break;
        }
    }
    return $valid_input; // return validated input
}

function twitstrap_show_msg($message, $msgclass = 'info') {
    echo "<div id='message' class='$msgclass'>$message</div>";
}

function twitstrap_admin_msgs() {
    $page = (isset($_GET['page']) ? $_GET['page'] : '');

    // check for our settings page - need this in conditional further down
    $twitstrap_settings_pg = strpos($page, TWITSTRAP_PAGE_BASENAME);

    // collect setting errors/notices: //http://codex.wordpress.org/Function_Reference/get_settings_errors
    $set_errors = get_settings_errors();

    //display admin message only for the admin to see, only on our settings page and only when setting errors/notices are returned!
    if (current_user_can('manage_options') && $twitstrap_settings_pg !== FALSE && !empty($set_errors)) {

        // have our settings succesfully been updated?
        if ($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])) {
            twitstrap_show_msg("<p>" . $set_errors[0]['message'] . "</p>", 'updated');

        // have errors been found?
        } else {
            // there maybe more than one so run a foreach loop.
            foreach($set_errors as $set_error) {
                // set the title attribute to match the error "setting title" - need this in js file
                twitstrap_show_msg("<p class='setting-error-message' title='" . $set_error['setting'] . "'>" . $set_error['message'] . "</p>", 'error');
            }
        }
    }
}

// admin messages hook!
add_action('admin_notices', 'twitstrap_admin_msgs');

function twitstrap_section_fn($desc) {
    echo "<p>" . __('Edit settings for this section.','twitstrap') . "</p>";
}

function twitstrap_form_field($args = array()) {
    extract( $args );

    // get the settings sections array
    $settings_output = twitstrap_get_settings();

    $twitstrap_option_name = $settings_output['twitstrap_option_name'];
    $options = get_option($twitstrap_option_name);

    // pass the standard value if the option is not yet set in the database
    if ( !isset( $options[$id] ) && 'type' != 'checkbox' ) {
        $options[$id] = $std;
    }

    // additional field class. output only if the class is defined in the create_setting arguments
    $field_class = ($class != '') ? ' ' . $class : '';

    // switch html display based on the setting type.
    switch ( $type ) {
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text$field_class' type='text' id='$id' name='" . $twitstrap_option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case 'hex-text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text$field_class' type='text' id='$id' name='" . $twitstrap_option_name . "[$id]' value='$options[$id]' maxlength=7 />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case 'multi-text':
            foreach($choices as $item) {
                $item = explode("|",$item); // cat_name|cat_slug
                $item[0] = esc_html__($item[0], 'twitstrap');
                if (!empty($options[$id])) {
                    foreach ($options[$id] as $option_key => $option_val) {
                        if ($item[1] == $option_key) {
                            $value = $option_val;
                        }
                    }
                } else {
                    $value = '';
                }
                echo "<span>$item[0]:</span> <input class='$field_class' type='text' id='$id|$item[1]' name='" . $twitstrap_option_name . "[$id|$item[1]]' value='$value' /><br/>";
            }
            echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
            break;

        case 'textarea':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_html( $options[$id]);
            echo "<textarea class='textarea$field_class' type='text' id='$id' name='" . $twitstrap_option_name . "[$id]' rows='5' cols='30'>$options[$id]</textarea>";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case 'select':
            echo "<select id='$id' class='select$field_class' name='" . $twitstrap_option_name . "[$id]'>";
            foreach($choices as $item) {
                $value = esc_attr($item, 'twitstrap');
                $item = esc_html($item, 'twitstrap');

                $selected = ($options[$id]==$value) ? 'selected="selected"' : '';
                echo "<option value='$value' $selected>$item</option>";
            }
            echo "</select>";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case 'select2':
            echo "<select id='$id' class='select$field_class' name='" . $twitstrap_option_name . "[$id]'>";
            foreach($choices as $item) {

                $item = explode("|",$item);
                $item[0] = esc_html($item[0], 'twitstrap');

                $selected = ($options[$id]==$item[1]) ? 'selected="selected"' : '';
                echo "<option value='$item[1]' $selected>$item[0]</option>";
            }
            echo "</select>";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case 'checkbox':
            echo "<input class='checkbox$field_class' type='checkbox' id='$id' name='" . $twitstrap_option_name . "[$id]' value='1' " . checked( $options[$id], 1, false ) . " />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;

        case "multi-checkbox":
            foreach($choices as $item) {

                $item = explode("|",$item);
                $item[0] = esc_html($item[0], 'twitstrap');

                $checked = '';

                if ( isset($options[$id][$item[1]]) ) {
                    if ( $options[$id][$item[1]] == 'true') {
                        $checked = 'checked="checked"';
                    }
                }

                echo "<input class='checkbox$field_class' type='checkbox' id='$id|$item[1]' name='" . $twitstrap_option_name . "[$id|$item[1]]' value='1' $checked /> $item[0] <br/>";
            }
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
    }
}

/**
 * Helper Functions
 */

function twitstrap_get_admin_page() {
    global $pagenow;

    // read the current page
    if (isset($_GET['page'])) {
        $current_page = trim($_GET['page']);
    } else {
        $current_page = '';
    }

    // use a different way to read the current page name when the form submits
    if ($pagenow == 'options.php') {
        // get the page name
        $parts = explode('page=', $_POST['_wp_http_referer']);
        $page  = $parts[1];

        // account for the use of tabs
        $t = strpos($page,"&");

        if ($t !== FALSE) {
            $page  = substr($parts[1],0,$t);
        }
        $current_page = trim($page);
    }
    return $current_page;
}

function twitstrap_default_tab() {
    // find current page
    $current_page = twitstrap_get_admin_page();

    /**
     * There may be times when the first tab has a different slug from
     * page to page. Here is where you can override the $default_tab =
     * 'general';
     */
    if ($current_page == TWITSTRAP_PAGE_BASENAME) {
        $default_tab = 'general';
    } else {
        $default_tab = '';
    }

    return $default_tab;
}

function twitstrap_get_the_tab() {
    global $pagenow;

    // set default tab
    $default_tab = twitstrap_default_tab();

    // read the current tab when on our settings page
    $current_tab = (isset($_GET['tab']) ? $_GET['tab'] : $default_tab);

    //use a different way to read the tab when the form submits
    if ($pagenow == 'options.php') {
        // need to read the tab name so we explode()!
        $parts = explode('&tab=', $_POST['_wp_http_referer']);
        // count the "exploded" parts
        $partsNum = count($parts);

        /**
         * account for "&settings-updated=true" (we do not want that
         * to be part of our return value!)  is it
         * "&settings-updated=true" there? - check for the "&"
         */
        $settings_updated = strpos($parts[1],"&");

        // filter it out and get the tab name
        $tab_name = ($settings_updated !== FALSE ? substr($parts[1],0,$settings_updated) : $parts[1]);

        // use if found, otherwise pass the default tab name
        $current_tab = ($partsNum == 2 ? trim($tab_name) : $default_tab);
    }

    return $current_tab;
}

function twitstrap_settings_page_header() {
    // get the tabs
    $settings_output = twitstrap_get_settings();
    $tabs = $settings_output['twitstrap_page_tabs'];

    // get the current tab
    $current_tab = twitstrap_get_the_tab();

    // display the icon and page title
    $twitstrap_header = '<div id="icon-options-general" class="icon32"><br /></div>';
    $twitstrap_header .= '<h2>' . $settings_output['twitstrap_page_title'] . '</h2>';

    // check for tabs
    if ($tabs !='') {
        // wrap each in anchor html tags
        $links = array();
        foreach( $tabs as $tab => $name ) {
            // set anchor class
            $class = ($tab == $current_tab ? 'nav-tab nav-tab-active' : 'nav-tab');
            $page = $_GET['page'];
            // the link
            $links[] = "<a class='$class' href='?page=$page&tab=$tab'>$name</a>";
        }

        $twitstrap_header .= '<h3 class="nav-tab-wrapper">';
        foreach ( $links as $link ) {
            $twitstrap_header .= $link;
        }
        $twitstrap_header .= '</h3>';
    }

    return $twitstrap_header;
}

?>