<?php get_header(); ?>

<?php
if ($twitstrap_options['twitstrap_post_sidebar'] != 'none') {
    $excerpt_span = 'span8';
} else {
    $excerpt_span = 'span12';
}

// Get the author to be viewed.
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<!--<pre>
  <?php print_r($curauth); ?>
</pre>-->
<div class="container">
  <?php if ($twitstrap_options['twitstrap_post_sidebar'] == 'left') { ?>
  <div class="row">
    <div class="span4">
      <?php get_sidebar(); ?>
    </div>
    <div class="span8">
  <?php } else { ?>
  <div class="row">
    <div class="<?php echo $excerpt_span; ?>"  itemprop="blogPost" itemscope itemtype="http://schema.org/Person">
  <?php } ?>
      <div class="row">
        <div class="<?php echo $excerpt_span; ?>">
          <h2>
            <a href="" title="<?php echo $curauth->display_name; ?>'s Profile" itemprop="url">
              Author Profile: <span itemprop="name"><?php echo $curauth->display_name; ?></span>
            </a>
          </h2>
          <h6>
            <a href="<?php echo $curauth->user_url; ?>" title="<?php echo $curauth->user_url; ?>">
              Visit <?php echo $curauth->display_name; ?>s Website
            </a><br />
            Email: <a href="mailto:<?php echo $curauth->user_email; ?>" itemprop="email"><?php echo $curauth->user_email; ?></a>
          </h6><br /><br />
          <?php echo $curauth->user_description; ?>
          <hr />
          <h3>Read Posts By <?php echo $curauth->display_name; ?></h3>
          <hr />
          <?php if ( have_posts() ) {
            while ( have_posts() ) : the_post(); ?>
              <div itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="row">
                  <div class="<?php echo $excerpt_span ?>">
                    <h3>
                      <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <span itemprop="headline"><?php the_title(); ?></span>
                      </a>
                    </h3>
                  </div>
                </div>
                <div class="row">
                  <div class="<?php echo $excerpt_span ?>">
                <?php
                    echo '<span itemprop="description">';
                    the_excerpt();
                    echo '</span>';
                ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="pull-right">
                      Read More...
                    </a>
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
            <?php endwhile; ?>
          <?php } ?>
        </div>
      </div>

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
            } ?>
          </ul>
        </div>
        <hr />
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>