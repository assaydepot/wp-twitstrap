<?php
get_header();

if ($twitstrap_options['twitstrap_hero_unit_toggle'] == 1) {
?>
<div class="container">
  <div class="hero-unit">
    <h1><?php echo $twitstrap_options['twitstrap_hero_unit_h1']; ?></h1>
    <p><?php echo $twitstrap_options['twitstrap_hero_unit_p']; ?></p>
    <p>
      <a class="btn btn-primary btn-large" href="<?php echo $twitstrap_options['twitstrap_hero_unit_button_link']; ?>">
        <?php echo $twitstrap_options['twitstrap_hero_unit_button_text']; ?>
      </a>
    </p>
  </div>
</div>
<?php } ?>

<?php
if ($twitstrap_options['twitstrap_static'] != 1) {
    if ($twitstrap_options['twitstrap_main_sidebar'] != 'none') {
        $excerpt_span = 'span8';
    } else {
        $excerpt_span = 'span12';
    }
?>
<div class="container">
  <?php if ( have_posts() ) { ?>

    <?php if ($twitstrap_options['twitstrap_main_sidebar'] == 'left') { ?>
    <div class="row">
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
      <div class="span8">
    <?php } else { ?>
    <div class="row">
      <div class="<?php echo $excerpt_span ?>">
    <?php }

    $i = 0;
    while ( have_posts() ) : the_post(); ?>
        <div itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
          <div class="row">
            <div class="<?php echo $excerpt_span ?>">
              <h2>
                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                  <span itemprop="headline"><?php the_title(); ?></span>
                </a>
              </h2>
            </div>
          </div>
          <div class="row">
            <div class="<?php echo $excerpt_span ?>">
              <?php
              if ($i == 0 && get_query_var('paged') <= 1) {
                  echo '<span itemprop="articleBody">';
                  the_content();
                  echo '</span>';
              } else {
                  echo '<span itemprop="description">';
                  the_excerpt();
                  echo '</span>';
              ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="pull-right">
                Read More...
              </a>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="row">
            <div class="<?php echo $excerpt_span; ?>">
              <?php the_tags('<h6>Tags:</h6> <span itemprop="keywords"><span class="badge badge-info">', '</span> <span class="badge badge-info">', '</span></span>'); ?>
              <span class="pull-right">
              <h6><span itemprop="articleSection"><?php the_category('</span>, <span itemprop="articleSection">'); ?></span></h6>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="<?php echo $excerpt_span; ?>">
              <h6>Posted <?php the_time(); ?>, <span itemprop="datePublished"><?php the_time(get_option('date_format')); ?></span></h6>
            </div>
          </div>
          <div class="row">
            <div class="<?php echo $excerpt_span; ?>">
              <hr />
            </div>
          </div>
        </div>
    <?php $i++; ?>
    <?php endwhile; ?>
      </div>

    <?php if ($twitstrap_options['twitstrap_main_sidebar'] == 'right') { ?>
      <div class="span4">
        <?php get_sidebar(); ?>
      </div>
    <?php } ?>
    </div>
    <div class="row">
      <div class="<?php echo $excerpt_span; ?>">
        <?php
        $paged = get_query_var('paged');
        $big = 999999999;
        $pagination = paginate_links(array('base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                           'format' => '%#%',
                                           'current' => max(1, $paged),
                                           'total' => $wp_query->max_num_pages,
                                           'type' => 'array'
                                           ));
        if (!empty($pagination)) {
        ?>
        <div class="pagination pagination-centered">
        <ul>
        <?php
            foreach ($pagination as $page_number) {
                $current_page = '<span class="page-numbers current">'.$paged.'</span>';
                if (strlen($current_page) == strlen($page_number)) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $page_number;
                echo '</li>';
            }
        }
        ?>
        </ul>
        </div>
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

<?php
/*echo "<pre>";
print_r($twitstrap_options);
echo "</pre>";*/
?>
