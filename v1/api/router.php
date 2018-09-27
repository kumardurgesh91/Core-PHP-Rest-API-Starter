<?php

require_once "RouteHandler.class.php";
$router = new RouteHandler;
/*
 * Define here routes or include from other files
 */

foreach (glob("../routes/*.php") as $filename) {
    include_once $filename;
}

$router->execute();
?>