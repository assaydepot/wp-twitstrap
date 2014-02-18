<?php
/*
Template Name: Search Page
*/

get_header();

if ( $twitstrap_options['twitstrap_post_sidebar'] != 'none' ) {
    $excerpt_span = 'col-md-8 col-sm-7 col-xs-12';
} else {
    $excerpt_span = 'col-md-12';
}
?>
<div class="container">
<?php if ( have_posts() ) { ?>
    <div class="row">
        <div class="col-md-12">
            <h2>Search Results for "<?php echo get_search_query(); ?>"</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php get_search_form(); ?>
        </div>
    </div>

    <?php if ($twitstrap_options['twitstrap_post_sidebar'] == 'left') { ?>
    <div class="row">
    <div class="col-md-4 col-sm-5 col-xs-4">
        <?php get_sidebar(); ?>
    </div>
    <div class="<?php echo $excerpt_span; ?>">
    <?php } else { ?>
    <div class="row">
        <div class="<?php echo $excerpt_span ?>">
            <?php
            }

            while ( have_posts() ) : the_post(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <h2>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
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
                    <div class="col-md-12">
            <span class="pull-right">
              <h6>
                  <span itemprop="articleSection" class="badge"><?php the_category( '</span> <span itemprop="articleSection" class="badge">' ); ?></span>
              </h6>
            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
            <span class="pull-right">
              <h6>Posted <?php the_time(); ?>,
                  <span itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></span></h6>
            </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php the_tags( '<h6>Tags:</h6> <span itemprop="keywords"><small>', ', ', '</small></span>' ); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr />
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php if ( $twitstrap_options['twitstrap_post_sidebar'] == 'right' ) { ?>
            <div class="col-md-4 col-sm-5 col-xs-12">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="<?php echo $excerpt_span; ?>">
            <?php
            $paged = get_query_var( 'paged' );
            $big = 999999999;
            $pagination = paginate_links( array( 'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                                 'format'  => '%#%',
                                                 'current' => max( 1, $paged ),
                                                 'total'   => $wp_query->max_num_pages,
                                                 'type'    => 'array'
            ) );
            if (! empty( $pagination )) {
            ?>
            <ul class="pagination">
                <?php
                foreach ( $pagination as $page_number ) {
                    $current_page = '<span class="page-numbers current">' . $paged . '</span>';
                    if ( strlen( $current_page ) == strlen( $page_number ) ) {
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
            <hr />
        </div>
    </div>

<?php } else { ?>
    <article id="post-0" class="post no-results not-found">
        <header class="entry-header">
            <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
        </header>
        <!-- .entry-header -->

        <div class="entry-content">
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
            <?php get_search_form(); ?>
        </div>
        <!-- .entry-content -->
    </article><!-- #post-0 -->

<?php } ?>
    </div>

<?php get_footer(); ?>