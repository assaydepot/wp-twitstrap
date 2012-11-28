<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<nav id="nav-single">
  <h3><?php _e( 'Post navigation', 'twitstrap' ); ?></h3>
  <span class="nav-previous">
    <?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twitstrap' ) ); ?>
  </span>
  <span class="nav-next">
    <?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twitstrap' ) ); ?>
  </span>
</nav>

<?php get_template_part( 'content', 'single' ); ?>

<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>