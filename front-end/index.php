<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/Excel/reader.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();