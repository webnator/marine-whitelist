<?php

  //Template Name: Home Screen
  get_header();

?>

<?php if(get_field('revolution_slider_id') != ''){ ?>
<div class="row">
  <div class="col-md-12">
    <?php putRevSlider(get_field('revolution_slider_id')); ?>
  </div>
</div>
<?php } ?>
<div class="row split-row">
  <div class="col-md-4">
    <i class="fa fa-check"></i> <?php the_field('header_text_1'); ?>
  </div>

  <div class="col-md-4">
    <i class="fa fa-check"></i> <?php the_field('header_text_2'); ?>
  </div>

  <div class="col-md-4">
    <i class="fa fa-check"></i> <?php the_field('header_text_3'); ?>
  </div>
</div>

<div class="row" style="margin-bottom: 30px">
  <div class="col-md-10 col-md-offset-1">

    <div class="row">
      <div class="col-md-12">
        <span class="big-title dark-contrast">Service Categories</span>
        <hr>
      </div>
    </div>

    <div class="row ">
      

      <?php
        $args = array('category__in' => array(get_cat_id('Service Categories')), 'posts_per_page' => -1);
        $sub_menu = get_posts($args);

        foreach ($sub_menu as $sm){
          $img_url = '';
          $icon = get_field('category_icon',$sm->ID);
          //var_dump($icon);
          if($icon['url']){
            $img_url = $icon['url'];
          }

      ?>
        <div class="col-md-3 col-xs-6 col-service">
          <div class="row">
            <div class="col-xs-4">
              <?php 
                if($img_url != ''){
              ?>
              <img 
                class="img-responsive"
                src="<?php echo $img_url; ?>"/>

              <?php
                }
              ?>
            </div>
            <div class="col-xs-8 cat-title">
              <?php echo $sm->post_title; ?>
            </div>
          </div>
        </div>

      <?php
        }
      ?>


      


    </div>

  </div>
</div>

<div class="row tile">
  <div class="col-md-10 col-md-offset-1">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php 

        $content = get_the_content(); 

        $split_html = "</div></div><div class='row tile'><div class='col-md-10 col-md-offset-1'>";

        $content = str_replace("--SectionEnd--", $split_html, $content);
        
        echo $content;
      ?>

      <?php endwhile; else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
  </div>
</div>


<?php if(get_field('show_reviews')){ ?>
<div class="row tile green-tile">
  <div class="col-md-10 col-md-offset-1">
    <span class="big-title">Our latest review</span>
    <hr>
    <div class="row">
      <div class="col-md-10 col-md-offset-1 review-box">
        <div class="row">
          <div class="col-md-8">
            Jacky is wonderful - her crew cleaned my 35' sunseeker last week, and it is probably the cleanest the boat has been since it was built. 
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">    
                <i>Maggie Fox</i> at <strong>Home</strong>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<?php get_footer(); ?>