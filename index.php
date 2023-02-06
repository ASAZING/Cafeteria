<?php 

require_once 'config/config.php';
require_once 'models/db.php';

if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = 'controllers/'.$_GET["controller"].'.php';

/* Valido si existe el controlador */
if(!file_exists($controller_path)) $controller_path = 'controllers/'.constant("DEFAULT_CONTROLLER").'.php';

/* Cargo controladores */
require_once $controller_path;
$controllerName = $_GET["controller"];
$controller = new $controllerName();

$dataToView["data"] = array();
if(method_exists($controller,$_GET["action"])) $dataToView["data"] = $controller->{$_GET["action"]}();


/* Cargo vistas */
require_once 'views/template/header.php';
require_once 'views/'.$controller->view.'.php';
