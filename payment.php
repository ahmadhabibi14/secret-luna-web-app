<?php

include ('app/config/config.php');
if(isset($_POST['order_id'])){
    $SQL_transaction = $member->prepare("
        select * from item_order
        where order_id = ".$_POST['order_id']);
    $SQL_transaction->execute();
    $transaction = $SQL_transaction->fetch();

    // add coint to this member
    $SQL_user_data = $member->prepare('select * from chr_log_info
        where id_loginid = ?');
    $SQL_user_data->execute([$transaction['username']]);
    $user_data = $SQL_user_data->fetch();
    $user_data['id_star'] += $transaction['coins'];
    $SQL_update_star = $member->prepare('update chr_log_info
    set id_star = ?
    where id_loginid = ?');
    $SQL_update_star->execute([$user_data['id_star'],$transaction['username']]);
};