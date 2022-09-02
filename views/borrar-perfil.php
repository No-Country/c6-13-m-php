<?php 
if(!$_SESSION['loggedin']){
  header('LOCATION: /c6-13-m-php/');
      exit;
} if($_SESSION['usuarioInfo']['nivel_usuario'] < 2){
  header('LOCATION: /c6-13-m-php/');
      exit;
}
if (isset($_SESSION['message'])){
  $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock-AR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/small.css">
    <link rel="stylesheet" href='../css/medium.css'>
    <link rel="stylesheet" href='../css/large.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400&family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">

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
        <h1>Borrar Perfil</h1>
        <p>Recuerde que ésta acción no puede deshacerse, está seguro de que desea borrar éste perfil?</p>
        <form method="post" action="/c6-13-m-php/usuarios/">
          
          <label class="top" for="fname"
            >Nombre <input <?php if(isset($usuarioInfo['nombre_usuario'])) {echo "value='$usuarioInfo[nombre_usuario]'";}?>
              type="text"
              id="fname"
              name="nombre_usuario"
              pattern="[a-zA-Z\s-]+"
              readonly
              required
          /></label>
          <label class="top" for="lname"
            >Apellido <input <?php if(isset($usuarioInfo['apellido_usuario'])) {echo "value='$usuarioInfo[apellido_usuario]'";}?>
              type="text"
              id="lname"
              name="apellido_usuario"
              pattern="[a-zA-Z\s-]+"
              readonly
              required
              ></label>
              <label for="fecha_nacimiento"
              >Fecha de nacimiento: <input <?php if(isset($usuarioInfo['fecha_nacimiento'])){echo "value='$usuarioInfo[fecha_nacimiento]'";}  ?> 
              type="date"
              id="fecha_nacimiento" 
              name="fecha_nacimiento"
              readonly
              required></label>
              <label for="fecha_creacion"
              >Fecha de creación: <input <?php if(isset($usuarioInfo['fecha_creacion'])){echo "value='$usuarioInfo[fecha_creacion]'";}  ?> 
              type="date"
              id="fecha_creacion" 
              name="fecha_creacion"
              readonly
              required></label>
          <label for="email" class="top"
          >Email
            <input <?php if(isset($usuarioInfo['mail_usuario'])) {echo "value='$usuarioInfo[mail_usuario]'";}?>
              id="email"
              type="email"
              name="mail_usuario"
              placeholder="usuario@email.com"
              required
              readonly
            ></label>
          
          <input type="submit" name="submit" value="Borrar Usuario" id="regbtn" class="submitBtn">
          <input type="hidden" name="action" value="updateUsuarioInfo">
          <input type="hidden" name="id_usuario" value='<?php if(isset($usuarioInfo['id_usuario'])){ echo $usuarioInfo['id_usuario'];}?>'>

        </form>
              
      </main>
        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    
</body>
</html><?php unset($_SESSION['message']) ?>