<?php

require_once 'env.php';
require_once 'config.php';
require_once 'db.config.php';
require_once 'tables.php';

require_once DIR_PATH . '/lib/Response.php';
require_once DIR_PATH . '/lib/Utils.php';
require_once DIR_PATH . '/lib/ErrorMessage.php';

if (ENV === 'prod') {
    error_reporting(0);
} else if (ENV === 'dev') {
    error_reporting(E_ALL);
} else {
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}
$response = new Response();
$utils = new Utils();
$error = new ErrorMessage();
?>