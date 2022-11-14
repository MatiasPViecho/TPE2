<?php
    require_once './app/views/ApiView.php';
class productsModel{
    private $db;

    function __construct(){
        $this->connect();
    }
    
    function connect(){
        try{
            $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_cinemastore;charset=utf8', 'root', '');
        }
        catch(exception $e){

        }
    }

    function getAll($sort, $query, $page){
        $action = $this->db->prepare("SELECT * FROM products");
        if($sort != null && $query == null){
            $action = $this->order($action, $sort);
        }
        else if ($sort == null && $query != null){
            $action = $this->getProductsQuery($action, $query);
        }
        else if($sort != null && $query != null){
            $action = $this->getProductsQuery($action, $query);
            $action = $this->order($action, $sort);
        }
        
        if($page != null)
            $action = $this->page($action, $page);

        $action->execute();
        $result = $action->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    private function page($query, $params = null){
        if($params)
            $limit = 10;
        $page = ($params["pag"]);
        if($page != 0){
            $page= $page*10;
        }

        if($query == null)
            $query = $this->db->prepare('SELECT * FROM products');

        $queryAction = $query->queryString;
        //$query = $this->db->prepare($queryAction . ' LIMIT ? , ?');
        $query = $this->db->prepare($queryAction . " LIMIT $page , $limit");
        return $query;
    }

    function getProductsByCategory($fr_id){
        $query = $this->db->prepare('SELECT * FROM products where id_categories_fk = ?');
        $query->execute([$fr_id]);

        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    function getProductById($id){
        try{
            $query = $this->db->prepare('SELECT * FROM products where id = ?');
            $query->execute([$id]);
    
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }catch(Exception $e){
            return false;
        }
    }

    //            $this->productsModel->addProduct($model, $price, $country, $brand, $characteristics, $categoryFK);
    function addProduct($model, $price, $country, $brand, $characteristics, $fk){
        $query = $this->db->prepare('INSERT INTO products (model, price, country, brand, techChar, id_categories_fk) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$model, $price, $country, $brand, $characteristics, $fk]);
    }

    function editProduct($model, $price, $country, $brand, $characteristics, $fk, $id){
        $query = $this->db->prepare('UPDATE products SET model = ?, price = ?, country = ?, brand = ?, techChar = ?, id_categories_fk = ? WHERE id = ?');
        $query->execute([$model, $price, $country, $brand, $characteristics, $fk, $id]);
    }

    function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $query->execute([$id]);
    }

    function lastInsertId(){
        return $this->db->lastInsertId();
    }

    public function getProductsQuery($query, $params = null){
        if($query == null)
            $query = $this->db->prepare("SELECT * FROM products");

        $flag = true;
        foreach($params as $key => $value){
            if($flag == true){
                $query = $this->db->prepare("$query->queryString WHERE $key LIKE '%$value%'");
                $flag = false;
            }
            else
                $query = $this->db->prepare("$query->queryString AND $key LIKE '%$value%'");
        }
        
        //$query = $this->db->prepare("$query->queryString $queryAction");
        //echo $query->queryString ."\n";
        //$query->execute();
        //$result = $query->fetchAll(PDO::FETCH_OBJ);
        return $query;
    }

    public function getProducto($model){
        $query = $this->db->prepare("SELECT * FROM products WHERE model LIKE :model");
        $query->bindValue(":model", "%{$model}%");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    private function order($query, $params = null){
        // sort = tipo de parametro: model, price, etc.
        // order = tipo de orden: ascendente, descendente
        if($params != null){
            $sort = $params["sort"];
            $order = $params["order"];
            $queryAction = $query->queryString;
            $query = $this->db->prepare("$queryAction ORDER BY $sort $order");
        }
        return $query;
        //var_dump($query);
    }

    public function getColumns(){
        $query = $this->db->prepare('DESCRIBE products');
        // de esta manera me puedo retonar solamente los nombres de las columnas con ningún valor agregado
        $result = $query->execute();
        $columns = array();
        $result = $query->fetchAll(PDO::FETCH_COLUMN);
        foreach ($result as $key) {
            $columns[] = $key;
        }
        return $columns;
    }
}