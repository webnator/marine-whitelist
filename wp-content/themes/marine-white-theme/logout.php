<?php
  //Template Name: Logout page
  get_header();

  wp_logout();
  header("Location: ".site_url());
  die();
?>