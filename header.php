<?php $twitstrap_options = twitstrap_get_global_options(); ?>
<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php wp_title('|'); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo get_template_directory_uri(); ?>/style.php" rel="stylesheet" type="text/css" />
    <?php
    // Enable for pages with comments
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // call wp_head(), but do it before bootstrap so jQuery loads first
    wp_head();
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/extra.js"></script>
</head>

<body itemscope itemtype="http://schema.org/Blog" <?php body_class(); ?>>
  <?php
  if ($twitstrap_options['twitstrap_header_menu'] == 1) {
  ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <?php $args = array(
                      'theme_location'  => 'header_nav',
                      'menu_class'      => 'nav nav-collapse pull-right',
                      'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
            ); ?>
            <?php wp_nav_menu( $args ); ?>
        </div>
    </div>
  <?php } ?>

    <div class="container">
        <div class="row-fluid">
            <div class="page-header span12">
                <h1>
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name').' - '.get_bloginfo('description'); ?>" id="logo-link" itemprop="url">
                       <span itemprop="name">
                           <?php echo get_bloginfo('name') ?>
                       </span>
                    </a><br />
                <small itemprop="description"><?php echo get_bloginfo('description'); ?></small></h1>
            </div>
        </div>
      <?php
      if ($twitstrap_options['twitstrap_page_menu'] == 1) {
      ?>
        <div class="navbar">
            <div class="navbar-inner">
                <?php $args = array(
                          'theme_location'  => 'inpage_nav',
                          'menu_class'      => 'nav',
                          'after'           => '<li class="divider-vertical"></li>',
                          'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ); ?>
                <?php wp_nav_menu( $args ); ?>
            </div>
        </div>
      <?php } ?>
    </div>