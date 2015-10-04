<?php
	get_header();
?>
		
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/profile_styles.css" type="text/css">

<div class='container-fluid page-container'>

	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			<?php 

			if(have_posts()): 
				while(have_posts()): 
					the_post();  ?>
			<div class="row">
				<div class="col-md-6 profile-pic">
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
				<div class="col-md-6">
					<div class="row profile-name">
						<?php the_field('name'); ?>
					</div>

					<div class="row profile-teams">
						<ul>
						<?php
							$teams = array_filter(array_map('trim', explode(',',get_field('team'))));

							$args = array(
								'post_type' => 'page',
								'meta_key' 	=> 'slug_equipo',
								'meta_value'=> $teams
							);

							$the_query = new WP_Query($args);

							if( $the_query->have_posts() ): ?>
							<ul>
							<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<li 


									style="<?php

									if(get_field('color_equipo')){
										echo "border-color:".get_field('color_equipo').";";
									}

								
									?>"
								>
									<a href="<?php the_permalink(); ?>">
										<?php the_field('nombre_equipo'); ?>
									</a>
								</li>
							<?php endwhile; ?>
							</ul>
						<?php endif; ?>

						<?php wp_reset_query();	

						?>
						</ul>
					</div>
				</div>
			</div>

			<div class="row profile-about">

				<?php the_field('about'); ?> 
			</div>

			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div>
	</div>

</div>

<?php 


get_footer(); 

?>





