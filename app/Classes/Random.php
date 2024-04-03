<?php 

namespace App\Classes;

class Random {
    public function test() {
        return 'RANDOM!!!!!!';
    }

    public function SMSToken() {
        return rand(100000, 999999);
    }
}
?>