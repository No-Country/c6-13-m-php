<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock-AR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
    <div class="container">
        <div class="row mt-3" id="encabezado-logo">
            <div class="col-md-4 col-xs-12 col-sm-12 text-center">
              <h4><i class="fa-solid fa-kitchen-set"></i></h4>
              <h3>Bienvenidos a Stock-AR</h3> 
            </div>
            <div class="col-md-4 off offset-md-4 col-xs-12 col-sm-12" id="inicio-sesion">
                <i class="fa fa-user" aria-hidden="true" id="logo-inicio-sesion"></i>
                <a href="#">  Iniciar Sesion</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12" id="banner-principal">
                
            </div>
        </div>
        <nav class="navbar navbar-expand-lg  mt-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" id="menu-reponsive">Menu</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav col-md-12">
                  <li class="nav-item col-md-3">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                  </li>
                  <li class="nav-item col-md-3">
                    <a class="nav-link" href="#">Agregar productos</a>
                  </li>
                  <li class="nav-item col-md-3">
                    <a class="nav-link" href="#">Mis listas</a>
                  </li>
                  <li class="nav-item col-md-3">
                    <a class="nav-link " href="#">Almacenamiento</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>
        <hr>
        <div class="row ">
            <div class="col-md-4 text-center">
                <h1 class="titulo-funciones">Crear Lista</h1>
                <p class="textseccion"  style="height:100px ;">En este apartado podremos crear las lista de compra se deplegara un formulario en el cual podras ingresar los porducos que deseas comprar.</p>
                <div  class="img-seccion" id="img-crear-lista">
                  
                </div>
                <button class="btn btn-primary mt-3">Crear lista</button>
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
              <button class="btn btn-primary mt-3">Ir al almacenamiento</button>
            </div>
        </div>
        <hr>
            <footer class="mt-3 row ">
              <div class="col-md-12 text-center">
               <p>@Copyright. c6-13-php</p> 
              </div>
            </footer>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</html>