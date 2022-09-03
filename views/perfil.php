<?php 
if(!$_SESSION['loggedin']){
  header('LOCATION: /c6-13-m-php/');
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
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/small.css">
    <link rel="stylesheet" href='../css/medium.css'>
    <link rel="stylesheet" href='../css/large.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body class="container">
    
        <header>
          <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/header.php'; ?>
        </header> 
        <nav class="navbar navbar-expand-lg  mt-5">
          <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/nav-bar.php'; ?>
        </nav>
        <hr>
      <main>
      <h1><?php echo $_SESSION['usuarioInfo']['nombre_usuario'],' ', $_SESSION['usuarioInfo']['apellido_usuario'] ?></h1>
    <?php
    if (isset($_SESSION['message'])) {
      echo $_SESSION['message'];
    } elseif (isset($message)) {
      echo $message;
    }
    ?>
    <p class="admin-p">Usted está logueado!</p>
    <ul>
      <li>Nombre: <?php echo $_SESSION['usuarioInfo']['nombre_usuario'] ?></li>
      <li>Apellido: <?php echo $_SESSION['usuarioInfo']['apellido_usuario'] ?></li>
      <li>Email: <?php echo $_SESSION['usuarioInfo']['mail_usuario'] ?></li>
      <li>Fecha de nacimiento: <?php echo $_SESSION['usuarioInfo']['fecha_nacimiento'] ?></li>
    </ul>
    <h2>Manejo de cuenta</h2>
    <p class='admin-p'>Usa este link para editar la información de tu cuenta <a href='/c6-13-m-php/usuarios/?action=editarPerfil'>Actualizar Información de la cuenta</a></p>
    <?php 
    if(isset($_SESSION['usuarioInfo']['nivel_usuario'])){
      if($_SESSION['usuarioInfo']['nivel_usuario'] > 1){
        echo "<h2>Administrar Usuarios</h2>";
        echo "<p class='admin-p'>Clientes con el nivel Admin deben usar éste apartado para administrar las cuentas de usuario</p>";
        echo "<p class='admin-p'>Administrador de usuarios: <a href='/c6-13-m-php/usuarios/?action=infoUsuarios'>Información de los usuarios.</a></p>";}
    }
    ?>
          
      </main>
        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    
</body>
</html><?php unset($_SESSION['message']) ?>