<?php
/*
*Proxy connection to the phpmotors database
*/
function conexion(){
  $hostname = 'localhost';
  $username = 'iClient';
  $password = '5]FD7CM6as.1bxPSda';
  $dbname = 'bd_compras';
  $dsn = "mysql:host=$hostname;dbname=$dbname";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  try{
    $link = new PDO($dsn, $username, $password, $options);
    // if(is_object($link)) {
    //   echo 'it worked!';
    // }
    return $link;
  } catch(PDOException $e) {
    // echo "Ups hubo un error: " . $e->getMessage();
    header('Location: /c6-13-m-php/views/500.php');
    exit;
  }
}
