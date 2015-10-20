<?php
  
  require_once(dirname(__FILE__).'/../../../../wp-load.php');

  get_header();

  //If the user is not logged in redirects him to the home page
  if (!is_user_logged_in() ) {
    $register = get_pages(array(
      'meta_key' => '_wp_page_template',
      'meta_value' => 'register-client.php'
    ));
    header("Location: ".$register[0]->guid);
    die();
  }



?>
  <script type="text/javascript">
    var global_url = '<?php echo get_stylesheet_directory_uri(); ?>';
  </script>

  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/app/styles/style.css">

  <div ng-app="marineWhiteList" ng-view=""></div>

  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/lib/moment.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/lib/angular.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/lib/angular-route.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/lib/angular-resource.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/lib/ui-bootstrap-tpls-0.14.2.min.js"></script>


  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/app.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/controllers/providerprofilecontroller.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/controllers/adminprofilecontroller.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri() ?>/app/scripts/services/wordpressapi.js"></script>


<?php get_footer(); ?>
