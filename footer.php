<?php
$twitstrap_options = twitstrap_get_global_options();

$args = array(
    'theme_location' => 'footer_nav',
    'container'      => false,
    'items_wrap'     => '<ul class="%2$s nav nav-pills nav-stacked">%3$s</ul>',
);
?>

<?php if ( $twitstrap_options['twitstrap_footer_toggle'] == 1 ) { ?>
    <footer>
        <div class="container twitstrap_footer">
            <div class="row">
                <?php if ( $twitstrap_options['twitstrap_footer_1_toggle'] == 1 ) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-8 twitstrap_footer_section_1">
                        <?php if ( ! dynamic_sidebar( 2 ) ) : ?>
                            <h2><?php echo $twitstrap_options['twitstrap_footer_1_title']; ?></h2>
                            <?php echo $twitstrap_options['twitstrap_footer_1_text']; ?>
                        <?php endif; ?>
                    </div>
                <?php } ?>

                <?php if ( $twitstrap_options['twitstrap_footer_2_toggle'] == 1 ) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-8 twitstrap_footer_section_2">
                        <?php if ( ! dynamic_sidebar( 3 ) ) : ?>
                            <h2><?php echo $twitstrap_options['twitstrap_footer_2_title']; ?></h2>
                            <?php echo $twitstrap_options['twitstrap_footer_2_text']; ?>
                        <?php endif; ?>
                    </div>
                <?php } ?>

                <?php if ( $twitstrap_options['twitstrap_footer_3_toggle'] == 1 ) { ?>
                    <div class="col-md-4 col-sm-4 col-xs-8 twitstrap_footer_section_3">
                        <?php if ( ! dynamic_sidebar( 4 ) ) : ?>
                            <h2><?php echo $twitstrap_options['twitstrap_footer_3_title']; ?></h2>
                            <?php echo $twitstrap_options['twitstrap_footer_3_text']; ?>
                        <?php endif; ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </footer>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
