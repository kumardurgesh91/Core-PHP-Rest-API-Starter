<?php

define("VERSION", "v1");
define('DIR_PATH', dirname(__FILE__));

if (ENV === 'prod') {
    define('URL', 'localhost/Core-PHP-API-Starter');
    define('PUBLIC_URL', URL . '/public');
    define('API_PATH', URL . '/' . VERSION . '/api');
    define('TOKEN_ISSURE', 'http://example.org');
    define('TOKEN_EXPIRE_AFTER', 3600 * 24 * 7); // 7 days
    define('TOKEN_AUDIENCE', 'http://example.org');
    define('TOKEN_ID', VERSION);
    define('IMAGE_DIRECTORY',  '/images');
    define('IMAGE_PATH', DIR_PATH . '/public' . IMAGE_DIRECTORY);
    define('IMAGE_URL', PUBLIC_URL . IMAGE_DIRECTORY);
} else if (ENV === 'dev') {
    define('URL', 'localhost/Core-PHP-API-Starter');
    define('PUBLIC_URL', URL . '/public');
    define('API_PATH', URL . '/' . VERSION . '/api');
    define('TOKEN_ISSURE', 'http://example.org');
    define('TOKEN_EXPIRE_AFTER', 3600 * 24 * 7); // 7 days
    define('TOKEN_AUDIENCE', 'http://example.org');
    define('TOKEN_ID', VERSION);
    define('IMAGE_DIRECTORY',  '/images');
    define('IMAGE_PATH', DIR_PATH . '/public' . IMAGE_DIRECTORY);
    define('IMAGE_URL', PUBLIC_URL . IMAGE_DIRECTORY);
} else {
    define('URL', 'localhost/Core-PHP-API-Starter');
    define('PUBLIC_URL', URL . '/public');
    define('API_PATH', URL . '/' . VERSION . '/api');
    define('TOKEN_ISSURE', 'http://example.org');
    define('TOKEN_EXPIRE_AFTER', 3600 * 24 * 7); // 7 days
    define('TOKEN_AUDIENCE', 'http://example.org');
    define('TOKEN_ID', VERSION);
    define('IMAGE_DIRECTORY',  '/images');
    define('IMAGE_PATH', DIR_PATH . '/public' . IMAGE_DIRECTORY);
    define('IMAGE_URL', PUBLIC_URL . IMAGE_DIRECTORY);
}


?>