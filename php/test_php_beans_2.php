<?php

if (!defined('sugarEntry') || !sugarEntry) {
   die('Not A Valid Entry Point');
}



function action_create_bean_account(){
    $acount_bean = BeanFactory::newBean('Accounts');
    $account_bean->name = $_POST('name');
    $account_bean->date_entered = date("Y-m-d H:i:s");
    $account_bean->email1 = $_POST('email');
    $account_bean->phone_office = $_POST('phone');
    $account_bean->save();
}
