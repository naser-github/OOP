<?php
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

?>