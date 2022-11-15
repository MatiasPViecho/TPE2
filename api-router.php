<?php

require_once './libs/Router.php';
require_once './app/controllers/productsApi.controller.php';
require_once './app/controllers/categoryApi.controller.php';
require_once './app/controllers/comments.controller.php';

$router = new Router(); //Creación del objeto Router

// Defino tabla de RUTEO

// PRODUCTOS
$router->addRoute("products", "GET", "productsApiController", "getProducts"); //VER TODOS LOS PRODUCTOS
$router->addRoute("products/:ID", "GET", "productsApiController", "getProductByID"); //VER PRODUCTO POR ID
$router->addRoute("products/:ID", "DELETE", "productsApiController", "deleteProduct"); //BORRAR PRODUCTO (POR ID)
$router->addRoute("products/:ID", "PUT", "productsApiController", "editProduct"); // EDITAR PRODUCTO (POR ID)
$router->addRoute("products", "POST", "productsApiController", "addProduct"); // AGREGAR PRODUCTO

// CATEGORIAS
$router->addRoute("category", "GET", "categoryApiController", "getCategories"); // VER TODAS LAS CATEGORIAS
$router->addRoute("category/:ID", "GET", "categoryApiController", "getCategoryID"); //VER CATEGORIA POR ID
$router->addRoute("category", "POST", "categoryApiController", "addCategory"); // AGREGAR CATEGORIA
$router->addRoute("category/:ID", "DELETE", "categoryApiController", "deleteCategory"); //BORRAR CATEGORIA (POR ID)
$router->addRoute("category/:ID", "PUT", "categoryApiController", "editCategory"); // EDITAR CATEGORIA (POR ID)

//COMMENTS
$router->addRoute("comments", "POST", "commentsApiController", "postComment"); // PUBLICAR COMENTARIO
$router->addRoute("comments/:ID", "GET", "commentsApiController", "getCommentByID"); // GET COMENTARIO (POR ID)
$router->addRoute("comments", "GET", "commentsApiController", "getComments"); // GET COMENTARIOS
$router->addRoute("comments/:ID", "PUT", "commentsApiController", "editComment"); // EDITAR COMENTARIO (POR ID)
$router->addRoute("comments/:ID", "DELETE", "commentsApiController", "deleteComment"); // EDITAR COMENTARIO (POR ID)


// DEFAULT
$router->setDefaultRoute("productsApiController", "badURL");


// comando para ejecutar la ruta
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);