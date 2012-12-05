<?php get_header(); ?>

<?php
if ($twitstrap_options['twitstrap_static'] != 1) {
    if ($twitstrap_options['twitstrap_page_sidebar'] != 'none') {
        $excerpt_span = 'span8';
    } else {
        $excerpt_span = 'span12';
    }
?>
<div class="container">
  <?php if ( have_posts() ) { ?>
  <div class="row">
    <div class="span12">
      <h2>Tag: <?php single_tag_title(); ?></h2>
    </div>
  </div>

    <?php if ($twitstrap_options['twitstrap_page_sidebar'] == 'left') { ?>
    <div class="row">
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
      <div class="span8">
    <?php } else { ?>
    <div class="row">
      <div class="<?php echo $excerpt_span ?>">
    <?php }

    while ( have_posts() ) : the_post(); ?>
        <div class="row">
          <div class="<?php echo $excerpt_span ?>">
            <h2>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_title(); ?>
              </a>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="<?php echo $excerpt_span; ?>">
            <p>
              <?php the_excerpt(); ?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="<?php echo $excerpt_span; ?>">
            <?php the_tags('<h6>Tags:</h6> <span class="badge badge-info">', '</span> <span class="badge badge-info">', '</span>'); ?>
            <span class="pull-right">
            <h6><?php the_category(', '); ?></h6>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="<?php echo $excerpt_span; ?>">
            <h6>Posted <?php the_time(); ?>, <?php the_time(get_option('date_format')); ?></h6>
          </div>
        </div>
        <div class="row">
          <div class="<?php echo $excerpt_span; ?>">
            <hr>
          </div>
        </div>
    <?php endwhile; ?>
      </div>

    <?php if ($twitstrap_options['twitstrap_page_sidebar'] == 'right') { ?>
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
    <?php } ?>
    </div>
    <div class="row">
      <div class="span12">
        <?php
        $big = 999999999;
        echo paginate_links(array('base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                  'format' => '?paged=%#%',
                                  'current' => max( 1, get_query_var('paged') ),
                                  'total' => $wp_query->max_num_pages
                                  ));
        ?>
        <hr />
      </div>
    </div>

  <?php } else { ?>
  <article id="post-0" class="post no-results not-found">
    <header class="entry-header">
      <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
      <?php get_search_form(); ?>
    </div><!-- .entry-content -->
  </article><!-- #post-0 -->

  <?php } ?>
</div>
<?php } ?>

<?php get_footer(); ?>