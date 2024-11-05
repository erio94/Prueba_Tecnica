<?php

class ImageController extends Controller
{
    public function __construct() {}


    /**
     * Encuentra las imagenes duplicadas
     */

     public function encontrarImaganesDuplicadas(){
        $model = new ImageModel();
        $result = $model->encontrarImaganesDuplicadas();
        $view = new ImageView();
        $view->showImaganesDuplicadas($result);
     }

     /**
      * Elimina las imagenes duplicadas
      */
     public function eliminarImagenesDuplicadas(){
        $model = new ImageModel();
        $result = $model->eliminarImagenesDuplicadas();
        $view = new ImageView();
        $view->showEliminarImaganesDuplicadas("Hay un total de filas afectadas : " . $result);
     }

     /**
      * Corrige las imagenes duplicadas
      */
     public function corregirImagenesPrimariasDuplicadas(){
        $model = new ImageModel();
        $result = $model->corregirImagenesPrimariasDuplicadas();
        $view = new ImageView();
        $view->showCorregirImaganesDuplicadas("Hay un total de filas afectadas : " . $result);
     }
}
