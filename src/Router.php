<?php

namespace App;

class Router
{
    public function behave()
    {
        $pathController = "\App\Controllers";
        $controller = $pathController . "\\" . ucfirst($_GET['c']); //преобразует первый символ строки в верхний регистр.
        $method = strtolower($_GET['m']); //преобразовывает строку в нижний регистр.

        if (!class_exists($controller)){
            die("Некорректный запрос");
        }

        $class = new $controller();

        if (!method_exists($class,$method)){
            die("Некорректный запрос");
        }

        $class->$method();
    }
}