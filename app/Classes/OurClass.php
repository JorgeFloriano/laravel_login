<?php

namespace App\Classes;

class OurClass {

    public function checkSession() {
        return session()->has('user');
    }

    public function test() {
        echo 'Olá!!';
    }
}
