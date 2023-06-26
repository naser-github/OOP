<?php

interface updateBalance
{
    public function updateBalance($currentBalance);
}

trait RandomNumberTrait {
    public function generateRandomNumber($digit) {
        return rand(pow(10, $digit-1), pow(10, $digit)-1);
    }
}

trait ErrorTrait {
    public function errorMessage(){
        return "something went wrong";
    }
}

class menu {
    public static $menu = [
        1 => "Open Account",
        2 => "Check Balance",
        3 => "Deposit Money",
        4 => "Withdraw Money",
        5 => "Last 5 transaction",
        6 => "Deactivate  Account",
        7 => "Leave System"
    ];
}

class Bank {
    public $accounts = [];

    function openAccount($account){
        $this->accounts[] = $account;
    }

    function getAccountBalance($accountNumber){
        echo array_search($accountNumber, array_column($this->accounts, 'accountNumber'));
    }

    function setBalance($accountNumber,$deposit){
        
    }
}

class OpenAccount{
    use RandomNumberTrait;

    public $name = null;

    function __construct(){
        $this->setName();        
    }

    function setName(){
        echo "Please enter your name: ";
        $this->name = readline();
    }

    function accountDetails(){
        return ([
            "name"          => $this->name,
            "accountNumber" => $this->generateRandomNumber(8), 
            "balance"       => 0
        ]);
    }
}

class deposit implements updateBalance{
    use ErrorTrait;

    public $amount = 0;

    function __construct($amount){
        if($amount>0){
            $this->amount = $amount;
        }else{
            echo $this->errorMessage();
        }
    }

    function updateBalance($currentBalance){
        return $currentBalance+$this->amount;
    }
}

$bank = new Bank();

while(1){
    echo "\n"."Chose an Option \n \n";
    foreach(menu::$menu as $key => $m){
        echo $key ." => ". $m ."\n";
    }
    echo "\n";
    
    switch (readline()) {
        case "1":
            $newAccount = new OpenAccount();
            $accountDetails = $newAccount->accountDetails();
            $bank->openAccount($accountDetails);
            echo "Congratulation your account is created. \n your account number is: ".$accountDetails['accountNumber'];
            break;
        case "2":
            echo "Enter your account number: ";
            $balance = $bank->getAccountBalance(readline());
            echo "\nyour current balance is: ". $balance;
            break;
        case "3":
            echo "\nEnter your account number: ";
            $accountNumber = readline();
            echo "\nhow much you want to deposit? \n";
            $deposit = new deposit(readline());
            $bank->setBalance($accountNumber,$deposit);
            break;
        case "4":
            echo "Withdrawing Money";
            break;
        case "5":
            echo "Last 5 transaction";
            break;
        case "6":
            echo "Deactivate the account";
            break;
        case "7":
            echo "Leaving the system";
            break;
        default:
            echo "Wrong Input";
    }
    
    echo "\n";
}
?>