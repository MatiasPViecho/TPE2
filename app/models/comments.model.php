<?php

class commentsModel{
    private $db;

    function __construct(){
        $this->connect();
    }

    function connect(){
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_cinemastore;charset=utf8', 'root', '');
    }

    function getAll(){
        $query = $this->db->prepare("SELECT * FROM comments");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    function getComment($id){
        $query = $this->db->prepare("SELECT * FROM comments WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    function addComment($comment, $rating, $prodID){
        $query = $this->db->prepare("INSERT INTO comments (comment, rating, id_product_fk) VALUES (?, ?, ?)");
        $query->execute([$comment, $rating, $prodID]);
    }

    function deleteComment($id){
        $query = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        $query->execute([$id]);
    }

    function editComment($id, $comment, $rating){
        $query = $this->db->prepare("UPDATE comments SET comment = ?, rating = ? WHERE id = ?");
        $query->execute([$comment, $rating, $id]);
    }
    function lastInsertId(){
        return $this->db->lastInsertId();
    }

    function getCommentProduct($prodID){
        $query = $this->db->prepare("SELECT * FROM comments WHERE id_product_fk = ?");
        $query->execute([$prodID]);
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }


}