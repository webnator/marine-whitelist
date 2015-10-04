<?php
	//Template Name: Pagina de equipo
	get_header();
?>



<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/team_styles.css" type="text/css">
		
<div class='container-fluid page-container' style="color:<?php the_field('color_fuente'); ?>">

	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
	
			<!-- Row for logo and small description -->
			<div class="row" style="background-color:<?php the_field('color_equipo'); ?>;">
				<div class="col-xs-4">
					<div class="row team-title">
						<?php the_field('nombre_equipo'); ?>
					</div>
					<div class="row team-logo">
						<img class="img-responsive img-circle" src="<?php the_field('logo_equipo'); ?>"/>
					</div>
					
				</div>

				<div class="col-xs-8">

					<div class="row team-desc-short">
						<?php the_field('descripcion_corta_equipo'); ?>
					</div>

					<div class="row team-quote">
						"<?php the_field('cita_equipo'); ?>"
					</div>

				</div>
			</div>

			<!-- Row for description -->
			<div class="row team-desc-long" style="background-color:<?php 
				if(get_field('color_equipo_alt')){ 
					the_field('color_equipo_alt'); 
				}else{ 
					the_field('color_equipo');
				} ?>;
				<?php 
					if(get_field('color_fuente_alt')){ 
						echo 'color:'.get_field('color_fuente_alt'); 
					}

				?>
				">


				<?php the_field('descripcion_equipo'); ?>

			</div>

			<!-- Row for team members -->
			<div class="row" style="background-color:<?php the_field('color_equipo'); ?>;">
				

				<?php 

				$team_slug = trim(get_field('slug_equipo'));

				$args = array(
					'post_type' => 'developer'
				);

				$the_query = new WP_Query($args);

				// The Loop
				if ( $the_query->have_posts() ) {
					
					while ( $the_query->have_posts() ) {
						$the_query->the_post();

						$teams = explode(',', get_field('team'));
						$teams = array_filter(array_map('trim', $teams));

						if(in_array($team_slug, $teams)){
				

				?>

					<div class="col-xs-4 team-profile">
						<div class="row profile-pic">
							<center>
								<img class="img-responsive img-circle" src="<?php
									if(get_field('profile_pic')){
										the_field('profile_pic');
									}else{
										echo get_stylesheet_directory_uri()."/img/default-avatar.gif"; 
									}

								?>"/>
							</center>
						</div>

						<div class="row profile-name">
							<a href="<?php the_permalink(); ?>">
								<?php the_field('name'); ?>
							</a>
						</div>

						<div class="row line-separator">
							<center><div></div></center>
						</div>

						<div class="row profile-about">	
							<?php the_field('about'); ?>
						</div>
					</div>
				<?php 
						}
					}

				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();

				?> 



				






			</div>
		</div>
	</div>

</div>

<?php get_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/functions_team.js"></script>





