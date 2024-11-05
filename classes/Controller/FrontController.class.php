<?php

class FrontController extends Controller
{

    public function __construct(){}
    
    public function dispatch() {
        $params=null;
        if ($_SERVER["REQUEST_METHOD"]=="GET" && count($_GET)==0) {
            $controller_name = "HomeController";
            $action = "show";
        } else {
            $url = array_keys($_GET)[0];
            //$_SERVER["QUERY_STRING"]
            $url = $this->sanitize($url,0);
            $url = trim($url,"/");
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            if (isset($url[0])) {
                $controller_name = ucwords($url[0])."Controller";
                if (isset($url[1])) {
                    $action = $url[1];
                }
                if (count($url) > 2) {
                    for ($i=2; $i<count($url); $i++) {
                        $params[] = strtolower($url[$i]);
                    }
                }
            }
        }
        
        if (file_exists("classes/Controller/$controller_name.class.php")) {
            $controller = new $controller_name();
            if (method_exists($controller,$action)) {
                $controller->$action($params);
            } else {
                throw new Exception("No existeix l'acció demanada: $action");
            }
        } else {
            throw new Exception("No existeix el controlador demanat: $controller_name");
        }
    }
}

