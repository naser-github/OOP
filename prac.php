<?php

class menu {
    public static $menu = [
        1 => "Deposit Money",
        2 => "Deposit Money",
        3 => "Withdraw Money",
        4 => "Last 5 transaction",
        5 => "Deactivate  Account",
        6 => "Leave System"
    ];
}

class account {
    private $accountNumber = null;
    protected $balance = 0;

    function __construct($accountNumber, $amount){
        $this->accountNumber = $accountNumber;
        $this->balance = $amount;
    }
    
    function getAccountNumber(){
        return $this->accountNumber;
    }
    
    function getBalance(){
        return $this->balance;
    }
}

class openAccount extends account {
    
    function __construct(){
        echo "Welcome \n";

        parent::__construct($this->generateRandomNumber(),0);
        
        echo "Your new account number is: ".$this->getAccountNumber()."\n";
    }

    function generateRandomNumber(){
        $digit = 8;
        return rand(pow(10, $digit-1), pow(10, $digit)-1);
    }
}

class deposit extends account{
    $value = 0;

    function __construct($value){
        if($value>0){
            $this->value = $value;
        }else{
            echo "something went wrong";
        }
        
    }

    function depositFunction($amount){
        $this->balance+=$amount;
    }
}

$ob1 = new openAccount();

    
while(1){
    echo "\n"."Chose an Option \n \n";
    foreach(menu::$menu as $key => $m){
        echo $key ." => ". $m ."\n";
        
    }
    echo "\n";
    
    $x = readline();
    
    switch ($x) {
        case "1":
            echo "\n how much you want to deposit? \n";
            $deposit = readline();
            break;
        case "2":
            echo "Withdrawing Money";
            break;
        case "3":
            echo "Last 5 transaction";
            break;
        case "4":
            echo "Deactivate the account";
            break;
        case "5":
            echo "Leaving the system";
            break;
        case "6":
            echo "Leaving the system";
            break;
      default:
        echo "Wrong Input";
    }
    
    echo "\n";
}
?>