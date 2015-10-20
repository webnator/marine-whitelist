<?php

  require_once(dirname(__FILE__).'/../../../../wp-load.php');

  //Global DB variable
  global $wpdb;
  
  //The API for connecting the angularJS pages
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  if($request->action){

    $api_action = $request->action;

    switch($api_action){
      case 'get_provider':
        
        //Gets the user info
        $user = wp_get_current_user();
        $meta = array();

        //Gets the meta info
        if($user->roles[0] == "service_provider"){
          $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'register-provider-form.php'
          ));

          $fields = get_field_objects($pages[0]->ID);
          foreach($fields as $field_name => $field){
            if($field['name'] != 'user_login' && $field['name'] != 'user_pass' && $field['name'] != 'user_email' && $field['name'] != 'nickname'){
              if (strpos($field['name'],'hidden') === false) {
                
                $meta[$field['name']] = array(
                  'label' => $field['label'],
                  'value' => get_user_meta($user->ID, $field['name'],true)
                );
              }
            }
          }
        }else{
          die(false);
        }

        
        //Checks if the user is on the active table
        $user_meta = get_user_meta($user->ID);
        $results = $wpdb->get_row( 'SELECT * FROM active_user WHERE user='.$user->ID, OBJECT );
        $user_active = false;
        $subs = get_posts(array(
            'post_type' => 'subscription_type',
            'meta_key'    => 'id',
            'meta_value'  => $user_meta['hidden_subscription_type'][0]
          )
        );

        if(count($results) <= 0){
          $args = array(
            'user' => $user->ID,
            'registration_date' => date('Y-m-d H:i:s')
          );

          
          $price = get_field('price', $subs[0]->ID);

          if(is_numeric($price)){
            $args['pay_amount'] = $price;
          }
          
          $insert = $wpdb->insert('active_user', $args);
          if(!$insert){
            echo "DB user activation error. Please contact your webmaster";
          }else{
            $results = $wpdb->get_row( 'SELECT * FROM active_user WHERE user='.$user->ID, OBJECT );
          }
        }else{
          if($results->active == 1){
            $user_active = true;
          }
        }

        $user->active = $user_active;

        //Checks the subscription payments info
        $meta_payment = array();
        $meta_payment['plan_title'] = get_field('name', $subs[0]->ID);
        $meta_payment['plan_id'] = get_field('id', $subs[0]->ID);
        $meta_payment['plan_post_id'] = $subs[0]->ID;


        //Only if the user is active, otherwise he'll have no payments
        if($user_active){
          $meta_payment['pay_amount'] = $results->pay_amount;
          //Checks the next due date
          $payments = $wpdb->get_row('SELECT COUNT(*) as total FROM user_payment WHERE user='.$user->ID.' AND comments=0 ORDER BY system_payment_date DESC', OBJECT );

          if($payments == NULL){
            $meta_payment['due_date'] = $results->activation_date;
          }else{
            $total_months = $payments->total;
            $due_date = date('Y-m-d H:i:s', strtotime("+".$total_months." months", strtotime($results->activation_date)));
            $meta_payment['due_date'] = $due_date;
          }
        }


        $return_field = array(
          'user'=>$user,
          'meta'=>$meta,
          'payment'=>$meta_payment
        );

        echo json_encode($return_field);


        die();
      break;

      case 'get_user':

        //Gets the user info
        $user = wp_get_current_user();
        $response = array();

        if (!current_user_can('administrator') && !is_admin()) {
          echo json_encode(array('status' => 'unauthorized'));
          die();
        }

        $response['user'] = $user;
        
        //Gets the service providers
        $sql = "SELECT 
          usr.ID, usr.user_login, usr.display_name, 
          meta_comp.meta_value as company_name, meta_name.meta_value as contact_name,
          meta_phone.meta_value as phone_number,
          ac.active, ac.pay_amount, ac.registration_date, ac.activation_date

          FROM active_user as ac, wp_users as usr, 
          wp_usermeta as meta_comp, wp_usermeta as meta_name,
          wp_usermeta as meta_phone
          WHERE ac.user= usr.ID
          AND meta_comp.user_id = usr.ID
          AND meta_comp.meta_key = 'company_name'
          AND meta_name.user_id = usr.ID
          AND meta_name.meta_key = 'contact_name'
          AND meta_phone.user_id = usr.ID
          AND meta_phone.meta_key = 'telephone_number'
          ORDER BY ac.active, ac.registration_date DESC";
        $result = $wpdb->get_results($sql);

        $response['providers'] = $result;

        echo json_encode($response);

        die();


      break;

      case 'update_provider':
        $new_provider = $request->provider;
        
        
        $update_data = array(
          'active' => $new_provider->active,
          'pay_amount' => $new_provider->pay_amount
        );

        if($new_provider->activation_date == NULL && $new_provider->active == '1'){
          $update_data['activation_date'] = date('Y-m-d H:i:s');
        }
        
        $update = $wpdb->update('active_user', $update_data, array('user'=>$new_provider->ID));

        if($update===false){
          echo json_encode(array('response'=>'error'));
        }else{
          $sql = "SELECT 
          usr.ID, usr.user_login, usr.display_name, 
          meta_comp.meta_value as company_name, meta_name.meta_value as contact_name,
          meta_phone.meta_value as phone_number,
          ac.active, ac.pay_amount, ac.registration_date, ac.activation_date

          FROM active_user as ac, wp_users as usr, 
          wp_usermeta as meta_comp, wp_usermeta as meta_name,
          wp_usermeta as meta_phone
          WHERE ac.user = ".$new_provider->ID."
          AND ac.user= usr.ID
          AND meta_comp.user_id = usr.ID
          AND meta_comp.meta_key = 'company_name'
          AND meta_name.user_id = usr.ID
          AND meta_name.meta_key = 'contact_name'
          AND meta_phone.user_id = usr.ID
          AND meta_phone.meta_key = 'telephone_number'
          ORDER BY ac.active, ac.registration_date DESC";
          
          $result = $wpdb->get_row($sql);
          echo json_encode($result);
        }


      break;


      default:
        die(false);
      break;

    }




  }else{
    die(false);
  }


?>