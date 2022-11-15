<?php

require_once './app/models/products.model.php';
require_once './app/views/ApiView.php';

class productsApiController{
    private $model;
    private $view;
    private $data;

    public function __construct() {
        
        $this->model = new productsModel();
        $this->view = new ApiView();
        
        $this->data = file_get_contents("php://input");
    }

    private function getData(){
        return json_decode($this->data);
    }

    public function getModel($params = null){
        $model = $params[":MODEL"];
        $products = $this->model->getProducto($model);
        $this->view->response($products);
    
    }

    public function getProducts(){
            //$this->serverCheck();
            $sort = $this->getSorting();
            $query = $this->getQuery();
            $page = $this->getPage();
            $products = $this->model->getAll($sort, $query, $page);
            $this->view->response($products);

    }

    private function getPage($params = null){
        if(isset($_GET['pag']) && ((!empty($_GET['pag']) || $_GET['pag'] == 0) && is_numeric($_GET['pag'])) && ($_GET["pag"]) >= 0){
            $params["pag"] = $_GET["pag"];
            return $params;
        }else{
            return null;
        }
    }

    private function getSorting(){
        $columns = $this->model->getColumns();
        if(empty($_GET["sort"]) && (empty($_GET["order"])))
            return null;
        if(isset($_GET["sort"]) && !empty($_GET["sort"]))
            $sortGet = $_GET["sort"];
        else $sortGet = "id";
        if(isset($_GET["order"]) && !empty($_GET["order"]))
            $order = $_GET["order"];
        else $order = null;

        $sort = array(
            "sort" => $sortGet,
            "order" => $order
        );

        if(in_array($sort["sort"], $columns)){
            if($this->getPage() != null)
                $sort = $this->getPage($sort);
            return $sort;
        }else{
            $this->view->response("No existe el parametro para sortear: ".$sort['sort'], 404);
            die();
        }

        return null;
    }

    private function getQuery(){
        $columns = $this->model->getColumns();
        if(count($_GET) <= 1)
            return null;
        
            $query = array();
            $flag = false;
            foreach ($_GET as $key => $value) {
                if($flag == false)
                    $flag = true;
                else{
                    if(!empty($value))
                        if($key != "sort" && $key != "order" && $key != "pag")
                            $query[$key] = $value;
                }
            }
            if(!empty($query)){
                foreach ($query as $key => $value) {
                    if(!in_array($key, $columns)){
                        $this->view->response("No se encontró ninguna llave con el valor: $key", 404);
                        die();
                    }                
                }
                //$products = $this->model->getProductsQuery($query);
                return $query;
            }
            return null;
    }

    public function getProductByID($params = null){
            $id = $params[':ID'];
            $product = $this->model->getProductByID($id);
    
            // caso de que no exista se devuelve 404
            if($product)
                $this->view->response($product);
            else
                $this->view->response("No existe el producto (id: $id)", 404);
    }

    public function deleteProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProductByID($id);
        // caso de que no exista se devuelve 404
        if($product){
            $this->model->deleteProduct($id);
            $this->view->response($product);
        }
        else
            $this->view->response("No existe el producto (id: $id)", 404);
    }

    public function editProduct($params = null){
        $id = $params[":ID"];
        $data = $this->getData();

        $model = $data->model;
        $price = $data->price;
        $country = $data->country;
        $brand = $data->brand;
        $characteristics = $data->characteristics;
        $categoryFK = $data->categoryFK;
        if(!empty($model) && !empty($price)
            && !empty($country) && !empty($brand)
            && !empty($characteristics) && !empty($categoryFK)){
                try{
                    $this->model->editProduct($model, $price, $country, $brand, $characteristics, $categoryFK, $id);
                    $editedProduct = $this->model->getProductByID($id);
                    $this->view->response($editedProduct);
                }catch(Exception $e){
                    $this->view->response("Ocurrio un error procesando la información", 400);
                }
            }else{
                $this->view->response("Faltan completar campos", 400);
            }
    }

    public function addProduct($params = null){
        $data = $this->getData();
        $model = $data->model;
        $price = $data->price;
        $country = $data->country;
        $brand = $data->brand;
        $characteristics = $data->characteristics;
        $categoryFK = $data->categoryFK;
        if(!empty($model) && !empty($price)
            && !empty($country) && !empty($brand)
            && !empty($characteristics) && !empty($categoryFK)){
                try{
                    $this->model->addProduct($model, $price, $country, $brand, $characteristics, $categoryFK);
                    $id = $this->model->lastInsertId();
                    $editedProduct = $this->model->getProductByID($id);
                    $this->view->response($editedProduct, 201);
                }
                catch(Exception $e){
                    $this->view->response("Ocurrio un error procesando la información", 400);
                }
            }else{
                $this->view->response("Faltan completar campos", 400);
            }
    }

    public function badURL(){
        $this->view->response("La url seleccionada no pertenece a ningún recurso", 404);
    }
}