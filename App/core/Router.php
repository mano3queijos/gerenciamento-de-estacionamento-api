<?php

namespace App\Core;

class Router {

    private $controller;
    private $method;
    private $controllerMethod;
    private $params = [];

    public function __construct() {
        
        $url = $this->parseURL();

        // Se nenhum controlador foi especificado na URL
        if (empty($url[2])) {
            
            echo "Gerenciamento de estacionamento";
            exit;
        }

        // Caminho do arquivo do controlador
        $controllerFile = "../App/Controllers/" . ucfirst($url[1]) . ".php";

        // Verifica se o arquivo do controlador existe
        if (file_exists($controllerFile)) {
            $this->controller = $url[1];
            unset($url[1]);
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Recurso não encontrado"]);
            exit;
        }

        require_once $controllerFile;

        $this->controller = new $this->controller;

        $this->method = $_SERVER["REQUEST_METHOD"];

        switch ($this->method) {
            case "GET":
                if (isset($url[2])) {
                    $this->controllerMethod = "find";
                    $this->params = [$url[2]];
                } else {
                    $this->controllerMethod = "index";
                }
                break;

            case "POST":
                $this->controllerMethod = "store";
                break;

            case "PUT":
                $this->controllerMethod = "update";
                if (isset($url[2]) && is_numeric($url[2])) {
                    $this->params = [$url[2]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                if (isset($url[2]) && is_numeric($url[2])) {
                    $this->params = [$url[2]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            default: 
                echo "Método não suportado";
                exit;
                break;
        }

        // Chama o método do controlador com os parâmetros
        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    private function parseURL() {
        return explode("/", trim($_SERVER["REQUEST_URI"], "/"));
    }
}
