<?php

  //Template Name: Register client
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
        'meta_value' => 'login-client.php'
      ));
      $log_in_url = $pages[0]->guid;

    ?>

    Already a member? 
      <a href="<?php echo $log_in_url; ?>" style="text-decoration:underline;">
        Log In
      </a>
  </div>
</div>

<div class="row">
  <div class="col-md-5 col-md-offset-1">
    <form class="form-horizontal" method="POST" id="clientForm" action="<?php echo get_stylesheet_directory_uri()?>/php_functions/register_client.php">
      <?php 
        //$fields = get_field_objects();
        
        $pages = get_pages(array(
          'meta_key' => '_wp_page_template',
          'meta_value' => 'register-client-form.php'
        ));

        $fields = get_field_objects($pages[0]->ID);

        if($fields){
          foreach( $fields as $field_name => $field ){
      ?>
      <div class="form-group">
        <label 
          for="<?php echo $field['name']; ?>" 
          class="col-md-4 control-label">
            <?php echo $field['label']; ?>
        </label>
        <div class="col-md-8">

          <?php 
          switch($field['type']){
            case 'text':
            case 'number':
            case 'email':
            case 'password':
              echo '<input type="'.$field['type'].'" class="form-control" id="'.$field['name'].'" placeholder="">';
            break;
          }

          ?>
          
        </div>
      </div>

      <?php 
          }
        } ?>
      
      

      <div class="form-group">
        <div class="col-md-12" style="text-align:center;">
          <button type="button" class="btn btn-primary btn-lg" onclick="sendClientForm();">
            Next &nbsp; <i class="fa fa-chevron-right"></i>
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

















