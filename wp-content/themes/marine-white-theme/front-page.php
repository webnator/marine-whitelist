<?php

	//Template Name: Pagina principal
	get_header();

?>



<div class='container-fluid page-container'>


	<!-- Carousel section -->
	<?php if(get_field('slider_gallery')){ ?>
	<div class="row" style="margin-right:-30px;">

		<div class="col-xs-12" style="padding:0px;">


			<div id="carousel-home-bbva" class="carousel slide" data-ride="carousel" data-interval="2000" data-wrap="true" data-keyboard="true">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-home-bbva" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-home-bbva" data-slide-to="1"></li>
					<li data-target="#carousel-home-bbva" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
				<?php
					foreach(get_field('slider_gallery') as $nextgen_gallery_id){
						$sld_id = ($nextgen_gallery_id['ngg_id']);
						
						global $nggdb;

						$gal_info = $nggdb->find_gallery($sld_id);
						$gallery = $nggdb->get_gallery($sld_id);
						$first = true;
						foreach ($gallery as $image) {
							//var_dump($image);
							?>

							<div class="item <?php if($first==true){ echo "active"; $first=false; } ?>">
								<img 

									src="<?php echo get_site_url().$gal_info->path."/".$image->filename; ?>" 
									alt="<?php echo $image->alttext; ?>"
									style="width:100%;">
								<div class="carousel-caption" >
									<?php

										echo $image->description;
									?>
								</div>
							</div>
							<?php
							//echo "<img class='img-responsive' style='width:100%;' src='../".$gal_info->path."/".$image->filename."'/>";
						}
					};
				?>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-home-bbva" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-home-bbva" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>

		</div>
	</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

			<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>
		</div>
	</div>

</div>


<?php get_footer(); ?>