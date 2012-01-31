<?php

include(dirname(__FILE__).'../../../config/config.inc.php');
require_once("CategoriasController.php");
$hell = new CategoriasControllerCore();
$hell->run();
