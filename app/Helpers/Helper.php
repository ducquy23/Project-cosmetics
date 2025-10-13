<?php

if (!function_exists('convertPrice')) {
    function convertPrice($amount, $currency = 'đ')
    {
        return number_format($amount) . $currency;
    }
}

if (!function_exists('initialPrice')) {
    function initialPrice($amount, $discount)
    {
        $price = $amount/(1 - ($discount/100));
        return $price;
    }
}
