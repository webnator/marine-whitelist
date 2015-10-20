<?php

  //Template Name: Register Provider
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
  <div class="col-md-10 col-md-offset-1">
    <ol class="breadcrumb register">
      <li class="active"><?php the_field('step_1'); ?></li>
      <li><?php the_field('step_2'); ?></li>
    </ol>
  </div>
</div>



<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <form class="form-horizontal" method="POST" id="providerForm" action="<?php echo get_stylesheet_directory_uri()?>/php_functions/register_provider.php">
      <?php 
        //$fields = get_field_objects();


        $pages = get_pages(array(
          'meta_key' => '_wp_page_template',
          'meta_value' => 'register-provider-form.php'
        ));

        $fields = get_field_objects($pages[0]->ID);
        
        if($fields){

          foreach( $fields as $field_name => $field ){

            $pos = strpos($field['name'], '_');
            if($pos !== false && substr($field['name'], 0, $pos) == 'hidden'){
              echo '<input type="hidden" class="form-control" id="'.$field['name'].'" placeholder="" data-instructions="'.$field['instructions'].'" value="" autocomplete="off">';
              continue;
            }

      ?>
      <div class="form-group">
        <label 
          for="<?php echo $field['name']; ?>" 
          class="col-md-2 control-label">
            <?php echo $field['label']; ?>
        </label>
        <div class="col-md-4">

          <?php 
          switch($field['type']){
            case 'text':
            case 'number':
            case 'email':
            case 'password':
              echo '<input type="'.$field['type'].'" class="form-control" id="'.$field['name'].'" placeholder="" data-instructions="'.$field['instructions'].'">';
              break;
          }

          ?>
          
        </div>
      </div>

      <?php 
          }
        } ?>
      <div class="form-group">
        <div class="col-md-12">
          <span class="big-title"><?php the_field('plan_title'); ?></span>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <div class="service-types">

            <?php 

            // The Query
            $the_query = new WP_Query(array('post_type' => 'subscription_type'));

            // The Loop
            if ( $the_query->have_posts() ) {
              while ($the_query->have_posts()){
                $the_query->the_post();
                $subs_fields = get_field_objects();

              ?>


              <div class="col-md-4">
                <div class="service-container" data-subscription-type="<?php the_field('id'); ?>">
                  <div class="stars-container">
                    <div class="burst-8"></div>
                    <span class="start-text"><?php the_field('name'); ?></span>
                  </div>
                  <div class="circle-check">
                    <div class="circle-bg">
                      <i class="fa fa-check"></i>
                    </div>
                  </div>

                  <div class="service-text-container">
                    <center>
                      <h2><?php the_field('title'); ?></h2>
                      <h3><?php the_field('sub_title'); ?></h3>
                    </center>
                    <?php the_field('description'); ?>
                  </div>  
                </div>
              </div>

              <?php 
              }
            } 
            /* Restore original Post Data */
            wp_reset_postdata();


            ?>
            
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12" style="text-align:center;">
          <button type="button" class="btn btn-primary btn-lg" onclick="sendProviderForm();">
            Next &nbsp; <i class="fa fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </form>



  </div>
</div>



<?php get_footer(); ?>

















