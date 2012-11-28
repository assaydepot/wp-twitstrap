<?php

function twitstrap_options_page_tabs() {
    $tabs = array();
    $tabs['general']   = __('General Settings', 'twitstrap');
    $tabs['main_page'] = __('Main Page', 'twitstrap');
    $tabs['footer']    = __('Footer', 'twitstrap');
    $tabs['blog_page'] = __('Blog Page', 'twitstrap');
    $tabs['posts']     = __('Posts', 'twitstrap');
    $tabs['sidebar']   = __('Sidebar', 'twitstrap');
    //$tabs[''] = __('', 'twitstrap');

    return $tabs;
}

function twitstrap_options_page_sections() {
    // get the current tab
    $tab = twitstrap_get_the_tab();

    // switch sections array according to tab
    switch ($tab) {
        case 'general':
            $sections = array();
            $sections['general_section'] = __('General Twitstrap Settings', 'twitstrap');
            $sections['style_section']   = __('Twitstrap Style Settings', 'twitstrap');
            break;

        case 'main_page':
            $sections = array();
            $sections['main_page_section'] = __('Main Page Settings', 'twitstrap');
            $sections['hero_unit_section'] = __('Hero Unit Settings', 'twitstrap');
            break;

        case 'footer':
            $sections = array();
            $sections['footer_general']   = __('Footer General Settings', 'twitstrap');
            $sections['footer_section_1'] = __('Footer Section 1', 'twitstrap');
            $sections['footer_section_2'] = __('Footer Section 2', 'twitstrap');
            $sections['footer_section_3'] = __('Footer Section 3', 'twitstrap');
            break;

        case 'blog_page':
            $sections = array();
            $sections['blog_page_section'] = __('Blog Page Settings', 'twitstrap');
            break;

        case 'posts':
            $sections = array();
            $sections['posts_section'] = __('Individual Post Settings', 'twitstrap');
            break;

        case 'sidebar':
            $sections = array();
            $sections['sidebar_section'] = __('Sidebar Settings', 'twitstrap');
            break;
    }

    return $sections;
}

function twitstrap_options_page_fields() {
    $tab = twitstrap_get_the_tab();

    // setting fields according to tab
    switch ($tab) {
        case 'general':
            $options[] = array(
                               "section" => "general_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_header_menu",
                               "title"   => __( 'Header Navigation Menu', 'twitstrap' ),
                               "desc"    => __( 'Whether to show the Header Navigation Menu on the site (global option).',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "general_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_page_menu",
                               "title"   => __( 'In-Page Menu', 'twitstrap' ),
                               "desc"    => __( 'Whether to show the In-Page Menu on the site (global option).',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "general_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_toggle",
                               "title"   => __( 'Show Footer', 'twitstrap' ),
                               "desc"    => __( 'Whether to show the Footer on the site (global option).',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "style_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_background_color",
                               "title"   => __( 'Background Color', 'twitstrap' ),
                               "desc"    => __( 'Enter a HEX value.', 'twitstrap' ),
                               "type"    => "hex-text",
                               "std"     => __('#FFFFFF','twitstrap'),
                               "class"   => "hexval"
                               );
            $options[] = array(
                               "section" => "style_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_menu_color_1",
                               "title"   => __( 'Header/In-Page Menu Top Color', 'twitstrap' ),
                               "desc"    => __( 'Enter a HEX value.', 'twitstrap' ),
                               "type"    => "hex-text",
                               "std"     => __('#FFFFFF','twitstrap'),
                               "class"   => "hexval"
                               );
            $options[] = array(
                               "section" => "style_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_menu_color_2",
                               "title"   => __( 'Header/In-Page Menu Bottom Color', 'twitstrap' ),
                               "desc"    => __( 'Enter a HEX value.', 'twitstrap' ),
                               "type"    => "hex-text",
                               "std"     => __('#F2F2F2','twitstrap'),
                               "class"   => "hexval"
                               );
            $options[] = array(
                               "section" => "style_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_font_color",
                               "title"   => __( 'Font Color', 'twitstrap' ),
                               "desc"    => __( 'Enter a HEX value.', 'twitstrap' ),
                               "type"    => "hex-text",
                               "std"     => __('#333333','twitstrap'),
                               "class"   => "hexval"
                               );
            break;

        case 'main_page':
            $options[] = array(
                               "section" => "main_page_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_static",
                               "title"   => __( 'Static Main Page', 'twitstrap' ),
                               "desc"    => __( 'Whether to have a static main page.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "hero_unit_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_hero_unit_toggle",
                               "title"   => __( 'Display Hero Unit on Main Page', 'twitstrap' ),
                               "desc"    => __( 'Show or hide the Hero Unit on the Main Page.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "hero_unit_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_hero_unit_h1",
                               "title"   => __( 'Hero Unit Headline', 'twitstrap' ),
                               "desc"    => __( 'The Headline of the Hero Unit.', 'twitstrap' ),
                               "type"    => "text",
                               "std"     => __('Twitstrap Theme!','twitstrap'),
                               "class"   => "nohtml"
                               );
            $options[] = array(
                               "section" => "hero_unit_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_hero_unit_p",
                               "title"   => __( 'Hero Unit Paragraph text.', 'twitstrap' ),
                               "desc"    => __( 'The main text of the Hero Unit. Some HTML allowed.', 'twitstrap' ),
                               "type"    => "textarea",
                               "std"     => __('Thank you for using the Twitstrap Wordpress Theme!','twitstrap')
                               );
            $options[] = array(
                               "section" => "hero_unit_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_hero_unit_button_text",
                               "title"   => __( 'Hero Unit Button Text', 'twitstrap' ),
                               "desc"    => __( "The Hero Unit's Button text.", 'twitstrap' ),
                               "type"    => "text",
                               "std"     => __('Click Here','twitstrap'),
                               "class"   => "nohtml"
                               );
            $options[] = array(
                               "section" => "hero_unit_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_hero_unit_button_link",
                               "title"   => __( 'Hero Unit Button URL', 'twitstrap' ),
                               "desc"    => __( 'The URL for the Hero Unit Button.', 'twitstrap' ),
                               "type"    => "text",
                               "std"     => "http://www.assaydepot.com",
                               "class"   => "url"
                               );
            break;

        case 'footer':
            $options[] = array(
                               "section" => "footer_general",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_background_color",
                               "title"   => __( 'Footer Background Color', 'twitstrap' ),
                               "desc"    => __( 'Enter a HEX value.', 'twitstrap' ),
                               "type"    => "hex-text",
                               "std"     => __('#F5F5F5','twitstrap'),
                               "class"   => "hexval"
                               );
            $options[] = array(
                               "section" => "footer_section_1",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_1_toggle",
                               "title"   => __( 'Display Footer Section 1', 'twitstrap' ),
                               "desc"    => __( 'Show or hide the first Footer section.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "footer_section_1",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_1_menu",
                               "title"   => __( 'Use Footer Menu in Section 1', 'twitstrap' ),
                               "desc"    => __( 'Use the custom menu (Footer Menu) in this footer section.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "footer_section_1",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_1_align",
                               "title"   => __( 'Alignment for Footer Section 1', 'twitstrap' ),
                               "desc"    => __( 'Choose from the options in the dropdown.', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "",
                               "choices" => array( __('Left','twitstrap') . "|left",
                                                   __('Center','twitstrap') . "|center",
                                                   __('Right','twitstrap') . "|right")
                               );
            $options[] = array(
                               "section" => "footer_section_1",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_1_title",
                               "title"   => __( 'Footer Section 1 Title', 'twitstrap' ),
                               "desc"    => __( 'Title of Footer Section 1.', 'twitstrap' ),
                               "type"    => "text",
                               "std"     => __('Footer Section 1','twitstrap'),
                               "class"   => "nohtml"
                               );
            $options[] = array(
                               "section" => "footer_section_1",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_1_text",
                               "title"   => __( 'Footer Section 1 Title', 'twitstrap' ),
                               "desc"    => __( 'Title of Footer Section 1.', 'twitstrap' ),
                               "type"    => "textarea",
                               "std"     => __('<p>Footer Section 1 text area. Can use some HTML here.</p>',
                                               'twitstrap'),
                               );
            $options[] = array(
                               "section" => "footer_section_2",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_2_toggle",
                               "title"   => __( 'Display Footer Section 2', 'twitstrap' ),
                               "desc"    => __( 'Show or hide the first Footer section.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "footer_section_2",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_2_menu",
                               "title"   => __( 'Use Footer Menu in Section 2', 'twitstrap' ),
                               "desc"    => __( 'Use the custom menu (Footer Menu) in this footer section.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 0
                               );
            $options[] = array(
                               "section" => "footer_section_2",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_2_align",
                               "title"   => __( 'Alignment for Footer Section 2', 'twitstrap' ),
                               "desc"    => __( 'Choose from the options in the dropdown.', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "",
                               "choices" => array( __('Left','twitstrap') . "|left",
                                                   __('Center','twitstrap') . "|center",
                                                   __('Right','twitstrap') . "|right")
                               );
            $options[] = array(
                               "section" => "footer_section_2",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_2_title",
                               "title"   => __( 'Footer Section 2 Title', 'twitstrap' ),
                               "desc"    => __( 'Title of Footer Section 2.', 'twitstrap' ),
                               "type"    => "text",
                               "std"     => __('Footer Section 2','twitstrap'),
                               "class"   => "nohtml"
                               );
            $options[] = array(
                               "section" => "footer_section_2",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_2_text",
                               "title"   => __( 'Footer Section 2 Title', 'twitstrap' ),
                               "desc"    => __( 'Title of Footer Section 2.', 'twitstrap' ),
                               "type"    => "textarea",
                               "std"     => __('<p>Footer Section 2 text area. Can use some HTML here.</p>',
                                               'twitstrap'),
                               );
            $options[] = array(
                               "section" => "footer_section_3",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_3_toggle",
                               "title"   => __( 'Display Footer Section 3', 'twitstrap' ),
                               "desc"    => __( 'Show or hide the first Footer section.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 1
                               );
            $options[] = array(
                               "section" => "footer_section_3",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_3_menu",
                               "title"   => __( 'Use Footer Menu in Section 3', 'twitstrap' ),
                               "desc"    => __( 'Use the custom menu (Footer Menu) in this footer section.',
                                                'twitstrap' ),
                               "type"    => "checkbox",
                               "std"     => 0
                               );
            $options[] = array(
                               "section" => "footer_section_3",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_3_align",
                               "title"   => __( 'Alignment for Footer Section 3', 'twitstrap' ),
                               "desc"    => __( 'Choose from the options in the dropdown.', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "",
                               "choices" => array( __('Left','twitstrap') . "|left",
                                                   __('Center','twitstrap') . "|center",
                                                   __('Right','twitstrap') . "|right")
                               );
            $options[] = array(
                               "section" => "footer_section_3",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_3_title",
                               "title"   => __( 'Footer Section 3 Title', 'twitstrap' ),
                               "desc"    => __( 'Title of Footer Section 3.', 'twitstrap' ),
                               "type"    => "text",
                               "std"     => __('Footer Section 3','twitstrap'),
                               "class"   => "nohtml"
                               );
            $options[] = array(
                               "section" => "footer_section_3",
                               "id"      => TWITSTRAP_SHORTNAME . "_footer_3_text",
                               "title"   => __( 'Footer Section 3 Title', 'twitstrap' ),
                               "desc"    => __( 'Title of Footer Section 3.', 'twitstrap' ),
                               "type"    => "textarea",
                               "std"     => __('<p>Footer Section 3 text area. Can use some HTML here.</p>',
                                               'twitstrap'),
                               );
            break;

        case 'blog_page':

            break;

        case 'posts':

            break;

        case 'sidebar':
            $options[] = array(
                               "section" => "sidebar_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_main_sidebar",
                               "title"   => __( 'Main Page:', 'twitstrap' ),
                               "desc"    => __( '', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "right",
                               "choices" => array( __('Left Sidebar','twitstrap') . "|left",
                                                   __('Right Sidebar','twitstrap') . "|right",
                                                   __('No Sidebar','twitstrap') . "|none")
                               );
            $options[] = array(
                               "section" => "sidebar_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_blog_sidebar",
                               "title"   => __( 'Blog Page:', 'twitstrap' ),
                               "desc"    => __( '', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "right",
                               "choices" => array( __('Left Sidebar','twitstrap') . "|left",
                                                   __('Right Sidebar','twitstrap') . "|right",
                                                   __('No Sidebar','twitstrap') . "|none")
                               );
            $options[] = array(
                               "section" => "sidebar_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_post_sidebar",
                               "title"   => __( 'Single Post:', 'twitstrap' ),
                               "desc"    => __( '', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "right",
                               "choices" => array( __('Left Sidebar','twitstrap') . "|left",
                                                   __('Right Sidebar','twitstrap') . "|right",
                                                   __('No Sidebar','twitstrap') . "|none")
                               );
            $options[] = array(
                               "section" => "sidebar_section",
                               "id"      => TWITSTRAP_SHORTNAME . "_page_sidebar",
                               "title"   => __( 'Standard Page:', 'twitstrap' ),
                               "desc"    => __( '', 'twitstrap' ),
                               "type"    => "select2",
                               "std"    => "none",
                               "choices" => array( __('Left Sidebar','twitstrap') . "|left",
                                                   __('Right Sidebar','twitstrap') . "|right",
                                                   __('No Sidebar','twitstrap') . "|none")
                               );
            break;
    }

    return $options;
}

?>