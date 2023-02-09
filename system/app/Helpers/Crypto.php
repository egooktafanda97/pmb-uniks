<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Validator;

class Crypto
{
    public static $key = "4736d52f85bdb63e46bf7d6d41bbd551af36e1bfb7c68164bf81e2400d291319";

    public function set_key($key)
    {
        $this->key = $key;
    }
    public function get_key()
    {
        return $this->key;
    }

    public static function encript_kripto($str)
    {
        $kunci = self::$key;
        $hasil = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $karakter = substr($str, $i, 1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
            $karakter = chr(ord($karakter) + ord($kuncikarakter));
            $hasil .= $karakter;
        }
        return urlencode(base64_encode($hasil));
    }
    public static function descript_kripto($str)
    {
        $str = base64_decode(urldecode($str));
        $hasil = '';
        $kunci = self::$key;
        for ($i = 0; $i < strlen($str); $i++) {
            $karakter = substr($str, $i, 1);
            $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
            $karakter = chr(ord($karakter) - ord($kuncikarakter));
            $hasil .= $karakter;
        }
        return $hasil;
    }

    public static function encrypt($string, $salt = null)
    {
        if ($salt === null) {
            $salt = hash('sha256', uniqid(mt_rand(), true));
        }  // this is an unique salt per entry and directly stored within a password
        return base64_encode(openssl_encrypt($string, 'AES-256-CBC', self::$key, 0, str_pad(substr($salt, 0, 16), 16, '0', STR_PAD_LEFT))) . ':' . $salt;
    }
    public static function decrypt($string)
    {
        if (count(explode(':', $string)) !== 2) {
            return $string;
        }
        $salt = explode(":", $string)[1];
        $string = explode(":", $string)[0]; // read salt from entry
        return openssl_decrypt(base64_decode($string), 'AES-256-CBC', self::$key, 0, str_pad(substr($salt, 0, 16), 16, '0', STR_PAD_LEFT));
    }
}
