<?php


// functions.php
function check_txnid($tnxid){

  $valid_txnid = true;
  //get result set
  global $wpdb;
  $result = $wpdb->get_row("SELECT * FROM user_payment WHERE txn_id = '".$tnxid."'", OBJECT);
  
  if($result != NULL){
    $valid_txnid = false;
  }

  return $valid_txnid;
}

function check_price($price, $user_id){

  $valid_price = false;
  //you could use the below to check whether the correct price has been paid for the product

  global $wpdb;
  $result = $wpdb->get_row("SELECT * FROM active_user WHERE user = ".$user_id, OBJECT);
  
  if($result != NULL){
    if($price == $result->pay_amount){
      $valid_price = true;
    }
  }

  return $valid_price;
}

function updatePayments($data, $comment){


  global $wpdb;

  

  if(is_array($data)){

    $args = array();

    //Gets all the table fields
    $pay_table = $wpdb->get_results("sELECT * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='user_payment'");
    
    if($pay_table){
      foreach($pay_table as $col){

        if($data[$col->COLUMN_NAME]){
          $args[$col->COLUMN_NAME] = $data[$col->COLUMN_NAME];
        }
      } 
    }

    $args['user'] = $data['custom'];
    $args['system_payment_date'] = date("Y-m-d H:i:s");

    if($comment == ""){
      $args['comments'] = "0";
    }


    $insert = $wpdb->insert('user_payment', $args);

    if(!$insert){
      return false;
    }
    return true;
  }
}




?>