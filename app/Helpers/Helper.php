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

if (!function_exists('productUrl')) {
    /**
     * Generate URL cho product (chỉ slug, không có prefix)
     */
    function productUrl($product)
    {
        if (is_object($product) && isset($product->slug)) {
            return url('/' . $product->slug);
        }
        return url('/' . $product);
    }
}

if (!function_exists('postUrl')) {
    /**
     * Generate URL cho post (chỉ slug, không có prefix)
     */
    function postUrl($post)
    {
        if (is_object($post) && isset($post->slug)) {
            return url('/' . $post->slug);
        }
        return url('/' . $post);
    }
}
