<?php

class ErrorView
{

    private $exception;

    public function __construct(Exception $ex = null)
    {
        $this->exception = $ex;
    }

    public function show($param = null)
    {
        $titol = "ERROR INESPERADO";
        $missatge = (is_null($this->exception)) ? ((is_null($param)) ? "Ha ocurrido un error no definido " : $param) : $this->exception->getMessage();

        include "templates/tpl_error.php";
    }

    public function ok($titol, $missatge)
    {

        include "templates/tpl_ok.php";
    }

    public function error($titol, $missatge)
    {

        include "templates/tpl_error.php";
    }
}
