<?php
session_start();
require_once('Kernel/Router.php');
$router = new Router();
$router->doRoute();
?>