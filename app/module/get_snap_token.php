<?php 
session_start();
require_once dirname(__FILE__) . '/Midtrans.php';
include(dirname(dirname(__DIR__))."/app/config/config.php");

// midtrans
// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'Mid-server-jOpYEXZTmxWSuIdyww2Ya6y6';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = true;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;
$midtrans_url = "https://app.midtrans.com/snap/v1/transactions";

if(isset($_POST['id_pricelist'])){

    $id_pricelist = $_POST['id_pricelist'];
    if(!is_numeric($id_pricelist)){
        echo "Token Not Found";
        return;
    }
    $SQL_package = $member->prepare('
        select * from pricelist
        where id_pricelist = '.$id_pricelist);
    $SQL_package->execute();
    $package_data = $SQL_package->fetch();
    $username = $_SESSION['Username'];
    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => $package_data['price'],
        ),
        'customer_details' => array(
            'first_name' => $username,
            'last_name' => '',
            'email' => 'budi.pra@example.com',
            'phone' => '08111222333',
        ),
    );

    $transaction = [];
    $transaction[0] = $params['transaction_details']['order_id'];
    $transaction[1] = $package_data['count_coin'];
    $transaction[2] = $username;
    
    $SQL_transaction = $member->prepare('insert into item_order (order_id, coins, username) values (?,?,?)');
    
    $SQL_transaction->execute($transaction);
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo $snapToken;
    return;
}
echo "Token Not Found";