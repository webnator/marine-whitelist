<?php

  require_once(dirname(__FILE__).'/../../../../wp-load.php');
  require_once(dirname(__FILE__).'/../../../../wp-includes/pluggable.php');

  $response = array(
    'status'=>'FAIL',
    'url'=>home_url()
  );

  if(is_user_logged_in()){
    $response['status'] = 'LOGGED';
    echo json_encode($response);
    die();
  }

  $user = get_user_by('email',$_POST['user_email']);
  if($user){
    
    if(wp_check_password($_POST['user_pass'], $user->data->user_pass)){

      wp_setcookie($_POST['user_email'], wp_hash_password($_POST['user_pass']), true);
      wp_set_current_user($user->ID, $_POST['user_email']);  
      do_action('wp_login', $_POST['user_email']);

      $response['status'] = 'OK';

      echo json_encode($response);
      die();

    }else{
      $response['status'] = 'NO_PWD';
      echo json_encode($response);
      die();
    }
  }else{
    $response['status'] = 'NO_USR';
    echo json_encode($response);
    die();
  }

?>