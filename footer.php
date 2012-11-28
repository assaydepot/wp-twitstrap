<?php
$twitstrap_options = twitstrap_get_global_options();

$args = array(
              'theme_location'  => 'footer_nav',
              'menu'            => 'footer_nav',
              'container'       => false,
              'container_class' => '',
              'container_id'    => '',
              'menu_class'      => 'nav nav-tabs nav-stacked',
              'menu_id'         => 'footer_nav',
              'echo'            => true,
              'fallback_cb'     => 'wp_page_menu',
              'before'          => '',
              'after'           => '',
              'link_before'     => '',
              'link_after'      => '',
              'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth'           => 0,
              'walker'          => ''
              );
?>
<div class="container twitstrap_footer">
  <div class="row-fluid">
  <?php if ($twitstrap_options['twitstrap_footer_toggle'] == 1) { ?>
    <?php if ($twitstrap_options['twitstrap_footer_1_toggle'] == 1) { ?>
      <?php if ($twitstrap_options['twitstrap_footer_1_menu'] == 1) { ?>
        <div class="span4 twitstrap_footer_section_1">
             <?php wp_nav_menu( $args ); ?>
        </div>
      <?php } else { ?>
        <div class="span4 twitstrap_footer_section_1">
          <h4><?php echo $twitstrap_options['twitstrap_footer_1_title']; ?></h4>
          <?php echo $twitstrap_options['twitstrap_footer_1_text']; ?>
        </div>
      <?php } ?>
    <?php } ?>

    <?php if ($twitstrap_options['twitstrap_footer_2_toggle'] == 1) { ?>
      <?php if ($twitstrap_options['twitstrap_footer_2_menu'] == 1) { ?>
        <div class="span4 twitstrap_footer_section_2">
             <?php wp_nav_menu( $args ); ?>
        </div>
      <?php } else { ?>
        <div class="span4 twitstrap_footer_section_2">
          <h4><?php echo $twitstrap_options['twitstrap_footer_2_title']; ?></h4>
          <?php echo $twitstrap_options['twitstrap_footer_2_text']; ?>
        </div>
      <?php } ?>
    <?php } ?>

    <?php if ($twitstrap_options['twitstrap_footer_3_toggle'] == 1) { ?>
      <?php if ($twitstrap_options['twitstrap_footer_3_menu'] == 1) { ?>
        <div class="span4 twitstrap_footer_section_3">
             <?php wp_nav_menu( $args ); ?>
        </div>
      <?php } else { ?>
        <div class="span4 twitstrap_footer_section_3">
          <h4><?php echo $twitstrap_options['twitstrap_footer_3_title']; ?></h4>
          <?php echo $twitstrap_options['twitstrap_footer_3_text']; ?>
        </div>
      <?php } ?>
    <?php } ?>
  <?php } ?>
  </div>
<?php wp_footer(); ?>
</div>
</html>
