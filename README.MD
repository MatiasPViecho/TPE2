<a name="inicio"></a>
# TPE WEB 2

Este proyecto trata una base de datos de una pagina de venta de productos cinematográficos ficticia, tiene las tablas products (productos), categories (categorias), 
y comments (comentarios)


<details align="center">
<summary><b>Composición de tabla products</b> (Con ejemplo)</summary>
<table align="center">
  <thead>
     <th>id</th>
     <th>model</th>
     <th>price</th>
     <th>country</th>
     <th>brand</th>
     <th>techChar</th>
     <th>id_categories_fk</th>
   </thead>
   <tbody>
     <td>31</td>
     <td>Tascam Portacapture X8</td>
     <td>225734</td>
     <td>Australia</td>
     <td>TASCAM</td>
     <td>4 Entradas de micrófono XLR ...</td>
     <td>12</td>
   </tbody>
 </table>
</details>

<details align="center">
  <summary><b>Composición de tabla categories</b> (Con ejemplo)</summary>
  <table align="center">
      <thead>
         <th>id</th>
         <th>category</th>
       </thead>
       <tbody>
         <td>2</td>
         <td>Tripodes</td>
       </tbody>
   </table>
</details>

<details align="center">
<summary><b>Composición de tabla comments</b> (Con ejemplo)</summary>
<table align="center">
  <thead>
     <th>id</th>
     <th>comment</th>
     <th>rating</th>
     <th>id_product_fk</th>
   </thead>
   <tbody>
     <td>4</td>
     <td>EDIT via API</td>
     <td>10</td>
     <td>3</td>
   </tbody>
 </table>
</details>

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
<a name="valores-sort"></a>
<details>
  <summary>Valores permitidos para SORT </summary>
    <ul>
      <li>id <b>(DEFAULT)</b></li>
      <li>model</li>
      <li>price</li>
      <li>country</li>
      <li>brand</li>
      <li>techChar</li>
      <li>id_categories_fk</li>
    </ul>
</details>
<a name="valores-order"></a>
<details>
  <summary>Valores permitidos para ORDER </summary>
    <ul>
      <li>asc <b>(DEFAULT)</b></li>
      <li>desc</li>
    </ul>
</details>
<a name="valores-filter"></a>
<details>
  <summary>Valores permitidos para FILTROS</summary>
    <ul>
      <li>id</li>
      <li>model</li>
      <li>price</li>
      <li>country</li>
      <li>brand</li>
      <li>techChar</li>
      <li>id_categories_fk</li>
    </ul>
</details>

**Get all productos**
>  `http://localhost/WEB2/TPE/api/products`
>
> Devuelve una lista con todos los productos en la tabla Products de la base de datos

**Get producto por ID**
>  `http://localhost/WEB2/TPE/api/products/:ID`
>
> Devuelve una lista con el producto que cumpla con el id requerido (Caso contrario devolverá 404)

**Get producto Ordenado**
>  `http://localhost/WEB2/TPE/api/products?sort=model&order=asc`
>
> Devuelve una lista ordenada, _ver [valores permitidos sort](#valores-sort) y [valores permitidos order](#valores-order)_
>

**Get productos paginados**
>  `http://localhost/WEB2/TPE/api/productos?pag=0`
> 
> Solo acepta valores de paginado iguales o mayor a 0, el paginado va de a 10 productos

**Get productos filtrados por campo**
>`http://localhost/WEB2/TPE/api/products?country=Japon`
> 
> Se puede filtrar por cualquier tipo de campo que tenga _ver [valores permitidos filtros](#valores-filter)_
>
> Devuelve una lista con los productos conseguidos


Estos pedidos se pueden combinar de cualquier manera que se quiera

`http://localhost/WEB2/TPE/api/products?sort=price&order=desc&brand=canon&model=Mark&pag=0`

> En el caso mostrado, se traeran los productos que cumplan con lo siguiente:
>
> ✅ "brand" contiene _"canon"_
>
> ✅ "model" contiene _"Mark"_
>
> Se ordenaran por precio de forma descendente 
>
> Solo mostrará los primeros 10 productos (_página 0_)

# Rutas API - PRODUCTOS (POST, PUT, DELETE)

<a name="ruta-productos-delete"></a>

## Eliminar un producto (DELETE)
`http://localhost/WEB2/TPE/api/products/:ID`
`METODO DELETE`
>
> Elimina el producto específico a esa ID, caso de error devolverá 404, no existe el producto a eliminar

<a name="ruta-productos-put"></a>

## Editar un producto (PUT)

`http://localhost/WEB2/TPE/api/products/:ID`
`METODO PUT`
>
> Se envia nueva información via body para cambiar la información del producto en (**:ID**)
>
>JSON PARA PROBAR FUNCIONALIDAD, COLOCAR EN EL BODY
```json
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
`http://localhost/WEB2/TPE/api/products`
`METODO POST`
>
> Se crea una nueva fila con los campos enviados a través del body (omitiendo id)
>
> JSON PARA PROBAR FUNCIONALIDAD, COLOCAR EN EL BODY
```json

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

**devuelve todas las categorias**

`http://localhost/WEB2/TPE/api/category`

**devuelve una categoria específica a un ID**

`http://localhost/WEB2/TPE/api/category/:ID`

<a name="ruta-categorias-delete"></a>

## Borrar Categoria (DELETE)

**Borrar Categoria (por ID)**

`http://localhost/WEB2/TPE/api/category/:ID`

`METODO DELETE`
>
>devolverá como resultado la categoría eliminada
>

<a name="ruta-categorias-put"></a>

## Editar Categoria (PUT)

**Edición de categoría (por ID)**

`http://localhost/WEB2/TPE/api/category/:ID`

`METODO PUT`

>
> Se pasa la información a editar a través del body
>
> Devolverá como resultado la categoría editada
>
>CONTENIDO BODY
```json
    {
        "category": "testModifyAPI"
    }
```
<a name="ruta-categorias-post"></a>

## Agregar Categoria (POST)

**Agregar una nueva categoría**

`http://localhost/WEB2/TPE/api/category`

`METODO POST`

>
> Se pasa la categoría a agregar (la información) a través del body
>
> Devolverá como resultado la categoría agregada
>
>CONTENIDO BODY
```json
    {
        "category": "testAPIPOSTCategory"
    }
```

<a name="ruta-comentarios"></a>

# RUTAS API - COMENTARIOS

<a name="ruta-comentarios-get"></a>

## Obtener Comentarios (GET)

**Obtener listado de comentarios**

`http://localhost/WEB2/TPE/api/comments`

>devolverá como resultado un listado con todos los comentarios

**Obtener un comentario determinado (por ID)**

`http://localhost/WEB2/TPE/api/comments/:ID`

>devolverá como resultado un listado con todos los comentarios de X producto
>
>puede probarse con:
> `http://localhost/WEB2/TPE/api/comments/29`

`http://localhost/WEB2/TPE/api/comments?product=29`
>
> Devolverá un listado de todos los comentarios hechos al producto con id n°29
>
> Puede cambiarse por la id de cualquier otro producto disponible
>

<a name="ruta-comentarios-delete"></a>

## Borrar Comentario (DELETE)

**Borrar un comentario determinado (por ID)**

`http://localhost/WEB2/TPE/api/comments/:ID`

>
>devolverá como resultado el comentario eliminado
>
>puede probarse con:
>
>`http://localhost/WEB2/TPE/api/comments/4` 
>
>_mientras la id 4 exista_


<a name="ruta-comentarios-put"></a>

## Editar Comentarios (PUT)

**Editar un comentario determinado (por ID)**

`http://localhost/WEB2/TPE/api/comments/:ID`

`METODO PUT`

>  
> Se obtiene (y envia) la nueva información a contener por el comentario a través del body
>
>devolverá como resultado el comentario editado, no se puede editar a qué producto señala ya que no tendría mucho sentido
>
>puede probarse con:
>
>`http://localhost/WEB2/TPE/api/comments/4`
>
>CONTENIDO DE BODY
```json
    {
        "comment": "EDIT via API",
        "rating": 10
    }   
```
<a name="ruta-comentarios-post"></a>

## Publicar Comentarios (POST)

**Publicación de un comentario**

    `http://localhost/WEB2/TPE/api/comments`
    
    `METODO POST`
>
> Se agrega el comentario enviando la información necesaria por el body 
>
> El rating solo puede estar entre 0 y 10, caso contrario devolverá error (400
>
> Se envia la información que contendrá el comentario por body
>
>CONTENIDO BODY
>
```json
    {
        "comment": "comment via API",
        "rating": 5,
        "id_product_fk": 3
    }
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
