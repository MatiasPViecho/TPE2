<?php

class categoriesModel{
    private $db;

    function __construct(){
        $this->connect();
    }

    function connect(){
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_cinemastore;charset=utf8', 'root', '');
    }

    function getAll(){
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    function getCategory($id){
        $query = $this->db->prepare('SELECT * FROM categories where id = ?');
        $query->execute([$id]);

        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    function getName($id){
        $result = $this->getCategory($id);
        return $result->category;
    }

    function addCategory($category){
        $query = $this->db->prepare('INSERT INTO categories (category) VALUES (?)');
        $query->execute([$category]);
    }

    function editCategory($id, $category){
        $query = $this->db->prepare('UPDATE categories SET category = ? WHERE id = ?');
        $query->execute([$category, $id]);
    }

    function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categories WHERE id = ?');
        $query->execute([$id]);
    }

    function lastInsertId(){
        return $this->db->lastInsertId();
    }
}