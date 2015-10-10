<?php



//Add navigation menu support for the site
function registerHeaderMenu() {
  register_nav_menu('header-menu',__( 'Menu Cabecera' ));
  register_nav_menu('header-btn-menu',__( 'Menu Botones Cabecera' ));
  register_nav_menu('footer-menu',__( 'Menu pie de pagina' ));
  register_nav_menu('header-bar-menu',__( 'Menu barra cabecera azul' ));
}
//add_action( 'init', 'registerHeaderMenu' );


//Add post type Developers

function createPostType() {
  register_post_type( 'developer',
    array(
      'labels' => array(
        'name' => __( 'Developers' ),
        'singular_name' => __( 'Developer' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'developer'),
    )
  );
}
//add_action( 'init', 'createPostType' );


// Make the metabox appear on the page editing screen
function tags_for_pages() {
	register_taxonomy_for_object_type('post_tag', 'page');
}
//add_action('init', 'tags_for_pages');

// When displaying a tag archive, also show pages
function tags_archives($wp_query) {
	if ( $wp_query->get('tag') )
		$wp_query->set('post_type', 'any');
}
//add_action('pre_get_posts', 'tags_archives');

/**
 * Enqueue page scripts and styles
 */
function loadScripts() {
	//CSS styles
	wp_enqueue_style( 'style.css', get_stylesheet_uri() );
	
	//Scripts
	wp_enqueue_script('jquery-2.1.0.min.js', get_template_directory_uri() . '/lib/jquery-2.1.0.min.js', array(), '2.1.0', true);
	wp_enqueue_script('jquery.appear.js', get_template_directory_uri() . '/lib/jquery.appear.js', array(), '1.0.0', true);
	wp_enqueue_script('bootstrap.min.js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array(), '3.3.5', true);
	wp_enqueue_script('functions.js', get_template_directory_uri() . '/lib/functions.js', array(), '1.0.0', true);
	
	/*wp_register_style( 'fontawesome', 'http:////maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'fontawesome');*/

	wp_enqueue_style('general_style', get_template_directory_uri() . '/style.less');
}
add_action( 'wp_enqueue_scripts', 'loadScripts' );


/**
* Adding the Customization sections
*/

function registerCustomize($wp_customize) {


	//Logo section
	$wp_customize->add_section( 'bbva_logo_section' , array(
		'title' => __( 'Logo', 'BBVA' ),
		'priority' => 30,
		'description' => 'Subir un logo para reemplazar el logo por defecto',
	));

	$wp_customize->add_setting( 'bbva_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bbva_logo', array(
		'label' => __( 'Logo', 'BBVA' ),
		'section' => 'bbva_logo_section',
		'settings' => 'bbva_logo',
	)));

	//Title section
	$wp_customize->add_section( 'bbva_title_section' , array(
		'title' => __( 'Titulo', 'BBVA' ),
		'priority' => 30,
		'description' => 'Cambiar el titulo de la página',
	));

	$wp_customize->add_setting( 'bbva_page_title' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bbva_page_title', array(
		'label' => __( 'Titulo de pagina', 'BBVA' ),
		'section' => 'bbva_title_section',
		'settings' => 'bbva_page_title',
	)));

	$wp_customize->add_setting( 'bbva_title' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bbva_title', array(
		'label' => __( 'Titulo de cabecera', 'BBVA' ),
		'section' => 'bbva_title_section',
		'settings' => 'bbva_title',
	)));


	//Search section
	$wp_customize->add_section( 'bbva_search_section' , array(
		'title' => __( 'Buscador', 'BBVA' ),
		'priority' => 30,
		'description' => 'Habilita/Deshabilita el buscador',
	));

	$wp_customize->add_setting( 'bbva_search' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bbva_search', array(
		'label' => __( 'Buscador', 'BBVA' ),
		'section' => 'bbva_search_section',
		'settings' => 'bbva_search',
		'type' 	=> 'checkbox'
	)));


	//Footer section
	$wp_customize->add_section( 'bbva_footer_section' , array(
		'title' => __( 'Pie de página', 'BBVA' ),
		'priority' => 30,
		'description' => 'Cambiar el pie de página',
	));

	$wp_customize->add_setting( 'bbva_footer' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bbva_footer', array(
		'label' => __( 'Pie de página', 'BBVA' ),
		'section' => 'bbva_footer_section',
		'settings' => 'bbva_footer',
	)));


	//Sections removal
	$wp_customize->remove_section('colors');


}
//add_action('customize_register', 'registerCustomize');


/* Adding the widget area */
function registerWidgets(){
	register_sidebar(array(
		'name' 	=> 'Footer Menu 1',
		'id'	=> 'footer_menu_1'
	));
	register_sidebar(array(
		'name' 	=> 'Footer Menu 2',
		'id'	=> 'footer_menu_2'
	));
	register_sidebar(array(
		'name' 	=> 'Footer Menu 3',
		'id'	=> 'footer_menu_3'
	));
	register_sidebar(array(
		'name' 	=> 'Footer Menu 4',
		'id'	=> 'footer_menu_4'
	));
};
//add_action('widgets_init', 'registerWidgets');
























