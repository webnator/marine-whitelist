<?php
get_header(); 

?>
		

	<div class='container-fluid page-container'>
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-xs-12">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="post-link">
					<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
					<div style="color:#333;">
						<?php the_excerpt(); ?>
						<a class="read-more" href="<?php the_permalink(); ?>">Ir > </a>
					</div>
				</div>

				<?php endwhile; else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</div>
		</div>

	</div>

		

<?php get_footer(); ?>
