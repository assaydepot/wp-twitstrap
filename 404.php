<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Error 404 - Page Not Found</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>It seems we can't find what you're looking for.<br />
                    Perhaps searching, or one of the links below, can help.</h3>
                <hr />
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?php get_search_form(); ?>
            </div>
            <div class="col-md-4">
                <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
            </div>
            <div class="col-md-4">
                <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr />
            </div>
        </div>

    </div>

<?php get_footer(); ?>