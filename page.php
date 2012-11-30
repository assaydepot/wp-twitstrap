<?php get_header(); ?>

<div class="container">
  <div class="row">
    <header class="span12">
      <h2><?php the_title(); ?></h2>
    </header>
  </div>
  <div class="row">
    <div class="span12">
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>