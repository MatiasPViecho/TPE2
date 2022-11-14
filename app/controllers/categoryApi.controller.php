<?php

require_once './app/models/categories.model.php';
require_once './app/views/ApiView.php';

class categoryApiController{

    private $model;
    private $view;
    private $data;

    public function __construct(){
        $this->model = new categoriesModel();
        $this->view = new ApiView();

        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getCategories(){
        $products = $this->model->getAll();
        $this->view->response($products);
    }

    public function getCategoryID($params = null){
        $id = $params[':ID'];
        $category = $this->model->getCategory($id);

        // caso de que no exista se devuelve 404
        if($category)
            $this->view->response($category);
        else
            $this->view->response("No existe la categoria indicada (id: $id)", 404);
    }

    public function addCategory($params = null){
        $data = $this->getData();
        $category = $data->category;

        if(!empty($category)){
            $this->model->addCategory($category);
            $id = $this->model->lastInsertID();
            $categoryItem = $this->model->getCategory($id);
            $this->view->response($categoryItem, 201);
        }else{
            $this->view->response("Faltan completar campos", 400);
        }
    }

    public function deleteCategory($params = null){
        $id = $params[":ID"];
        $category = $this->model->getCategory($id);

        if($category){
            $this->model->deleteCategory($id);
            $this->view->response($category);
        }else
            $this->view->response("No existe la categoria indicada (id: $id)", 404);
    }

    public function editCategory($params = null){
        $id = $params[':ID'];
        $data = $this->getData();
        $category = $this->model->getCategory($id);
        $editCategory = $data->category;

        if($category){
            $this->model->editCategory($id, $editCategory);
            $category = $this->model->getCategory($id);
            $this->view->response($category);
        }else{
            $this->view->response("No existe la categoria indicada (id: $id)", 404);
        }

    }
}