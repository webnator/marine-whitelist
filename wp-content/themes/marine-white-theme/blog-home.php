<?php

//Template Name: Pagina de home para blog
get_header(); 

?>
		

	<div class='container-fluid page-container'>
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-xs-12">
				<?php 
					$filter = array_filter(array_map('trim', explode(',',get_field('filtro'))));
					$op = 'NOT IN';

					if(get_field('invertir_filtro')){
						$op = 'IN';
					}

					$args = array(
						'post_type'		=> 'post',
						'tax_query' 	=> array(
								array(
									'taxonomy' 	=> 'post_tag',
									'field' 	=> 'slug',
									'terms'		=> $filter,
									'operator'	=> $op
								),
							)
					);

				$the_query = new WP_Query($args);

				if ( $the_query->have_posts() ) {
					
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
				?>

				<div class="post-link">
					<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
					<div style="color:#333;">
						<?php the_excerpt(); ?>
						<a class="read-more" href="<?php the_permalink(); ?>">Leer más...</a>
					</div>
				</div>
				<?php }; }else { ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php }; ?>
			</div>
		</div>

	</div>

		

<?php get_footer(); ?>
