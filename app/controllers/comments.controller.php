<?php

require_once './app/models/comments.model.php';
require_once './app/views/ApiView.php';

class commentsApiController{
    private $model;
    private $view;
    private $data;

    public function __construct(){
        $this->model = new commentsModel();
        $this->view = new ApiView();

        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getComments(){
        
        if(!isset($_GET['product'])){
            $comments = $this->model->getAll();
            $this->view->response($comments);
        }else{
            $productID = $_GET['product'];
            if(is_numeric($productID)){
                $comments = $this->model->getCommentProduct($productID);
                if($comments){
                    $this->view->response($comments);
                }else{
                    $this->view->response("No se encontraron comentarios para ese producto", 404);
                }
            }else{
                $this->view->response("El producto solo puede buscarse por su ID", 400);
            }
        }
    }

    public function getCommentByID($params = null){
        $id = $params[":ID"];
        $comment = $this->model->getComment($id);
        if($comment)
            $this->view->response($comment);
        else    
            $this->view->response("El comentario no existe", 404);
    }

    public function postComment(){
        $data = $this->getData();
        $comment = $data->comment;
        $rating = $data->rating;
        $idProduct = $data->id_product_fk;

        if(!empty($comment) && !empty($rating) && !empty($idProduct)){
            if($rating < 1 || $rating > 10){
                $this->view->response("El rating solo puede estar entre 0 y 10 (NO $rating)", 400);
                die();
            }
            try{
                $this->model->addComment($comment, $rating, $idProduct);
                $id = $this->model->lastInsertId();
                $newComment = $this->model->getComment($id);
                $this->view->response($newComment, 201);
            }catch(Exception $e){
                $this->view->response("Ocurrió un error procesando el pedido", 400);
            }
        }else
            $this->view->response("Faltan completar ciertos campos", 400);
    }

    public function editComment($params){
        $id = $params[":ID"];
        $comment = $this->model->getComment($id);
        $data = $this->getData();
        $comment = $data->comment;
        $rating = $data->rating;
        $idProduct = $data->id_product_fk;

        if($comment){
            if(!empty($comment) && !empty($rating) && !empty($idProduct)){
                if($rating < 1 || $rating > 10){
                    $this->view->response("El rating solo puede estar entre 0 y 10 (NO $rating)", 400);
                    die();
                }
                try{
                    $this->model->editComment($id, $comment, $rating, $idProduct);
                    $newComment = $this->model->getComment($id);
                    $this->view->response($newComment, 200);
                }catch(Exception $e){
                    $this->view->response("Ocurrio un error procesando el pedido", 400);
                }
            }else
                $this->view->response("El comentario seleccionado no existe", 404);
        }
    }

    public function deleteComment($params = null){
        $id = $params[":ID"];
        $comment = $this->model->getComment($id);
        
        if($comment){
            $this->model->deleteComment($id);
            $this->view->response($comment);
        }else{
            $this->view->response("El comentario no existe", 404);
        }
    }
}
