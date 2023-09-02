<?php
session_start();
require_once('Kernel/Router.php');
$dispatcher = new Router();
$dispatcher->dispatch();
?>