<?php
if(ENV === 'dev') {
    define('DB_SERVER', "localhost");
    define('DB_USER', "root");
    define('DB_PASSWORD', "");
    define('DB_NAME', "core_php_rest_api_starter");
} else if(ENV === 'prod') {
    define('DB_SERVER', "localhost");
    define('DB_USER', "root");
    define('DB_PASSWORD', "");
    define('DB_NAME', "core_php_rest_api_starter");
} else if(ENV === 'test') {
    define('DB_SERVER', "localhost");
    define('DB_USER', "root");
    define('DB_PASSWORD', "");
    define('DB_NAME', "core_php_rest_api_starter");
}

?>