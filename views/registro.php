<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarme</title>
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
      <h1>Register</h1>
    <?php
    if (isset($message)) {
      echo $message;
    }
    ?>
    <form method="post" action="/c6-13-m-php/usuarios/">
      <label class="top" for="nombre"
        >Nombre <input <?php if(isset($nombre_usuario)){echo "value='$nombre_usuario'";}  ?>
          type="text"
          id="nombre"
          name="nombre_usuario"
          pattern="[a-zA-Z\s-]+"
          required
      /></label>
      <label class="top" for="lname"
        >Apellido <input <?php if(isset($apellido_usuario)){echo "value='$apellido_usuario'";}  ?>
          type="text"
          id="lname"
          name="apellido_usuario"
          pattern="[a-zA-Z\s-]+"
          required
          ></label>
      <label for="fecha_nacimiento">Fecha de nacimiento: 
          <input 
          type="date"
          id="fecha_nacimiento" 
          name="fecha_nacimiento" 
          <?php if(isset($fecha_nacimiento)){echo "value='$fecha_nacimiento'";}  ?> 
          required></label>
      <label for="mail" class="top"
      >mail
        <input <?php if(isset($mail_usuario)){echo "value='$mail_usuario'";}  ?>
          id="mail"
          type="email"
          name="mail_usuario"
          placeholder="you@mail.com"
          required
        ></label>
      <label for="clave_usuario" class="top">Contrase??a 
        <input 
        id="clave_usuario" 
        type="password" 
        pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
        name="clave_usuario" 
        required></label>
        <span>La contrase??a debe tener al menos 8 caracteres y contener al menos 1 n??mero, 1 may??scula y un simbolo especial.</span>
      <input type="submit" name="submit" value="Register" id="regbtn" class="submitBtn">
      <input type="hidden" name="action" value="registro">

    </form>
    <p>Todos los campos son requeridos</p>



      
      </main>
        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    
</body>
</html>