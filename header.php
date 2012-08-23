<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <?php $defaults = array(
                      'theme_location'  => '',
                      'menu'            => '',
                      'container'       => 'div',
                      'container_class' => 'container-fluid',
                      'container_id'    => '',
                      'menu_class'      => 'nav nav-collapse pull-right',
                      'menu_id'         => 'header-nav',
                      'echo'            => true,
                      'fallback_cb'     => 'wp_page_menu',
                      'before'          => '',
                      'after'           => '',
                      'link_before'     => '',
                      'link_after'      => '',
                      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                      'depth'           => 0,
                      'walker'          => ''
            ); ?>
            <?php wp_nav_menu( $defaults ); ?>
        </div>
    </div>

    <div class="navbar">
        <div class="navbar-inner">
            <?php $defaults = array(
                      'theme_location'  => '',
                      'menu'            => '',
                      'container'       => 'div',
                      'container_class' => 'container-fluid',
                      'container_id'    => '',
                      'menu_class'      => 'nav',
                      'menu_id'         => 'header-nav',
                      'echo'            => true,
                      'fallback_cb'     => 'wp_page_menu',
                      'before'          => '',
                      'after'           => '',
                      'link_before'     => '',
                      'link_after'      => '',
                      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                      'depth'           => 0,
                      'walker'          => ''
            ); ?>
            <?php wp_nav_menu( $defaults ); ?>
        </div>
    </div>