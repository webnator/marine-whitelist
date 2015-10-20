<?php

  //Template Name: Login client
  get_header();

  //If the user is logged in redirects him to the home page
  if ( is_user_logged_in() ) {
    header("Location: ".site_url());
    die();
  }

?>

<div class="row row-header">
  <div class="col-md-10 col-md-offset-1">
    <span class="big-title ">
      <?php the_field('title'); ?>
    </span>
    <br>

    <?php 

      $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'register-client.php'
      ));
      $log_in_url = $pages[0]->guid;

    ?>

    Not a member? 
      <a href="<?php echo $log_in_url; ?>" style="text-decoration:underline;">
        Sign Up
      </a>
  </div>
</div>

<div class="row">
  <div class="col-md-5 col-md-offset-1">
    <form class="form-horizontal" method="POST" id="clientLoginForm" action="<?php echo get_stylesheet_directory_uri()?>/php_functions/login_client.php">
      
      <div class="form-group">
        <label 
          for="user_email" 
          class="col-md-4 control-label">
            Email
        </label>
        <div class="col-md-8">
          <input type="email" class="form-control" id="user_email" placeholder="">
        </div>
      </div>

      <div class="form-group">
        <label 
          for="user_pass" 
          class="col-md-4 control-label">
            Password
        </label>
        <div class="col-md-8">
          <input type="password" class="form-control" id="user_pass" placeholder="">
        </div>
      </div>
      
      

      <div class="form-group">
        <div class="col-md-12" style="text-align:center;">
          <button type="button" class="btn btn-primary btn-lg" onclick="sendClientLogin();">
            Log in &nbsp; <i class="fa fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-5">
    <center>
      <h3><?php the_field('social_media'); ?></h3>
      <?php do_action('oa_social_login'); ?>
    </center>
  </div>
</div>



<?php get_footer(); ?>


<script type="text/javascript">
  $(document).ready(function(){
    

  });
</script>

















