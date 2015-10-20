<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

<?php if ( get_theme_mod('page_title') ) : ?>
  <title><?php echo get_theme_mod('page_title'); ?></title>
<?php else : ?>
  <title>Marine Whitelist</title>
<?php endif; ?> 

<?php wp_head(); ?>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">

    		<div class="col-xs-12 visible-xs visible-sm">
    			<div class="row">
    				<div class="col-xs-2">

              <?php 


              $menu_name = 'header-mobile-menu';
              if ( is_user_logged_in() ) {
                $menu_name = 'header-client-mobile-menu';
              }
              if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){

                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                $menu_items = wp_get_nav_menu_items($menu->term_id);
              }
              if($menu_items != false && count($menu_items)>0){ 
                
              ?>

    					<button type="button" 
    						class="btn btn-default btn-header header-toggler" 
    						data-toggler-target="menuBox"
    						aria-label="Left Align">
							  <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
							</button>
              <?php } ?>
    				</div>
    				<div class="col-xs-8" style="text-align:center;">

    					<img 
			      		class="navbar-logo"
			      		src="<?php echo get_stylesheet_directory_uri(); ?>/img/MWL-Logo.png"/>

    				</div>
    				<div class="col-xs-2">

              <?php if ( get_theme_mod('search_field') ) : ?>
      					<button type="button" 
      						class="btn btn-default btn-header header-toggler"
      						data-toggler-target="searchBox"
      						aria-label="Left Align">
  							  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
  							</button>
              <?php endif; ?>
    				</div>
    			</div>
    		</div>


    		<div id="searchBox" class="mobile-box">
    			<form class="" role="search" style="margin-bottom:0px;">
		        <div class="col-xs-8">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">
		        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		      </form>

		      <span class="close-box-btn">x</span>
    		</div>


    		<div id="menuBox" class="mobile-box">
    			<ul class="ul-menu-box">

            <?php

              /*$menu_name = 'header-mobile-menu';
              if ( is_user_logged_in() ) {
                $menu_name = 'header-client-mobile-menu';
              }
              if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){

                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                $menu_items = wp_get_nav_menu_items($menu->term_id);
              }*/
              if($menu_items != false && count($menu_items)>0){ 
                for($i=0; $i<count($menu_items); $i++) {
                  $menu_item = $menu_items[$i];
                  echo '<li ';;
                  //var_dump($menu_item);
                  if($menu_item->post_excerpt == 'highlight'){
                    echo 'class="highlight"';
                  }
                  echo '><a href="'.$menu_item->url.'"></a>'.$menu_item->title.'</li>';
                }
              }
            ?>

    			</ul>


		      <span class="close-box-btn">x</span>
    		</div>

 				
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		      	<li class="">
		      		<a href="<?php echo site_url(); ?>" class="list-logo">
		      			<img 
				      		class="navbar-logo"
				      		src="<?php echo get_stylesheet_directory_uri(); ?>/img/MWL-Logo.png"/>
		      		</a>
		      	</li>

              <?php

                $menu_name = 'header-menu';
                if ( is_user_logged_in() ) {
                  $menu_name = 'header-client-menu';
                }
                if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){

                  $menu = wp_get_nav_menu_object($locations[$menu_name]);
                  $menu_items = wp_get_nav_menu_items($menu->term_id);
                }
                if($menu_items != false && count($menu_items)>0){ 

                  for($i=0; $i<count($menu_items); $i++) {
                    $menu_item = $menu_items[$i];


                    if(!$menu_item->menu_item_parent){

                      $menu_from_post = false;

                      //If the menu item comes from a post type
                      if($menu_item->description != ""){
                        $desc = $menu_item->description;
                        if (strpos($desc,'post_type') !== false && strpos($desc,':')) {
                          $desc = explode(':', $desc);
                          
                          if($desc[0] == "post_type"){

                            $menu_from_post = true;

                            $args = array('category__in' => array(get_cat_id($desc[1])), 'posts_per_page' => -1);
                            $sub_menu = get_posts($args);

                            $element = '<li class="dropdown">
                              <a href="'.$menu_item->url.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              '.$menu_item->title.'</a>';

                            
                            $element .= '<div class="dropdown-menu dropdown-categories">';

                            foreach ($sub_menu as $sm){
                              $img_url = '';
                              

                              $icon = get_field('category_icon',$sm->ID);
                              //var_dump($icon);
                              if($icon['url']){
                                $img_url = $icon['url'];
                              }

                              $element .= '<div class="col-md-4"><a href="'.$sm->url.'">';
                              $count = 12;
                              if($img_url != ''){
                                $count = 9;
                                $element .= '<div class="col-md-3" style="padding: 0px; padding-right: 10px;">';
                                $element .= '<img class="img-responsive" src="'.$img_url.'"/>';
                                $element .= '</div>';
                              }
                              $element .= '<div class="col-md-'.$count.'" style="padding: 0px; padding-top: 7px">';
                              $element .= $sm->post_title;
                              $element .= '</div>';

                              $element .= '</a></div>';
                            }
                            $element .= '</div>';
                            echo $element;

                          }


                        }
                      }

                      //If the menu item doesn't come from a post type
                      if(!$menu_from_post){
                        $menu_children = [];
                        for($y=($i+1); $y<count($menu_items); $y++){
                          if($menu_items[$y]->menu_item_parent){
                            array_push($menu_children, $menu_items[$y]);
                          }else{
                            break;
                          }
                        }
                        $element = "";

                        if(count($menu_children) <= 0){
                          $element .= '<li class=""><a href="'.$menu_item->url.'">';
                          $element .= $menu_item->title.'</a></li>';
                        }else{

                          $element .= '
                            <li class="dropdown">
                              <a href="'.$menu_item->url.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              '.$menu_item->title.'</a>';
                            

                          if(count($menu_children) < 7){
                            $element .= '<ul class="dropdown-menu">';
                            for($y=0; $y<count($menu_children); $y++){
                              $child = $menu_children[$y];
                              if($child->title == 'split-line'){
                                $element .= '<li role="separator" class="divider"></li>';
                              }else{
                                $element .= '<li><a href="'.$child->url.'">'.$child->title.'</a></li>';
                              }
                            }
                            $element .= '</ul>';
                          }else{
                            $element .= '<div class="dropdown-menu dropdown-categories">';

                            for($y=0; $y<count($menu_children); $y++){
                              $child = $menu_children[$y];
                              $img_url = '';
                              if($child->thumbnail_id){
                                $img_url = wp_get_attachment_image_src($child->thumbnail_id)[0];
                              }

                              $element .= '<div class="col-md-4"><a href="'.$child->url.'">';
                              $count = 12;
                              if($img_url != ''){
                                $count = 9;
                                $element .= '<div class="col-md-3" style="padding: 0px; padding-right: 10px;">';
                                $element .= '<img class="img-responsive" src="'.$img_url.'"/>';
                                $element .= '</div>';
                              }
                              $element .= '<div class="col-md-'.$count.'" style="padding: 0px; padding-top: 7px">';
                              $element .= $child->title;
                              $element .= '</div>';

                              $element .= '</a></div>';
                            }
                            $element .= '</div>';
                              
                          }
                          
                        }
                        echo $element;
                      }
                    }
                  }

                }
              ?>

		      </ul>

          <?php if ( get_theme_mod('search_field') ) : ?>
  		      <form class="navbar-form navbar-right" role="search">
  		        <div class="form-group">
  		          <input type="text" class="form-control" placeholder="Search">
  		        </div>
  		        <button type="submit" class="btn btn-default">
  		        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
  		      </form>
          <?php endif; ?>
		      
		    </div><!-- /.navbar-collapse -->
		  </div>
		</div>
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid" style="padding-left:0px;">













