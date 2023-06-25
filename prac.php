<?php

class menu {
    public static $menu = [
        1 => "Deposit Money",
        2 => "Withdraw Money",
        3 => "See Last 5 transaction",
        4 => "Deactivate  Account",
        5 => "Leave System"
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

$ob1 = new openAccount();

    
while(1){
    echo "\n"."Chose an Option \n \n";
foreach(menu::$menu as $key => $m){
    echo $key ." => ". $m ."\n";
}
echo "\n";

$x = readline();
echo $x;
}
?>