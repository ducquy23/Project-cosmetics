<?php

/**
 * Helper functions để generate URL cho product và post (chỉ slug, không có prefix)
 */

if (!function_exists('route_product')) {
    /**
     * Generate URL cho product (chỉ slug, không có prefix)
     */
    function route_product($product)
    {
        $slug = is_object($product) && isset($product->slug) ? $product->slug : $product;
        return url('/' . $slug);
    }
}

if (!function_exists('route_blog_detail')) {
    /**
     * Generate URL cho post (chỉ slug, không có prefix)
     */
    function route_blog_detail($post)
    {
        $slug = is_object($post) && isset($post->slug) ? $post->slug : $post;
        return url('/' . $slug);
    }
}
