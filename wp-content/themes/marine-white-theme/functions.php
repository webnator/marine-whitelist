<?php



//Add navigation menu support for the site
function registerMenus() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('header-mobile-menu',__( 'Header Mobile Menu' ));
  register_nav_menu('header-client-menu',__( 'Header Menu for logged clients' ));
  register_nav_menu('header-client-mobile-menu',__( 'Header Mobile Menu for logged clients' ));
  //register_nav_menu('header-btn-menu',__( 'Menu Botones Cabecera' ));
  //register_nav_menu('footer-menu',__( 'Menu pie de pagina' ));
  //register_nav_menu('header-bar-menu',__( 'Menu barra cabecera azul' ));
}
add_action( 'init', 'registerMenus' );


//Add post type Developers

function createPostType() {
  register_post_type( 'subscription_type',
    array(
      'labels' => array(
        'name' => __( 'Subscription Type' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'subscription_type'),
    )
  );
}
add_action( 'init', 'createPostType' );


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

//Function to create the new roles of the website
function create_roles(){

	$client = add_role('client', 'Client'); 
	$service_provider = add_role('service_provider', 'Service Provider'); 

}
add_action('init','create_roles');

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

	wp_enqueue_style('general_style', get_template_directory_uri() . '/style.less');
}
add_action( 'wp_enqueue_scripts', 'loadScripts' );


/**
* Adding the Customization sections
*/

function registerCustomize($wp_customize) {

	/*
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
	*/
	//Title section
	$wp_customize->add_section( 'title_section' , array(
		'title' => __( 'Title', '' ),
		'priority' => 30,
		'description' => 'Change the page title',
	));

	$wp_customize->add_setting( 'page_title' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_title', array(
		'label' => __( 'Titulo de pagina', '' ),
		'section' => 'title_section',
		'settings' => 'page_title',
	)));

	/*
	$wp_customize->add_setting( 'bbva_title' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'bbva_title', array(
		'label' => __( 'Titulo de cabecera', 'BBVA' ),
		'section' => 'bbva_title_section',
		'settings' => 'bbva_title',
	)));*/


	//Search section
	$wp_customize->add_section( 'search_section' , array(
		'title' => __( 'Search', '' ),
		'priority' => 30,
		'description' => 'Enables/Disables the search bar',
	));

	$wp_customize->add_setting( 'search_field' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'search_field', array(
		'label' => __( 'Search field', '' ),
		'section' => 'search_section',
		'settings' => 'search_field',
		'type' 	=> 'checkbox'
	)));


	//Footer section
	$wp_customize->add_section( 'footer_section' , array(
		'title' => __( 'Footer', '' ),
		'priority' => 30,
		'description' => 'Change the page footer',
	));

	$wp_customize->add_setting( 'footer' );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer', array(
		'label' => __( 'Footer', '' ),
		'section' => 'footer_section',
		'settings' => 'footer',
	)));


	//Sections removal
	$wp_customize->remove_section('colors');


}
add_action('customize_register', 'registerCustomize');


/* Adding the widget area */
function registerWidgets(){
	register_sidebar(array(
		'name' 	=> 'Footer Company',
		'id'	=> 'footer_menu_1'
	));
	register_sidebar(array(
		'name' 	=> 'Footer Links',
		'id'	=> 'footer_menu_2'
	));
	register_sidebar(array(
		'name' 	=> 'Footer Social',
		'id'	=> 'footer_menu_3'
	));
};
add_action('widgets_init', 'registerWidgets');

//Hide toolbar for all users but admin
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}
add_action('after_setup_theme', 'remove_admin_bar');


/* Display META fields for users */
function mysite_custom_define($role) {
  $custom_meta_fields = array();
  $pages = [];
  switch ($role) {
  	case 'service_provider':
  		$pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'register-provider-form.php'
      ));
  		break;
  	case 'client':
  		$pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'register-client-form.php'
      ));
  		break;
  }

  if(count($pages) > 0){
  	$fields = get_field_objects($pages[0]->ID);
    foreach($fields as $field_name => $field){
    	if($field['name'] != 'user_login' && $field['name'] != 'user_pass' && $field['name'] != 'user_email' && $field['name'] != 'nickname'){
      	$custom_meta_fields[$field['name']] = $field['label'];
      }
    }
  }


 
  return $custom_meta_fields;
}

function mysite_show_extra_profile_fields($user) {
	$custom_meta_fields = mysite_custom_define($user->roles[0]);

	if(count($custom_meta_fields) > 0){
	  print('<h3>Extra profile information</h3>');

	  print('<table class="form-table">');

	  $meta_number = 0;
	  foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
	    $meta_number++;
	    print('<tr>');
	    print('<th><label for="' . $meta_field_name . '">' . $meta_disp_name . '</label></th>');
	    print('<td>');
	    print('<input type="text" name="' . $meta_field_name . '" id="' . $meta_field_name . '" value="' . esc_attr( get_the_author_meta($meta_field_name, $user->ID ) ) . '" class="regular-text" /><br />');
	    print('<span class="description"></span>');
	    print('</td>');
	    print('</tr>');
	  }
	  print('</table>');
	}
	
}

function mysite_save_extra_profile_fields($user_id) {

  if (!current_user_can('edit_user', $user_id)){
    return false;
  }

  $custom_meta_fields = mysite_custom_define($user->roles[0]);

  if(count($custom_meta_fields) > 0){

	  $user = get_user_by('id', $user_id );

	  $meta_number = 0;
	  
	  foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
	    $meta_number++;
	    update_usermeta( $user_id, $meta_field_name, $_POST[$meta_field_name] );
	  }
	}
}

add_action('show_user_profile', 'mysite_show_extra_profile_fields');
add_action('edit_user_profile', 'mysite_show_extra_profile_fields');
add_action('personal_options_update', 'mysite_save_extra_profile_fields');
add_action('edit_user_profile_update', 'mysite_save_extra_profile_fields');



/* Social Login customization */
//Use the email address for user_login
function oa_social_login_set_email_as_user_login ($user_fields)
{
  if ( ! empty ($user_fields['user_email']))
  {
    if ( ! username_exists ($user_fields['user_email']))
    {
      $user_fields['user_login'] = $user_fields['user_email'];
    }
  }
 
  return $user_fields;
}
 
// This filter is applied to new users
add_filter('oa_social_login_filter_new_user_fields', 'oa_social_login_set_email_as_user_login');

//Set custom roles for new users
function oa_social_login_set_new_user_role ($user_role)
{
  //This is an example for a custom setting with one role
  $user_role = 'client';
 
  //The new user will be created with this role
  return $user_role;
}
 
//This filter is applied to the roles of new users
add_filter('oa_social_login_filter_new_user_role', 'oa_social_login_set_new_user_role');

//Use a custom CSS file with Social Login
function oa_social_login_set_custom_css($css_theme_uri)
{
  //Replace the URL by an URL to your own CSS file
  //$css_theme_uri = get_template_directory_uri() .'/css/social_plugin.css';
   
  //Done
  return $css_theme_uri;
}
  
add_filter('oa_social_login_default_css', 'oa_social_login_set_custom_css');
add_filter('oa_social_login_widget_css', 'oa_social_login_set_custom_css');
add_filter('oa_social_login_link_css', 'oa_social_login_set_custom_css');













