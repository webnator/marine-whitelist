<?php

  //Template Name: Profile
  get_header();

  //If the user is logged in redirects him to the home page
  if (!is_user_logged_in() ) {
    $register = get_pages(array(
      'meta_key' => '_wp_page_template',
      'meta_value' => 'register-client.php'
    ));
    header("Location: ".$register[0]->guid);
    die();
  }

  $user = wp_get_current_user();

  switch(strtolower($user->roles[0])) {
    case 'client':
      header("Location: ".get_stylesheet_directory_uri()."/app/index.php/#/client-profile");
      die();
    break;
    case 'service_provider':
      header("Location: ".get_stylesheet_directory_uri()."/app/index.php/#/provider-profile");
      die();
    break;
    default:
      //header("Location: ".site_url());
      header("Location: ".get_stylesheet_directory_uri()."/app/index.php/#/admin-profile");//provider-profile.php");
      die();
    break;
  }
  //var_dump($user->roles[0]);



?>

















