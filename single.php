<?php get_header(); ?>

<?php
if ($twitstrap_options['twitstrap_static'] != 1) {
    if ($twitstrap_options['twitstrap_post_sidebar'] != 'none') {
        $excerpt_span = 'span8';
    } else {
        $excerpt_span = 'span12';
    }
?>
<div class="container">
  <?php if ( have_posts() ) { ?>

    <?php if ($twitstrap_options['twitstrap_post_sidebar'] == 'left') { ?>
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
            <h6>
              Posted <?php the_time(); ?>, <?php the_date(); ?><br />
              Author: <?php the_author(); ?>
            </h6>
            <span class="pull-right">
              <?php the_category(', '); ?>
            </span>
            <hr style="margin: 8px 0 0;"/>
          </div>
        </div>
        <div class="row">
          <div class="<?php echo $excerpt_span; ?>">
            <p>
              <?php the_content(); ?>
            </p>
          </div>
        </div>
    <?php endwhile; ?>
      </div>

    <?php if ($twitstrap_options['twitstrap_post_sidebar'] == 'right') { ?>
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
    <?php } ?>
    </div>
    <div class="row">
      <div class="span12">
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