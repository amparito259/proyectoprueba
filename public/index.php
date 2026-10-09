<?php
require_once __DIR__ . "/../controllers/ProductoController.php";

$controller = new ProductoController();
$action = $_GET['action'] ?? 'inicio';

switch ($action) {
    case 'productos':
        $controller->listar();
        break;

    case 'registrar':
        $controller->formulario();
        break;

    case 'guardar':
        $controller->guardar();
        break;

    case 'detalle':
        $controller->detalle();
        break;

    case 'inicio':
    default:
        $controller->inicio();
        break;
}