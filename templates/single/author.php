<?php $author_id = get_post_field( 'post_author', get_the_ID() ); ?>
<?php $authordesc = get_the_author_meta( 'description' ); ?>
<?php if( zante_get_option( 'single_post_author' ) && !empty($authordesc) ): ?>
<div class="about-author-post clearfix">
  <div class="row">
    <div class="col-md-2 col-sm-2">
      <figure class="author-avatar">
          <a href="<?php echo esc_url( get_author_posts_url($author_id) ) ?>">
              <?php echo get_avatar( get_the_author_meta('ID'), 130); ?>
          </a>
      </figure>
    </div>
    <div class="col-md-10 col-sm-10">
      <div class="details">
          <a href="<?php echo esc_url( get_author_posts_url($author_id) ) ?>">
              <?php echo '<h4 class="author-name">'.get_the_author_meta('display_name').'</h4>'; ?>
          </a>
          <div class="zante-author-desc">
              <?php echo wpautop( get_the_author_meta('description') ); ?>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
