<?php
//parent
class Account{

//Properties
public $account_no = "65467554357457";
public $account_name = "John Doe";

//Methods
public function getAccountNo(){
    echo $this -> account_no;
}

}

//create an object - for displaying 
$account = new Account();
//var_dump($account);
$account -> getAccountNo();
?>