<?php 
if(!$_SESSION['loggedin']){
  header('LOCATION: /phpmotors/');
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
    <p class="admin-p">Usted se logueó correctamente!</p>
    <ul>
      <li>Nombre: <?php echo $_SESSION['usuarioInfo']['nombre_usuario'] ?></li>
      <li>Apellido: <?php echo $_SESSION['usuarioInfo']['apellido_usuario'] ?></li>
      <li>Email: <?php echo $_SESSION['usuarioInfo']['mail_usuario'] ?></li>
      <li>Fecha de nacimiento: <?php echo $_SESSION['usuarioInfo']['fecha_nacimiento'] ?></li>
    </ul>
    <h2>Manejo de cuenta</h2>
    <p class='admin-p'>Usa este link para editar la información de tu cuenta <a href='/c6-13-m-php/usuarios/?action=editarPerfil'>Actualizar Información de la cuenta</a></p>
    <?php 
    if($_SESSION['usuarioInfo']['clientLevel'] >1){
      echo "<h2>Vehicles Management</h2>";
      echo "<p class='admin-p'>Administrative clients must use this link to administer inventory</p>";
      echo "<p class='admin-p'>vehicle controller: <a href='/phpmotors/vehicles'>Vehicle Management</a></p>";
    }
    ?>
    <!-- <?php
    if(isset($_SESSION['reviewsData'])){
      $reviewsData = $_SESSION['reviewsData'];
      echo "<h2>Manage your product reviews</h2>";
      if(empty($reviewsData)){
        echo "<p class='admin-p'>You have no reviews for the moment, go and make some!</p>";
      } else {
        echo "<ul>";
        foreach($reviewsData as $data){
          $date = date('j F, Y', strtotime($data['reviewDate']));
          echo "<li>$data[invMake] $data[invModel] (Reviewed on $date): ";
          echo "<a href='/phpmotors/reviews/?action=editReview&reviewId=$data[reviewId]' title='Click here to edit the Review'>Edit</a>";
          echo " | ";
          echo "<a href='/phpmotors/reviews/?action=delReview&reviewId=$data[reviewId]' title='Click here to delete the Review'>Delete</a>";
          echo "</li>";
          
        }
        echo "</ul>";
      }
    }
    ?> -->




      
      </main>
        <hr>
            <footer class="mt-3 row ">
              <?php require_once $_SERVER['DOCUMENT_ROOT'].'/c6-13-m-php/auxiliares/footer.php'; ?>
            </footer>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</html>