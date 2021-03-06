<?php

require 'vendor/autoload.php';

use Billplz\API;
use Billplz\Connect;

$connect = (new Connect('<api-key-here>'))->detectMode();
//$connect->setMode(true); // true: production | false: staging (default)

/*
* Create Bill function can handle the following cases:
* - No Collection ID is passed
* - Wrong Collection ID is passed
* - No Collection was created at billplz
* - There is an inactive collection but no active collection
* - Mobile Phone Number value doesn't have proper formatting
* - Setting custom deliver notification by email or sms only
*/

$parameter = array(
    'collection_id' => '<collection-id-here>',
    'email'=>'youremail@gmail.com',
    'mobile'=>'0141234567',
    'name'=>'Lol',
    'amount'=>'200',
    'callback_url'=>'https://google.com',
    'description'=>'I am testing. Please ignore'
);

$optional = array(
    'redirect_url' => 'https://google.com',
    'reference_1_label' => 'Order ID',
    'reference_1' => '1',
    'reference_2_label' => 'Customer ID',
    'reference_2' => '111',
    /* 'deliver' => 'false' */
    /* Do not set due_at. The bills will expired in 30 days from creation */
);

/*
*  '0': Deliver false
*  '1': Deliver Email
*  '2': Deliver SMS
*  '3': Deliver Email & SMS
*/
$deliver = '3';

$billplz = new API($connect);
//$response = $billplz->createBill($parameter);
//$response = $billplz->createBill($parameter, $optional) ;
$response = $billplz->createBill($parameter, $optional, $deliver) ;

echo '<pre>'.print_r($response, true).'</pre>';
