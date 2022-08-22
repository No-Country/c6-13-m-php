<?php
//This is the Articulos controller

//Create or acces a session
session_start();

//Get the database connection file
require_once '../libreria/conexion.php';
//Get the List model for use as needed
require_once '../model/modelo-articulo.php';


//Filter the inputs
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

//Create switch statement and cases
switch ($action){
  case 'agregarArticulos':
    include '../views/nuevo-articulo.php';
    break;

  case 'agregarArticulo':
    $nombre_articulo = trim(filter_input(INPUT_POST, 'nombre_articulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $cod_categoria = trim(filter_input(INPUT_POST, 'cod_categoria', FILTER_SANITIZE_NUMBER_INT));
    $unidad_medida = trim(filter_input(INPUT_POST, 'unidad_medida', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $cantidad_articulo = trim(filter_input(INPUT_POST, 'cantidad_articulo', FILTER_SANITIZE_NUMBER_INT));
    $fecha_vencimiento = trim(filter_input(INPUT_POST, 'fecha_vencimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $cod_usuario = trim(filter_input(INPUT_POST, 'cod_usuario', FILTER_SANITIZE_NUMBER_INT));
    $estado = trim(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS, ));
    
    //Check if any input is empty
    if(empty($nombre_articulo) || empty($cod_categoria) || empty($unidad_medida) || empty($cantidad_articulo) ||
    empty($fecha_vencimiento) || empty($cod_usuario) || empty($estado)){
      $message = '<p class="error-message"> Por favor, complete todos los campos antes de agregar el producto </p>';
      include '../views/nuevo-articulo.php';
      exit;
    }

    //Create the actual date to keep track of every input
    $fecha_ingreso = date('d-m-y');

    //Send the data to the model
    $addOutcome = agregarArticulo($nombre_articulo, $cod_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $cod_usuario, $estado, $fecha_ingreso);

    //Check and report the result
    if($addOutcome === 1){
      $message = "<p class='succes-message'>Artículo agregado con éxito!</p>";
      include '../views/nuevo-articulo.php';
      exit;
    }
    break;

  case 'editarArt':
    //Store the id_articulo into a variable, filter and sanitized
    $id_articulo = filter_input(INPUT_GET, 'id_articulo', FILTER_VALIDATE_INT);
    //Use the id_articulo to get all the information for that articule and store it in to a variable
    $info_articulo = obtenerInfoArticulo($id_articulo);
    //Check if there is any info for that ID
    if (count($info_articulo) < 1){
      $message = "<p class='error-message'> Lo sentimos, no existe información para éste artículo. Intenta nuevamente </p>";
      include '../views/mis-articulos.php';
    }
    include '../views/modificar-articulo.php';
    exit;
    break;
    
}