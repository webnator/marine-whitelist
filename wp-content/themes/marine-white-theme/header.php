<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />


<?php if ( get_theme_mod('bbva_page_title') ) : ?>
	<title><?php echo get_theme_mod('bbva_page_title'); ?></title>
<?php else : ?>
	<title>BBVA Wordpress</title>
<?php endif; ?> 



<?php wp_head(); ?>

<!-- <link rel="stylesheet" href="css/style.css" type="text/css"> -->

<div class="container-fluid" style="padding-left:0px;">
	<div class='container head-bbva' id="header_bbva">
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-sm-12">
				<div class="row">

					<!-- Logo and title -->
					<div class="col-xs-3">
						<?php if ( get_theme_mod( 'bbva_logo' ) ) : ?>
							<img class="img-responsive head-logo" alt="BBVA Logo" src="<?php echo esc_url( get_theme_mod( 'bbva_logo' ) ); ?>"/>
						<?php else : ?>
							<img class="img-responsive head-logo" alt="BBVA Logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logoBBVA.png"/>
						<?php endif; ?> 

						
					</div>

					<!-- Menu -->
					<div class="col-xs-9">
						<div class="row">
							<div class="col-xs-8">
								<?php 
									wp_nav_menu(array('theme_location' => 'header-menu','fallback_cb'=>'', 'menu_class' => 'head-menu')); 
								?>
							</div>
							<div class="col-xs-4">

								<?php

									$menu_name = 'header-btn-menu';
									if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){

										$menu = wp_get_nav_menu_object($locations[$menu_name]);

										if($menu){
											$menu_items = wp_get_nav_menu_items($menu->term_id);
										}

										//$menu_items = wp_get_nav_menu_items(array('menu'=>'Header Bar Menu'));
									}
									if($menu && $menu_items != false && count($menu_items)>0){ 
										
								?>

								<div class="row head-btn-container">

									<?php
										/*if(count($menu_items)>2){
											$menu_items = array_slice($menu_items, 0,2);
										}*/
										foreach ($menu_items as $key => $menu_item ) {
											$title = $menu_item->title;
											$url = $menu_item->url;
											$icon = $menu_item->attr_title;
											$class = $menu_item->classes;
											
											$hasClass = false;
											for($i=0; $i<count($class); $i++){
												switch ($class[$i]) {
													case 'blue':
													case 'azul':
														$class[$i] = 'btn-primary';
														$hasClass = true;
														break;

													case 'green':
													case 'verde':
														$class[$i] = 'btn-success';
														$hasClass = true;
														break;

													case 'yellow':
													case 'naranja':
														$class[$i] = 'btn-warning';
														$hasClass = true;
														break;

													case 'purple':
													case 'magenta':
														$class[$i] = 'btn-error';
														$hasClass = true;
														break;
												}
											}
											if(is_array($class)){
												$class = implode(" ", $class);
											}
											if($class == null || $class == "" || $hasClass == false){
												$class = 'btn-primary';
											};
									?>

											<a class="btn <?php echo $class; ?>" href="<?php echo $url; ?>" role="button">
											<!-- <button class="btn btn-primary" type="button" href="<?php echo $url; ?>"> -->
												<?php
													if($icon != null && $icon != ""){
														echo '<span class="glyphicon glyphicon-'.$icon.' icon-header-btn" aria-hidden="true"></span>';
													}
													echo $title; 
												?>
											</a>
									<?php } ?>
									
								</div>

								

								<?php
									}
								?>

								<div class="row head-title">
										<?php if ( get_theme_mod('bbva_title') ) : ?>
											<?php echo get_theme_mod('bbva_title'); ?>
										<?php else : ?>
											<?php the_title(); ?>
										<?php endif; ?> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php

			$menu_name = 'header-bar-menu';
			if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){

				$menu = wp_get_nav_menu_object($locations[$menu_name]);
				if($menu){
					$menu_items = wp_get_nav_menu_items($menu->term_id);
				}
				//$menu_items = wp_get_nav_menu_items(array('menu'=>'Header Bar Menu'));
			}
			if($menu && $menu_items != false && count($menu_items)>0){ 
				
		?>
		<div class="row" style="margin-right:-30px;">
			<div class="col-xs-12 head-bar">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 col-sm-12">
						<div class="bloque-nav">
							<ul>
								<li class="first inicio">
									<a class="enlace" href="<?php echo site_url(); ?>">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ico-home.png" alt="Ir a home">
									</a>
								</li>


								<?php
									foreach ($menu_items as $key => $menu_item ) {
										$title = $menu_item->title;
										$url = $menu_item->url;
										echo '<li><a class="enlace" href="'.$url.'">';
										if($menu_item->attr_title != null && $menu_item->attr_title != ""){
											echo '<span class="glyphicon glyphicon-'.$menu_item->attr_title.'" aria-hidden="true"></span>';
										}
										echo ' '.$title.'</a></li>';
									}
								?>

								<!-- Ejemplo de elementos
								<li class="">
									<a class="enlace" href="">
										<span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
										Nuevo enlace
									</a>
								</li>
								<li class="">
									<a class="enlace" href="">
										<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
										Otro enlace
									</a>
								</li> -->

							</ul>

							<?php if ( get_theme_mod('bbva_search') ) : ?>
								<div class="head-search">
									<form method="get" id="search_form_header" action="<?php bloginfo('home'); ?>/">
										<input 
											name="s" 
											id="s" 
											class="textbox" 
											type="text"
											value="<?php echo wp_specialchars($s, 1); ?>" 
										/>
										<span class="glyphicon glyphicon-search search-icon" aria-hidden="true" onclick="sendSearch($(this))"></span>
										<input type="submit" style="visibility: hidden; position: absolute;" />
									</form>
								</div>
							<?php endif; ?> 
						</div>
					</div>
				</div>
			</div>

		</div>

		<?php
			}
		?>
	</div>