<?php get_header(); ?>

<div class="container">
    <div class="hero-unit">
        <h1><?php echo get_bloginfo('name'); ?></h1>
        <p><?php echo get_bloginfo('description'); ?></p>
        <p>
            <a class="btn btn-primary btn-large">
                Learn more
            </a>
        </p>
    </div>
</div>

<?php
if ( have_posts() ) {
    /* Start the Loop */
    while ( have_posts() ) {
        the_post();
        get_template_part( 'content', get_post_format() );
    }

} else { ?>

<article id="post-0" class="post no-results not-found">
    <header class="entry-header">
        <h1 class="entry-title">Nothing Found</h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
        <?php get_search_form(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-0 -->

<?php } ?>

<?php /*get_sidebar();*/ ?>

<?php get_footer(); ?>