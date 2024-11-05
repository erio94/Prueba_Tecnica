<?php

class CommentController extends Controller
{
    public function __construct() {}

    public function recuperarComentarios(){
        $model = new CommentModel();
        $resultado = $model->recuperarComentarios();
        $view = new CommentView();
        $view->recuperarComentarios($resultado);
    }

}