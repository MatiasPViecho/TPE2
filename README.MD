<a name="inicio"></a>
# TPE WEB 2
  <h2>TABLA DE CONTENIDOS</h2>
  <ol>
    <li>
      <a href="#ruta-productos">RUTAS API PRODUCTOS</a>
      <ul>
        <li><a href="#ruta-productos-delete">DELETE productos</a></li>
        <li><a href="#ruta-productos-put">PUT productos</a></li>
        <li><a href="#ruta-productos-post">POST productos</a></li>
      </ul>
    </li>
    <li>
      <a href="#ruta-categorias">RUTAS API CATEGORIAS</a>
      <ul>
        <li><a href="#ruta-categorias-get">GET Categorias</a></li>
        <li><a href="#ruta-categorias-delete">DELETE Categorias</a></li>
        <li><a href="#ruta-categorias-put">PUT Categorias</a></li>
        <li><a href="#ruta-categorias-post">POST Categorias</a></li>
      </ul>
    </li>
    <li>
      <a href="#ruta-comentarios">RUTAS API COMENTARIOS</a>
      <ul>
        <li><a href="#ruta-comentarios-get">GET Comentarios</a></li>
        <li><a href="#ruta-comentarios-delete">DELETE Comentarios</a></li>
        <li><a href="#ruta-comentarios-put">PUT Comentarios</a></li>
        <li><a href="#ruta-comentarios-post">POST Comentarios</a></li>
      </ul>
    </li>
    <li>
    <a href="#endpoints-simples">ENDPOINTS SIN URL</a>
    <ul></ul>
    </li>
  </ol>

<a name="ruta-productos"></a>

## RUTAS API - PRODUCTOS (GET)

```javascript

// get all productos
  http://localhost/WEB2/TPE/api/products

// get producto por ID
  http://localhost/WEB2/TPE/api/products/:ID

// get producto Ordenado
  http://localhost/WEB2/TPE/api/products?sort=model&order=asc
/*
sort puede tener cualquier campo de la tabla "products"
order puede ser tanto asc como desc
*/

// get productos paginados
  http://localhost/WEB2/TPE/api/productos?pag=0
// Solo acepta valores de paginado iguales o mayor a 0, el paginado va de a 10 productos

// get productos filtrados por campo
  http://localhost/WEB2/TPE/api/products?country=Japon
/* 
Se puede filtrar por cualquier tipo de campo que tenga
    # model=X
    # brand=X
    # Por defecto se filtrará por ID 
*/
```
```javascript
// Estos pedidos se pueden combinar de cualquier manera que se quiera
    http://localhost/WEB2/TPE/api/products?sort=price&order=desc&brand=canon&model=Mark&pag=0

/* 
Esto traerá los que cumplan con el filtrado Brand = (contiene) canon, Model = (contiene) mark 
    ordenados por el precio de forma descendente, en la página 0
Estos valores se pueden cambiar unos por otros, en caso de que no se asigne un valor de "sort" será "id" por defecto
    Al igual que "order" será "asc" por defecto
Dará error si se coloca un tipo de filtrado que no pertenezca a la tabla, por ejemplo "precio=" 
    Ya que no existe el campo "precio"
*/

```

# Rutas API - PRODUCTOS (POST, PUT, DELETE)

<a name="ruta-productos-delete"></a>

## Eliminar un producto (DELETE)
```javascript
    http://localhost/WEB2/TPE/api/products/:ID // METODO DELETE
```

<a name="ruta-productos-put"></a>

## Editar un producto (PUT)
```javascript
    http://localhost/WEB2/TPE/api/products/:ID // METODO PUT
    // JSON PARA PROBAR FUNCIONALIDAD, COLOCAR EN EL BODY
    {
        "model": "modeloPUT",
        "price": 25000,
        "country": "countryPUTPostman",
        "brand": "brandPUTPostman",
        "characteristics": "charPUTPostman",
        "categoryFK": 1
    }   
```
<a name="ruta-productos-post"></a>

## Añadir un producto (POST)
```javascript
    http://localhost/WEB2/TPE/api/products // METODO POST
    // JSON PARA PROBAR FUNCIONALIDAD, COLOCAR EN EL BODY
    {
        "model": "modeloPOST",
        "price": 1500,
        "country": "countryPOSTPostman",
        "brand": "brandPOSTPostman",
        "characteristics": "charPOSTPostman",
        "categoryFK": 11
    }  
```

<a name="ruta-categorias"></a>

# RUTAS API - CATEGORIAS

<a name="ruta-categorias-get"></a>

## Obtener Categorias (GET)
```javascript

// devuelve todas las categorias
  http://localhost/WEB2/TPE/api/category

// devuelve una categoria específica a un ID
  http://localhost/WEB2/TPE/api/category/:ID
```
<a name="ruta-categorias-delete"></a>

## Borrar Categoria (DELETE)
```javascript
    http://localhost/WEB2/TPE/api/category/:ID // METODO DELETE
    // devolverá como resultado la categoría eliminada
```
<a name="ruta-categorias-put"></a>

## Editar Categoria (PUT)
```javascript
    http://localhost/WEB2/TPE/api/category/:ID // METODO PUT
    // devolverá como resultado la categoría editada
    // CONTENIDO BODY
    {
        "category": "testModifyAPI"
    }
```
<a name="ruta-categorias-post"></a>

## Agregar Categoria (POST)
```javascript
    http://localhost/WEB2/TPE/api/category // METODO POST
    // devolverá como resultado la categoría agregada
    // CONTENIDO BODY
    {
        "category": "testAPIPOSTCategory"
    }
```

<a name="ruta-comentarios"></a>

# RUTAS API - COMENTARIOS

<a name="ruta-comentarios-get"></a>

## Obtener Comentarios (GET)
```javascript
    http://localhost/WEB2/TPE/api/comments
    // devolverá como resultado un listado con todos los comentarios
    /api/comments/:ID
    // devolverá como resultado un listado con todos los comentarios de X producto
    // puede probarse con:
    /api/comments/29

    /api/comments?product=29
    // devolverá un listado de todos los comentarios hechos al producto con id n°29
    //puede cambiarse por la id de cualquier otro producto disponible

```
<a name="ruta-comentarios-delete"></a>

## Borrar Comentario (DELETE)

```javascript
   http://localhost/WEB2/TPE/api/comments/:ID
   // devolverá como resultado el comentario eliminado
   // puede probarse con:
    /api/comments/4 //mientras la id 4 exista
```
<a name="ruta-comentarios-put"></a>

## Editar Comentarios (PUT)
```javascript
    http://localhost/WEB2/TPE/api/comments/:ID
    // devolverá como resultado el comentario editado
    // puede probarse con:
    /api/comments/4
    // CONTENIDO DE BODY
    {
        "comment": "EDIT via API",
        "rating": 10
    }   

```
<a name="ruta-comentarios-post"></a>

## Publicar Comentarios (POST)
```javascript
    http://localhost/WEB2/TPE/api/comments //METODO POST
    // CONTENIDO BODY
    {
        "comment": "comment via API",
        "rating": 5,
        "id_product_fk": 3
    }
    //Agregará un nuevo comentario al producto 3 (puede cambiarse por la id de cualquier otro producto)
    // El rating está fijo entre 0 y 10, si se intenta ingresar un valor que no se encuentre entre estos valores devolverá un error
```

<a name="endpoints-simples"></a>
# ENDPOINTS SIN URL
### Productos:
* `GET` `/api/products` 
* `GET` `/api/products/:ID` 
* `POST` `/api/products` 
* `PUT` `/api/products/:ID`
* `DELETE` `/api/products/:ID`
### Categorias
* `GET` `/api/category` 
* `GET` `/api/category/:ID`
* `POST` `/api/category` 
* `PUT` `/api/category/:ID`
* `DELETE` `/api/category/:ID`
### Comments
* `GET` `/api/comments` 
* `GET` `/api/comments/:ID`
* `POST` `/api/comments` 
* `PUT` `/api/comments/:ID`
* `DELETE` `/api/comments/:ID`

### <a href="#inicio"> Volver Arriba </a>
