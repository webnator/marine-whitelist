<?php

//Wordpress functionality
require_once(dirname(__FILE__).'/../../../../wp-load.php');

$testing = true;
$paypal_url = "www.paypal.com";
if($testing){
  $paypal_url = "www.sandbox.paypal.com";
}


// PayPal settings
$paypal_email = 'webnator-facilitator@gmail.com';
$return_url = get_stylesheet_directory_uri().'/profile.php';
$cancel_url = get_stylesheet_directory_uri().'/profile.php';
$notify_url = 'http://88.16.84.83:8888/marine-whitelist/wp-content/themes/marine-white-theme/php_functions/paypal_payment.php';

// Include Functions
include("functions.php");

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

  //If the user is not logged in go home
  if (!is_user_logged_in() ) {
    header("Location: ".home_url());
    die();
  }

  //gets the user data
  $user = wp_get_current_user();
  $meta = get_user_meta($user->ID);

  global $wpdb;
  //Checks if the user is on the active table
  $results = $wpdb->get_row( 'SELECT * FROM active_user WHERE user='.$user->ID, OBJECT );
  $user_active = false;

  //If the user is not active go home
  if(count($results) <= 0){
    header("Location: ".home_url());
    die();
  }else{
    if($results->active == 0){
      header("Location: ".home_url());
      die();
    }
  }

  $item_name = 'Marine Whitelist Subscription '.date('F Y');
  $item_amount = $results->pay_amount;
  //$item_amount = 1.3;


  $querystring = '';

  // Firstly Append paypal account to querystring
  $querystring .= "?business=".urlencode($paypal_email)."&";

  // Append amount & currency (£) to quersytring so it cannot be edited in html

  //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
  $querystring .= "item_name=".urlencode($item_name)."&";
  $querystring .= "amount=".urlencode($item_amount)."&";

  //loop for posted values and append to querystring
  foreach($_POST as $key => $value) {
      $value = urlencode(stripslashes($value));
      $querystring .= "$key=$value&";
  }

  // Append paypal return addresses
  $querystring .= "return=".urlencode(stripslashes($return_url))."&";
  $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
  $querystring .= "notify_url=".urlencode($notify_url);

  // Append querystring with custom field
  $querystring .= "&custom=".$user->ID;

  // Redirect to paypal IPN
  header('location:https://'.$paypal_url.'/cgi-bin/webscr'.$querystring);
  exit();

} else {

  // Response from Paypal

  // read the post from PayPal system and add 'cmd'
  $req = 'cmd=_notify-validate';
  foreach ($_POST as $key => $value) {
      $value = urlencode(stripslashes($value));
      $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
      $req .= "&$key=$value";
  }
      
  // post back to PayPal system to validate
  $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
  $header .= "Host: ".$paypal_url."\r\n";
  $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
  
  $fp = fsockopen ('ssl://'.$paypal_url, 443, $errno, $errstr, 30);
  
  if (!$fp) {
    // HTTP ERROR
      
  } else {

    $puts = fputs($fp, $header . $req);

    while (!feof($fp)) {

      $res = fgets ($fp, 1024);
      
      if (strcmp($res, "VERIFIED") == 0) {
                  
        // Validate payment (Check unique txnid & correct price)

        $valid_txnid = check_txnid($_POST['txn_id']);
        $valid_price = check_price($_POST['mc_gross'], $_POST['custom']);
        
        // PAYMENT VALIDATED & VERIFIED!
        if ($valid_txnid && $valid_price) {
            
            $orderid = updatePayments($_POST);
            
            if ($orderid) {
                // Payment has been made & successfully inserted into the Database
            } else {
                // Error inserting into DB
                // E-mail admin or alert user
              $email = get_option('admin_email');
              mail($email, 'PAYPAL POST - Payment received, error inserting on DB', print_r($_POST, true));
            }
        } else {
          // Payment made but data has been changed
          mail($email, 'PAYPAL POST - Payment received, with amount changed', print_r($_POST, true));
          $orderid = updatePayments($_POST,1);
        }
      
      } else if (strcmp ($res, "INVALID") == 0) {
      
        // PAYMENT INVALID & INVESTIGATE MANUALY!
        mail($email, 'PAYPAL POST - Payment received, not verified by PayPal', print_r($_POST, true));
        $orderid = updatePayments($_POST,2);
      }
    }
  fclose ($fp);
  }
}


?>