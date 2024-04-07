<?php

namespace App\Classes;

class Enc
{

    public function encrypt($value)
    {
        return bin2hex(openssl_encrypt(
            $value,
            'aes-256-cbc',
            '7amt9KMrZEEvBiRHdYCcfhpusbeHNDNQ',
            OPENSSL_RAW_DATA,
            '2ZPjBpLE2BMyDfvn'
        ));
    }

    public function decrypt($enc_value)
    {
        // check if hash is valid
        if (strlen($enc_value)%2 !=0) {
            return null;
        }
        return openssl_decrypt(
            hex2bin($enc_value),
            'aes-256-cbc',
            '7amt9KMrZEEvBiRHdYCcfhpusbeHNDNQ',
            OPENSSL_RAW_DATA,
            '2ZPjBpLE2BMyDfvn'
        );
    }
}
