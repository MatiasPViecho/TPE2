# TPE WEB 2
**• [RUTAS API PRODUCTOS](#ruta-productos)**
    • [Rutas GET Productos](#ruta-productos)
    • [Rutas DELETE productos](#ruta-productos-delete)
    • [Rutas PUT productos](#ruta-productos-put) 
    • [Rutas POST productos](#ruta-productos-post)
**• [RUTAS API CATEGORIAS](#ruta-categorias)**
    • [Rutas GET Categorias](#ruta-categorias-get)
    • [Rutas DELETE Categorias](#ruta-categorias-delete)
    • [Rutas PUT Categorias](#ruta-categorias-put)
    • [Rutas POST Categorias](#ruta-categorias-post)
**• [RUTAS API COMENTARIOS](#ruta-comentarios)**
    • [Rutas POST Categorias](#ruta-comentarios-get)
    • [Rutas POST Categorias](#ruta-comentarios-delete)
    • [Rutas POST Categorias](#ruta-comentarios-put)
    • [Rutas POST Categorias](#ruta-comentarios-post)

<a name="ruta-productos"></a>

## RUTAS API - PRODUCTOS (GET)

```javascript

// get all productos
/api/products

// get producto por ID
/api/products/:ID

// get producto Ordenado
/api/products?sort=model&order=asc
/*
sort puede tener cualquier campo de la tabla "products"
order puede ser tanto asc como desc
*/

// get productos paginados
/api/productos?pag=0
// Solo acepta valores de paginado iguales o mayor a 0, el paginado va de a 10 productos

// get productos filtrados por campo
/api/products?country=Japon
/* 
Se puede filtrar por cualquier tipo de campo que tenga
    # model=X
    # brand=X
    # Por defecto se filtrará por ID 
*/
```
```javascript
// Estos pedidos se pueden combinar de cualquier manera que se quiera
/api/products?sort=price&order=desc&brand=canon&model=Mark&pag=0

// Esto traerá los que cumplan con el filtrado Brand = (contiene) canon, Model = (contiene) mark, ordenados por el precio de forma descendente, en la página 0
// Estos valores se pueden cambiar unos por otros, en caso de que no se asigne un valor de "sort" será "id" por defecto, al igual que "order" será "asc" por defecto
//Dará error si se coloca un tipo de filtrado que no pertenezca a la tabla, por ejemplo "precio=", ya que no existe el campo "precio"

```

# Rutas API - PRODUCTOS (POST, PUT, DELETE)

<a name="ruta-productos-delete"></a>

## Eliminar un producto (DELETE)
```javascript
    /api/products/:ID // METODO DELETE
```

<a name="ruta-productos-put"></a>

## Editar un producto (PUT)
```javascript
    /api/products/:ID // METODO PUT
    // JSON PARA PROBAR FUNCIONALIDAD, COLOCAR EN EL BODY
    {
        "model": "modeloPUT",
        "price": "pricePUT",
        "country": "countryPUTPostman",
        "brand": "brandPUTPostman",
        "characteristics": "charPUTPostman",
        "categoryFK": 1
    }   
```
<a name="ruta-productos-post"></a>

## Añadir un producto (POST)
```javascript
    /api/products // METODO POST
    // JSON PARA PROBAR FUNCIONALIDAD, COLOCAR EN EL BODY
    {
        "model": "modeloPOST",
        "price": "pricePOST",
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
/api/category

// devuelve una categoria específica a un ID
/api/category/:ID
```
<a name="ruta-categorias-delete"></a>

## Borrar Categoria (DELETE)
```javascript
    /api/category/:ID // METODO DELETE
    // devolverá como resultado la categoría eliminada
```
<a name="ruta-categorias-put"></a>

## Editar Categoria (PUT)
```javascript
    /api/category/:ID // METODO PUT
    // devolverá como resultado la categoría editada
    // CONTENIDO BODY
    {
        "category": "testModifyAPI"
    }
```
<a name="ruta-categorias-post"></a>

## Agregar Categoria (POST)
```javascript
    /api/category // METODO POST
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
    /api/comments
    // devolverá como resultado un listado con todos los comentarios
    /api/comments/:ID
    // devolverá como resultado un listado con todos los comentarios de X producto
    // puede probarse con:
    /api/comments/29

    /api/comments?product=29
    // devolverá un listado de todos los comentarios hechos al producto con id n°29, puede cambiarse por la id de cualquier otro producto disponible

```
<a name="ruta-comentarios-delete"></a>

## Borrar Comentario (DELETE)

```javascript
   /api/comments/:ID
   // devolverá como resultado el comentario eliminado
   // puede probarse con:
    /api/comments/4 //mientras la id 4 exista
```
<a name="ruta-comentarios-put"></a>

## Editar Comentarios (PUT)
```javascript
    /api/comments/:ID
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
    /api/comments //METODO POST
    // CONTENIDO BODY
    {
        "comment": "comment via API",
        "rating": 5,
        "id_product_fk": 3
    }
    //Agregará un nuevo comentario al producto 3 (puede cambiarse por la id de cualquier otro producto)
    // El rating está fijo entre 0 y 10, si se intenta ingresar un valor que no se encuentre entre estos valores devolverá un error
```