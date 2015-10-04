<hr>

<?php

	$widget_space = 0;
	$widget_total = 0;

	if (is_active_sidebar('footer_menu_1')){
		$widget_space = 12;
		$widget_total++;
		if (is_active_sidebar('footer_menu_2')){
			$widget_space = 6;
			$widget_total++;
			if (is_active_sidebar('footer_menu_3')){
				$widget_space = 4;
				$widget_total++;
				if (is_active_sidebar('footer_menu_4')){
					$widget_space = 3;
					$widget_total++;
				}
			}
		}

	}

	//echo "Total: ".$widget_total." with ".$widget_space." spaces";

?>

<div class="container footer-bbva">
	<div class="row">
		<div class='col-md-10 col-md-offset-1 col-sm-12'>
			<div class="row widget-footer">

				<?php

					for($i=1; $i<=$widget_total; $i++){
						echo '<div class="col col-xs-'.$widget_space.'">';
							dynamic_sidebar('footer_menu_'.$i);
						echo '</div>';
					}

				?>
			</div>
			
		</div>
	</div>

	

	<?php

		$menu_name = 'footer-menu';
		if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])){

			$menu = wp_get_nav_menu_object($locations[$menu_name]);
			$menu_items = wp_get_nav_menu_items($menu->term_id);
		}
		if($menu_items != false && count($menu_items)>0){ 
			
	?>


			
				<div class="row row-footer" style="margin-right:-30px;">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-md-7 col-md-offset-1 col-sm-8">
								<div class="bloque-footer">
									<ul>

										<?php
											foreach ($menu_items as $key => $menu_item ) {
												$title = $menu_item->title;
												$url = $menu_item->url;
												echo '<li><a class="enlace" href="'.$menu_item->url.'">';
												if($menu_item->attr_title != null && $menu_item->attr_title != ""){
													echo '<span class="glyphicon glyphicon-'.$menu_item->attr_title.'" aria-hidden="true"></span>';
												}
												echo ' '.$title.'</a></li>';
											}
										?>
									</ul>
								</div>
							</div>
							<div class="col-md-3 col-sm-4 disclaim">
								<?php if ( get_theme_mod( 'bbva_footer' ) ) : ?>
									<?php echo get_theme_mod('bbva_footer'); ?>
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

<?php wp_footer(); ?>