<?php

register_nav_menu( 'header', 'Header Menu');
register_nav_menu( 'primary', 'Primary Menu');

show_admin_bar( false );

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

function theme_options_init(){
    register_setting( 'twitstrap_options', 'twitstrap_theme_options');
}

function theme_options_add_page() {
    add_theme_page( __( 'Twitstrap Options', 'twitstrap' ),
                    __( 'Twitstrap Options', 'twitstrap' ),
                    'edit_theme_options',
                    'theme_options',
                    'theme_options_do_page'
                    );
}

function theme_options_do_page() {
    global $select_options;
    if ( ! isset( $_REQUEST['settings-updated'] ) ) {
        $_REQUEST['settings-updated'] = false;
    }
}

add_action( 'init', 'create_post_type' );

function create_post_type() {
    $carousel_args = array('labels' => array(
                                             'name' => __( 'Carousels' ),
                                             'singular_name' => __( 'Carousel' )
                                             ),
                           'description' => 'Posts to be displayed on rotation on the main page.',
                           'public' => true,
                           'show_in_nav_menus' => false,
                           'capability_type' => 'page',
                           'supports' => array(
                                               'title',
                                               'thumbnail',
                                               'excerpt',
                                               'page-attributes'
                                               ),
                           );
    register_post_type( 'carousel', $carousel_args);
}

?>