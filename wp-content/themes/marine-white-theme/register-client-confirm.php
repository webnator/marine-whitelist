<?php

  //Template Name: Register client Confirmation
  get_header();

  //If the user is logged in redirects him to the home page
  if (!is_user_logged_in()){
    header("Location: ".site_url());
    die();
  }

?>



<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <br/><br/>
    <span class="big-title ">
      <?php the_title(); ?></span>
    <hr>
  </div>
</div>

<div class="row">
  <div class="col-md-5 col-md-offset-1">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php the_content(); ?>

    <?php endwhile; else : ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
  </div>
</div>



<?php get_footer(); ?>


















