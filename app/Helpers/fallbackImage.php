<?php
/**
 * Fallback Images Helpers
 */


if (!function_exists('fallbackImageUrl')) {
    /**
     * Return fallback image uri/url from config by key.
     * @param string $key
     * @param bool $relative
     * @return string
     */
    function fallbackImageUrl(string $key, bool $relative = true): string
    {
        $fallback = config($key, config('app.fallback_image.base', ''));
        return $relative
            ? $fallback
            : url($fallback);
    }
}

if (!function_exists('fallbackBaseImageUrl')) {
    /**
     * Return fallback image uri for Base image.
     * @param mixed $url
     * @param bool $relative
     * @return string
     */
    function fallbackBaseImageUrl($url, bool $relative = true): string
    {
        return (string)$url ?: fallbackImageUrl('app.fallback_image.base', $relative);
    }
}

if (!function_exists('fallbackCategoryImageUrl')) {
    /**
     * Return fallback category image uri.
     * @param mixed $url
     * @param bool $relative
     * @return string
     */
    function fallbackCategoryImageUrl($url, bool $relative = true): string
    {
        return (string)$url ?: fallbackImageUrl('app.fallback_image.category', $relative);
    }
}
if (!function_exists('fallbackBrandImageUrl')) {
    /**
     * Return fallback category image uri.
     * @param mixed $url
     * @param bool $relative
     * @return string
     */
    function fallbackBrandImageUrl($url, bool $relative = true): string
    {
        return (string)$url ?: fallbackImageUrl('app.fallback_image.brand', $relative);
    }
}
if (!function_exists('fallbackProductImageUrl')) {
    /**
     * Return fallback category image uri.
     * @param mixed $url
     * @param bool $relative
     * @return string
     */
    function fallbackProductImageUrl($url, bool $relative = true): string
    {
        return (string)$url ?: fallbackImageUrl('app.fallback_image.product', $relative);
    }
}



