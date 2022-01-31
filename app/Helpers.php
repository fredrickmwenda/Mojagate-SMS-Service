<?php

use Wmandai\Mojagate\Facades\Mojagate;
use Illuminate\Support\Str;





if (!function_exists('correctPhoneNumber')) {
    /**
     * @param string $number
     * @param bool   $strip_plus
     *
     * @return string
     */
    function correctPhoneNumber($number, $strip_plus = true): string
    {
        $number = preg_replace('/\s+/', '', $number);
        $replace = static function ($needle, $replacement) use (&$number) {
            if (Str::startsWith($number, $needle)) {
                $pos = strpos($number, $needle);
                $length = strlen($needle);
                $number = substr_replace($number, $replacement, $pos, $length);
            }
        };
        $replace('2547', '+2547');
        $replace('07', '+2547');
        if ($strip_plus) {
            $replace('+254', '254');
        }
        return $number;
    }
}
if (!function_exists('randomMessageId')) {
    /**
     * Generate a random transaction number
     *
     * @return string
     */
    function randomMessageId(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }
}