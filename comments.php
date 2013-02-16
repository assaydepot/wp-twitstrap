<?php
$twitstrap_options = twitstrap_get_global_options();
if ($twitstrap_options['twitstrap_post_sidebar'] != 'none') {
    $excerpt_span = 'span8';
} else {
    $excerpt_span = 'span12';
}
?>

<div class="row" id="comments">
  <div class="<?php echo $excerpt_span; ?>">
  <?php if ( post_password_required() ) : ?>
    <p class="nopassword">
      <?php _e( 'This post is password protected. Please enter the password to view any comments.', 'twitstrap' ); ?>
    </p>
  </div>
</div><!-- #comments -->
  <?php
      return;
  endif;
  ?>

<?php if (have_comments()) : ?>
  <h4 id="comments-title">
    Comments on <?php the_title(); ?>:
  </h4>

  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
  <ul class="pager">
    <li class="previous">
      <?php previous_comments_link(__('&larr; Older Comments', 'twitstrap')); ?>
    </li>
    <li class="next">
      <?php next_comments_link(__('Newer Comments &rarr;', 'twitstrap')); ?>
    </li>
  </ul>
  <?php endif;?>

  <ul class="media-list">
    <?php wp_list_comments(array('callback' => 'twitstrap_comment')); ?>
  </ul>

  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
  <ul class="pager">
    <li class="previous">
      <?php previous_comments_link(__('<i class="icon-arrow-left"></i> Older Comments', 'twitstrap')); ?>
    </li>
    <li class="next">
      <?php next_comments_link(__('Newer Comments <i class="icon-arrow-right"></i>', 'twitstrap')); ?>
    </li>
  </ul>
  <?php endif;?>

<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
  <div class="alert alert-info">
    <i class="icon-comment"></i> Comments are currently closed. Do you have something to say?<br />
    <a href="mailto:info@assaydepot.com?subject=Comment on '<?php the_title(); ?>'">Email us</a>
    or connect with us on Twitter <a href="http://www.twitter.com/assaydepot">@assaydepot</a>.
  </div>
<?php endif; ?>

<?php
$comment_args = array('id_form' => 'commentform',
                      'id_submit' => 'submit',
                      'title_reply' => 'Leave a Reply',
                      'title_reply_to' => 'Leave a Reply to %s<br />',
                      'cancel_reply_link' => '<span class="btn btn-primary btn-small">Cancel</span>',
                      'label_submit' => 'Post Comment',
                      'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" class="input-xxlarge" name="comment" rows="8" aria-required="true"></textarea></p>',
                      'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
                      'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
                      'comment_notes_after' => '',
                      'fields' => apply_filters('comment_form_default_fields',
                                                array('author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'domainreference' ) . '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />' . ( $req ? '<i class="icon-asterisk"></i>' : '' ) . '</p>',
                                                      'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />' . ( $req ? '<i class="icon-asterisk"></i>' : '' ) . '</p>',
                                                      'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>')
                                                )
                      );

comment_form($comment_args);

?>
  </div>
</div><!-- #comments -->
