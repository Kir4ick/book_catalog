<?php

namespace App\Router;

class Router{

    private function __construct(){}

    private static $lists = [];

    public static function Route($uri, $pageName){
        self::$lists[] = [
            'uri' => $uri,
            'page_name' => $pageName
        ];
    }

    public static function Action($uri, $HTTPRequest, $ClassName, $methodName, $file){
        self::$lists[] = [
            'uri' => $uri,
            'HTTPRequest' => $HTTPRequest,
            'ClassName' => $ClassName,
            'methodName' => $methodName,
            'file' => $file
        ];
    }

    public static function En(){
        $uri = $_GET['uri'];
        foreach (Self::$lists as $router) {
            if($router['HTTPRequest']){
                header("Content-Type: application/json; charset=UTF-8");
                if($router["uri"]=="/".$uri) {
                    switch ($router['HTTPRequest']) {
                        case 'GET':
                            $class = new $router['ClassName'];
                            $action = $router['methodName'];
                            $class->$action($_GET);
                            exit();
                        case 'POST':
                            $class = new $router['ClassName'];
                            $action = $router['methodName'];
                            $class->$action($_POST,$_FILES);
                            exit();
                        case 'PUT':
                            $class = new $router['ClassName'];
                            $action = $router['methodName'];
                            $class->$action($_GET);
                            exit();
                        case 'DELETE':
                            $class = new $router['ClassName'];
                            $action = $router['methodName'];
                            $class->$action($_GET);
                            exit();
                    }
                }
            }else{
                if($router["uri"]=="/".$uri){
                    require_once "media/views/".$router["page_name"].'.php';
                    exit();
                }  
            }
        }
        require_once 'media/views/errors/404.php';
    }    

}