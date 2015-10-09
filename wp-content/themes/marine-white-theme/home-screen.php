<?php

  //Template Name: Home Screen
  get_header();

?>

<div class="row">
  <div class="col-md-12">
    <?php putRevSlider("home-slider"); ?>
  </div>
</div>
<div class="row split-row">
  <div class="col-md-3 col-md-offset-2">
    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Always free
  </div>

  <div class="col-md-2">
    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> We'll research for you
  </div>

  <div class="col-md-3">
    <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Book online
  </div>
</div>


<?php get_footer(); ?>