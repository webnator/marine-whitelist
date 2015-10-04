<?php
	//Template Name: Home de equipos
	get_header();
?>



<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/home_team_styles.css" type="text/css">
		
<div class='container-fluid page-container'>

	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
	
			<div class="row">

				<?php 


				$filter = array_filter(array_map('trim', explode(',',get_field('filtro_equipos'))));
				$op = 'NOT IN';

				if(get_field('invertir_filtro')){
					$op = 'IN';
				}

				$args = array(
					'post_type'		=> 'page',
					'tax_query' 	=> array(
							array(
								'taxonomy' 	=> 'post_tag',
								'field' 	=> 'slug',
								'terms'		=> $filter,
								'operator'	=> $op
							),
						),
					'meta_key' 		=> '_wp_page_template', 
					'meta_value' 	=> 'team-page.php'
				);

				$the_query = new WP_Query($args);

				if ( $the_query->have_posts() ) {
					
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
				?>

				<div class="col-md-3">
					<div class="row">
						<div class="col-xs-11 team-box">
							<div class="row">
								<div class="col-xs-12">
									<center>
										<img class="img-responsive" src="<?php the_field('logo_equipo'); ?>"/>
									</center>
								</div>
							</div>

							<div class="row team-title" style="color:<?php the_field('color_equipo'); ?>;">
								<div class="col-xs-12" >
									<?php the_field('nombre_equipo'); ?>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 line-separator">
									<center><div style="background-color:<?php the_field('color_equipo'); ?>;"></div></center>
								</div>
							</div>

							<div class="row team-info">
								<div class="col-xs-12">
									<?php the_field('descripcion_corta_equipo'); ?>
								</div>
							</div>

							<div class="row team-link">
								<a href="<?php the_permalink(); ?>">
									<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<?php

					}
				}else{ ?>
					<p>No hay equipos registrados.</p>
				<?php } 

				wp_reset_postdata();

				?>



			</div>
		</div>
	</div>

</div>

<?php get_footer(); ?>






