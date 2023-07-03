<?php

include 'interface.php';
include 'trait.php';

// require __DIR__ . '/interface.php';
// require __DIR__ . '/trait.php';



class menu {
    public static $menu = [
        1 => "Open Account",
        2 => "Check Balance",
        3 => "Deposit Money",
        4 => "Withdraw Money",
        5 => "Delete  Account",
        6 => "Leave System"
    ];
}

class Bank {
    public $accounts = [];

    function appendAccount($account){
        $this->accounts[key($account)] = array_values($account)[0];
    }

    function getAccountBalance($accountNumber){
        return $this->accounts[$accountNumber]['balance'];
    }

    function setBalance($accountNumber,$transaction){
        $this->accounts[$accountNumber]['balance'] = $transaction->updateBalance($this->accounts[$accountNumber]['balance']);
    }
    
    function deleteAccount($accountNumber){
        unset($this->accounts[$accountNumber]);
        echo "Account Deleted";
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
        $account[$this->generateRandomNumber(3)] = [
            "name"          => $this->name,
            "balance"       => 0
        ];

        return $account;
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

class withdraw implements updateBalance{
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
        return $currentBalance-$this->amount;
    }
}

$bank = new Bank();

$flag = false;

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
            $bank->appendAccount($accountDetails);
            echo "Congratulation your account is created. \n your account number is: ".key($accountDetails);
            break;
        case "2":
            echo "Enter your account number: ";
            $balance = $bank->getAccountBalance(readline());
            echo "\nyour current balance is: ". $balance;
            break;
        case "3":
            echo "\nEnter your account number: ";
            $accountNumber = readline();
            echo "\nEnter your deposit amount: ";
            $bank->setBalance($accountNumber,new deposit(readline()));
            break;
        case "4":
            echo "\nEnter your account number: ";
            $accountNumber = readline();
            echo "\nEnter your deposit amount: ";
            $bank->setBalance($accountNumber,new withdraw(readline()));
            break;
        case "5":
            echo "\nEnter your account number: ";
            $bank->deleteAccount(readline());
            break;
        case "6":
            $flag = true;
            echo "Leaving the system\n";
            break;
        default:
            echo "Wrong Input";
    }

    if($flag) break;
    
    echo "\n";
}

