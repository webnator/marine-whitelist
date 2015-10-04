<?php
get_header(); 

?>
		

	<div class='container-fluid page-container'>
		<div class="row">
			<div class="col-md-10 col-md-offset-1 col-xs-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h2><?php the_title(); ?></h2>
				<hr>
				<div style="color:#333;">
					<?php the_content(); ?>

				</div>

				<a class="read-more" href="javascript:javascript:history.go(-1)">Atrás</a>

				<?php endwhile; else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
			</div>
		</div>

	</div>

		

<?php get_footer(); ?>
