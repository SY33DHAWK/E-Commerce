<?php
// Front Controller - Single entry point

define('ROOT', dirname(__DIR__) . '/');

require_once ROOT . 'config/config.php';
require_once ROOT . 'config/database.php';
require_once ROOT . 'core/Validator.php';
require_once ROOT . 'core/App.php';
require_once ROOT . 'core/Controller.php';
require_once ROOT . 'core/Model.php';

$app = new App();
?>
