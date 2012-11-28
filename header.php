<?php $twitstrap_options = twitstrap_get_global_options(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php bloginfo('url'); ?>/?custom_css=true" rel="stylesheet" type="text/css" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
  if ($twitstrap_options['twitstrap_header_menu'] == 1) {
  ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <?php $args = array(
                      'theme_location'  => 'header_nav',
                      'menu'            => 'header_nav',
                      'container'       => false,
                      'container_class' => '',
                      'container_id'    => '',
                      'menu_class'      => 'nav nav-collapse pull-right',
                      'menu_id'         => 'header_nav',
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
            <?php wp_nav_menu( $args ); ?>
        </div>
    </div>
  <?php } ?>

    <div class="container">
        <div class="row-fluid">
            <div class="page-header span12">
                <h1>
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name').' - '.get_bloginfo('description'); ?>" id="logo-link">
                        <?php echo get_bloginfo('name') ?>
                    </a><br />
                <small><?php echo get_bloginfo('description'); ?></small></h1>
            </div>
        </div>
      <?php
      if ($twitstrap_options['twitstrap_page_menu'] == 1) {
      ?>
        <div class="navbar">
            <div class="navbar-inner">
                <?php $args = array(
                          'theme_location'  => 'inpage_nav',
                          'menu'            => 'inpage_nav',
                          'container'       => false,
                          'container_class' => '',
                          'container_id'    => '',
                          'menu_class'      => 'nav',
                          'menu_id'         => 'inpage_nav',
                          'echo'            => true,
                          'fallback_cb'     => 'wp_page_menu',
                          'before'          => '',
                          'after'           => '<li class="divider-vertical"></li>',
                          'link_before'     => '',
                          'link_after'      => '',
                          'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                          'depth'           => 0,
                          'walker'          => ''
                ); ?>
                <?php wp_nav_menu( $args ); ?>
            </div>
        </div>
      <?php } ?>
    </div>