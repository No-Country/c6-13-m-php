<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock-AR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/small.css">
    <link rel="stylesheet" href='./css/medium.css'>
    <link rel="stylesheet" href='./css/large.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <header>
          <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/header.php'; ?>
        </header> 
        <nav class="navbar navbar-expand-lg  mt-5">
          <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/nav-bar.php'; ?>
        </nav>
        <hr>
        <div class="row ">
            <div class="col-md-4 text-center">
                <h1 class="titulo-funciones">Crear Lista</h1>
                <p class="textseccion"  style="height:100px ;">En este apartado podremos crear un stock de los artículos que tenemos en casa se deplegara un formulario en el cual podras ingresar los pprductos que deseas agregar.</p>
                <div  class="img-seccion" id="img-crear-lista">
                  
                </div>
               <a class="btn btn-primary mt-3" href="/c6-13-m-php/articulos">Agregar productos al Stock</a>
            </div>
            <div class="col-md-4 text-center">
              <h1 class="titulo-funciones">Ultima Lista</h1>
              <p class="textseccion"  style="height:100px ;">En este apartado podremos ver la utima lista de compra que se creó.</p>
              <div class="clear-fix"></div>
              <div  class="img-seccion" id="img-ultima-lista">
                
              </div>
              <button class="btn btn-primary mt-3">ir a mis lista</button>
            </div>
            <div class="col-md-4 text-center">
              <h1 class="titulo-funciones">Productos almacenados</h1>
              <p class="textseccion"  style="height:100px ;">En esta seccion encontraras los productos que tienes almacenados y disponibles para utilizar</p>
              <div  class="img-seccion" id="img-almacen">
                
              </div>
              <a class="btn btn-primary mt-3" href="/c6-13-m-php/articulos/?action=articulosAlmacenados">Ir al almacenamiento</a>
            </div>
        </div>
        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    </div>
</body>
</html>