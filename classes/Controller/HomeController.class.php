<?php

class HomeController
{

    public function __construct()
    {}

    public static function show()
    {
        $vista = new HomeView();
        $vista->show();
    }
}

