<?php
//This is the List controller

//Create or acces a session
session_start();

//Get the database connection file
require_once '../libreria/conexion.php';
//Get the List model for use as needed
require_once '../model/modelo-listas.php';


//Filter the inputs
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

//Start the switch with the action cases
switch ($action){
  case 'nuevaLista':
    include '../views/nueva-lista.php';
    break;

  case 'agregarLista':
     

    break;

  case 'borrarLista':

    break;

  case 'editarLista':

    break;

  case 'modificarLista':

    break;

  default:

  exit;
}