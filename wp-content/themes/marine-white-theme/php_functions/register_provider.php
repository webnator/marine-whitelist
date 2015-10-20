<?php

  require_once(dirname(__FILE__).'/../../../../wp-load.php');

  $response = array(
    'status'=>'FAIL',
    'url'=>home_url()
  );


  if(is_user_logged_in()){
    $response['status'] = 'LOGGED';
    echo json_encode($response);
    die();
  }

  $user = get_userdatabylogin($_POST['user_email']);
  if($user){
    $response['status'] = 'EXISTS';
    echo json_encode($response);
    die();
  }

  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'register-provider-form.php'
  ));

  $fields = get_field_objects($pages[0]->ID);
  foreach($fields as $field_name => $field){
    if($field['name'] != 'user_login' && $field['name'] != 'user_pass' && $field['name'] != 'user_email' && $field['name'] != 'nickname'){
      $custom_meta_fields[$field['name']] = $field['label'];
    }
  }

  $user_values = array(
    'user_login'    => $_POST['user_email'],
    'user_pass'     => wp_hash_password($_POST['user_pass']),
    'user_email'    => $_POST['user_email'],
    'user_registered' => date('Y-m-d H:i:s'),
    'role'        => 'service_provider'
  );
  
  if($_POST['nickname']){
    $user_values['nickname'] = $_POST['nickname'];
  }
  
  $new_provider = wp_insert_user($user_values);

  $fields = get_field_objects($pages[0]->ID);
  foreach($fields as $field_name => $field){
    if($field['name'] != 'user_login' && $field['name'] != 'user_pass' && $field['name'] != 'user_email' && $field['name'] != 'nickname'){
      update_user_meta($new_provider, $field['name'], $_POST[$field['name']]);
    }
  }

  global $wpdb;
  $args = array(
    'user' => $new_provider,
    'registration_date' => date('Y-m-d H:i:s')
  );

  $subscription_type_id = get_user_meta($new_provider, 'hidden_subscription_type');
  $subs = get_posts(array(
      'post_type' => 'subscription_type',
      'meta_key'    => 'id',
      'meta_value'  => $subscription_type_id[0]
    )
  );
  $price = get_field('price', $subs[0]->ID);

  if(is_numeric($price)){
    $args['pay_amount'] = $price;
  }

  $insert = $wpdb->insert('active_user', $args);

  wp_setcookie($_POST['user_email'], wp_hash_password($_POST['user_pass']), true);
  wp_set_current_user($new_provider, $_POST['user_email']);  
  do_action('wp_login', $_POST['user_email']);



  $provider_confirmation = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'register-provider-confirm.php'
  ));

  $response['status'] = 'OK';
  $response['url'] = $provider_confirmation[0]->guid;

  echo json_encode($response);

?>