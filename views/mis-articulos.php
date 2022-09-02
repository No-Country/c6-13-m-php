<?php 
if(!$_SESSION['loggedin']){
  $_SESSION['message'] = "<p class='mensajeError'>Por favor inicie sesión para poder agregar artículos.</p>";
  header('LOCATION: /c6-13-m-php/usuarios/?action=login');
  exit;
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock-AR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/small.css"'>
    <link rel="stylesheet" href='../css/medium.css'>
    <link rel="stylesheet" href='../css/large.css'>
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
        
        <main>
          <h1>Mis artículos</h1>
          <p>Aca podrás agregar los artículos que desees al stock de productos que tienes en tu vivienda</p>

          <?php
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
          } elseif (isset($message)) {
            echo $message;
          }
          ?>
          <form method="post" action="/c6-13-m-php/articulos/">
            <br>
            <label for="nombre_articulo">Nombre del artículo: 
              <input 
              type="text" 
              id="nombre_articulo" 
              name="nombre_articulo" 
              required 
              <?php if(isset($nombre_articulo)){echo "value='$nombre_articulo'";} ?> ></label>

            <?php echo $listaCategorias; if(isset($categoria)){echo "value='$categoria'";}  ?>
            
            <label for="unidad_medida">Unidad medida: 
              <select 
              type="text" 
              id="unidad_medida" 
              name="unidad_medida" 
              required>
                <option value="">Seleccionar</option>
                <option value="Kilos">Kilos</option>
                <option value="Cm3">Cm3</option>
                <option value="Litros">Litros</option>
                <option value="Onzas">Onzas</option>
                <option value="Gramos">Gramos</option>
              </select></label>

            <label for="cantidad_articulo">Cantidad: 
              <input 
              type="number"
              id="cantidad_articulo" 
              name="cantidad_articulo" 
              required 
              <?php if(isset($cantidad_articulo)){echo "value='$cantidad_articulo'";} ?> ></label>

            <label for="fecha_vencimiento">Fecha de vencimiento: 
              <input 
              type="date"
              id="fecha_vencimiento" 
              name="fecha_vencimiento" 
              <?php if(isset($fecha_vencimiento)){echo "value='$fecha_vencimiento'";}  ?> 
              required></label>

              <label for="estado">Estado: 
              <select 
              type="text" 
              id="estado" 
              name="estado" 
              required>
                <option value="">Seleccionar</option>
                <option value="en uso">En uso</option>
                <option value="disponible">Disponible</option>
                <option value="almacenado">Almacenado</option>
              </select></label>

            <input type="submit" name="submit" id="regbtn" value="Agregar Artículo">
            <input type="hidden" name="action" value="agregarArticulo">
            <input type="hidden" name="id_usuario" value='<?php if(isset($usuarioInfo['id_usuario'])){ echo $usuarioInfo['id_usuario'];}?>'>

          </form>
          <?php if(isset($mostrarArticulos)){
            echo $mostrarArticulos;
          } ?>


        </main>

        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']) ?>