<?php

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $urlParts = explode('/', $url);

    $controllerName = ucfirst($urlParts[1]) . 'Controller';
    $method = isset($urlParts[2]) ? $urlParts[2] : 'index';

    $params = [];

    if (isset($_GET['name'])) {
        $params[] = $_GET['name'];
    }

    if (isset($_GET['status'])) {
        $params[] = $_GET['status'];
    }

    $controllerFile = 'app/src/controller/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerName();

        if (method_exists($controller, $method)) {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            if (!empty($params)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                $controller->$method();
            }
        } else {
            echo json_encode(['error' => 'Método não encontrado']);
        }
    } else {
        echo json_encode(['error' => 'Controlador não encontrado']);
    }
} else {
    echo json_encode(['error' => 'Endpoint inválido']);
}
