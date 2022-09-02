<?php 
if(!$_SESSION['loggedin']){
  $_SESSION['message'] = "<p class='mensajeError'>Por favor inicie sesión para poder modificar un artículo.</p>";
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
          <h1>Borrar Articulo</h1>
          <p>Recuerda que ésta acción no se puede deshacer, ¿estás seguro que deseas borrar éste artículo?</p>

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
              readonly
              <?php if(isset($info_articulo['nombre_articulo'])){echo "value='$info_articulo[nombre_articulo]'";} ?> ></label>

            <?php echo $categoria_seleccionada;  ?>
            
            <label for="unidad_medida">Unidad medida: 
              <select 
              type="text" 
              id="unidad_medida" 
              name="unidad_medida"
              disabled
              required>
                <option value="">Seleccionar</option>
                <option  <?php if($info_articulo['unidad_medida'] == "Kilos") echo "selected='selected'"; ?> value="Kilos">Kilos</option>
                <option  <?php if($info_articulo['unidad_medida'] == "Cm3") echo "selected='selected'"; ?> value="Cm3">Cm3</option>
                <option  <?php if($info_articulo['unidad_medida'] == "Litros") echo "selected='selected'"; ?> value="Litros">Litros</option>
                <option  <?php if($info_articulo['unidad_medida'] == "Onzas") echo "selected='selected'"; ?> value="Onzas">Onzas</option>
                <option  <?php if($info_articulo['unidad_medida'] == "Gramos") echo "selected='selected'"; ?> value="Gramos">Gramos</option>
                
              </select></label>

            <label for="cantidad_articulo">Cantidad: 
              <input 
              type="number"
              id="cantidad_articulo" 
              name="cantidad_articulo" 
              required
              readonly
              <?php if(isset($info_articulo['cantidad_articulo'])){echo "value='$info_articulo[cantidad_articulo]'";} ?> ></label>

            <label for="fecha_vencimiento">Fecha de vencimiento: 
              <input 
              type="date"
              id="fecha_vencimiento" 
              name="fecha_vencimiento"
              readonly
              <?php if(isset($info_articulo['fecha_vencimiento'])){echo "value='$info_articulo[fecha_vencimiento]'";}  ?> 
              required></label>

              <label for="estado">Estado: 
              <select 
              type="text" 
              id="estado" 
              name="estado"
              disabled
              required>
                <option value="">Seleccionar</option>
                <option <?php if($info_articulo['estado'] == "en uso") echo "selected='selected'"; ?> value="en uso">En uso</option>
                <option <?php if($info_articulo['estado'] == "disponible") echo "selected='selected'"; ?> value="disponible">Disponible</option>
                <option <?php if($info_articulo['estado'] == "almacenado") echo "selected='selected'"; ?> value="almacenado">Almacenado</option>
              </select></label>

            <input type="submit" name="submit" id="regbtn" value="Borrar Artículo">
            <input type="hidden" name="action" value="borrarArticulo">
            <input type="hidden" name="id_articulo" value='<?php if(isset($info_articulo['id_articulo'])){ echo $info_articulo['id_articulo'];}?>'>

          </form>
          
        </main>

        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']) ?>