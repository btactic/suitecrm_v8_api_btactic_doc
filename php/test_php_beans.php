<?php

if (!defined('sugarEntry') || !sugarEntry) {
   die('Not A Valid Entry Point');
}



function create_bean_account($name, $email){
    $account_bean = BeanFactory::newBean('Accounts');
    $account_bean->name = $name;
    $account_bean->date_entered = date("Y-m-d H:i:s");
    $account_bean->email1 = $email;
    $account_bean->save();
    return $account_bean->id
}
