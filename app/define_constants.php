<?php
if (!defined('IT_COMPANY_NAME')) {

    define("IT_COMPANY_NAME", "Web Chilli");
    define("IT_COMPANY_ICON", "");

    $host = $_SERVER['APP_URL'] ?? "";
    if ($host)
    {
        $hostParts = explode('.', $host); // Remove the last two parts (domain and TLD) 
        $subdomain = implode('.', array_slice($hostParts, 0, -2)); 
        define("SUB_DOMAIN", $subdomain);
    }
    else
    {
        define("SUB_DOMAIN", "");
    }

    if (SUB_DOMAIN) {
        define("CACHE_PREFIX", SUB_DOMAIN . "-");
    } else {
        define("CACHE_PREFIX", "");
    }

    if (env('APP_ENV') == 'production')
    {
        define("BACKEND_CSS_VERSION", "05-feb-2025");
        define("BACKEND_JS_VERSION", "05-Feb-2025");

        define("CACHE_SEARCH_CONDITIONS_TIME", 60 * 24 * 30);
        define("CACHE_MODEL_TIME", 60 * 24 * 365);
        define("CACHE_MENU_TIME", 60 * 24 * 365);
    }
    else
    {
        define("BACKEND_CSS_VERSION", time());
        define("BACKEND_JS_VERSION", time());

        define("CACHE_SEARCH_CONDITIONS_TIME", 60 * 24);
        define("CACHE_MODEL_TIME", 60 * 1);
        define("CACHE_MENU_TIME", 60 * 1);
    }

    define("ACTION_NOT_PROCEED", 406);
}