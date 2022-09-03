<?php
//This is the Articulos controller

//Create or acces a session
session_start();

//Get the database connection file
require_once '../libreria/conexion.php';
//Get the List model for use as needed
require_once '../model/modelo-articulo.php';
//Get the functions
require_once '../libreria/funciones.php';

//Obtener el array de categorias
$categorias = obtenerCategorias();
$listaCategorias = crearListadeCategorias($categorias);

//Filter the inputs
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

//Create switch statement and cases
switch ($action){
  
  case 'agregarArticulo':
    $nombre_articulo = trim(filter_input(INPUT_POST, 'nombre_articulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $id_categoria = trim(filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_NUMBER_INT));
    $unidad_medida = trim(filter_input(INPUT_POST, 'unidad_medida', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $cantidad_articulo = trim(filter_input(INPUT_POST, 'cantidad_articulo', FILTER_SANITIZE_NUMBER_INT));
    $fecha_vencimiento = trim(filter_input(INPUT_POST, 'fecha_vencimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));
    $estado = trim(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS, ));
    
    //Check if any input is empty
    if(empty($nombre_articulo) || empty($id_categoria) || empty($unidad_medida) || empty($cantidad_articulo) ||
    empty($fecha_vencimiento) || empty($id_usuario) || empty($estado)){
      $message = '<p class="error-message"> Por favor, complete todos los campos antes de agregar el producto </p>';
      include '../views/nuevo-articulo.php';
      exit;
    }

    //Create the actual date to keep track of every input
    $fecha_ingreso = date('Y-m-d');

    //Send the data to the model
    $addOutcome = agregarArticulo($nombre_articulo, $id_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $id_usuario, $estado, $fecha_ingreso);

    //Check and report the result
    if($addOutcome === 1){
      $_SESSION['message'] = "<p class='mensajeExito'>Artículo agregado con éxito!</p>";
      header('location: /c6-13-m-php/articulos/');
      exit;
    }
    
    break;

  case 'editarArt':

    //Store the id_articulo into a variable, filter and sanitized
    $id_articulo = filter_input(INPUT_GET, 'id_articulo', FILTER_VALIDATE_INT);
    //Use the id_articulo to get all the information for that articule and store it in to a variable
    $info_articulo = obtenerInfoArticulo($id_articulo);
    $categorias = obtenerCategorias();
    $categoria_seleccionada = categoriaSeleccionada($categorias, $info_articulo);
    //Check if there is any info for that ID
    if (count($info_articulo) < 1){
      $message = "<p class='error-message'> Lo sentimos, no existe información para éste artículo. Intenta nuevamente </p>";
      include '../views/mis-articulos.php';
    }
    include '../views/modificar-articulo.php';
    exit;
    break;

  case 'editarArticulo':
    $nombre_articulo = trim(filter_input(INPUT_POST, 'nombre_articulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $id_categoria = trim(filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_NUMBER_INT));
    $unidad_medida = trim(filter_input(INPUT_POST, 'unidad_medida', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $cantidad_articulo = trim(filter_input(INPUT_POST, 'cantidad_articulo', FILTER_SANITIZE_NUMBER_INT));
    $fecha_vencimiento = trim(filter_input(INPUT_POST, 'fecha_vencimiento', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $id_articulo = trim(filter_input(INPUT_POST, 'id_articulo', FILTER_SANITIZE_NUMBER_INT));
    $estado = trim(filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS, ));
    
    //Check if any input is empty
    if(empty($nombre_articulo) || empty($id_categoria) || empty($unidad_medida) || empty($cantidad_articulo) ||
    empty($fecha_vencimiento) || empty($id_articulo) || empty($estado)){
      $message = '<p class="error-message"> Por favor, complete todos los campos antes de editar el producto </p>';
      include '../views/nuevo-articulo.php';
      exit;
    }

    //Send the data to the model
    $addOutcome = editarArticulo($nombre_articulo, $id_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $estado, $id_articulo,);

    //Check and report the result
    if($addOutcome === 1){
      $_SESSION['message'] = "<p class='mensajeExito'>Artículo editado con éxito!</p>";
      header('location: /c6-13-m-php/articulos/');
      exit;
    }
    break;

    case 'borrarArt':
      //Store the id_articulo into a variable, filter and sanitized
      $id_articulo = filter_input(INPUT_GET, 'id_articulo', FILTER_VALIDATE_INT);
      //Use the id_articulo to get all the information for that articule and store it in to a variable
      $info_articulo = obtenerInfoArticulo($id_articulo);
      $categorias = obtenerCategorias();
      $categoria_seleccionada = categoriaSeleccionadafija($categorias, $info_articulo);
      //Check if there is any info for that ID
      if (count($info_articulo) < 1){
        $message = "<p class='error-message'> Lo sentimos, no existe información para éste artículo. Intenta nuevamente </p>";
        include '../views/mis-articulos.php';
      }
      include '../views/borrar-articulo.php';
      exit;
    break;

    case 'borrarArticulo':
      //Store the id_articulo into a variable, filter and sanitized
      $id_articulo = filter_input(INPUT_POST, 'id_articulo',  FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      //Send the data to the model
      $resultado = borrarArticulo($id_articulo);
      if($resultado === 1){
        $_SESSION['message'] = "<p class='mensajeExito'>Artículo borrado con éxito!</p>";
        header('location: /c6-13-m-php/articulos/');
        exit;
      } else {
        $_SESSION['message'] = "<p class='mensajeError'>El artículo no fue borrado, intente nuevamente</p>";
        header("location: /c6-13-m-php/articulos/?action=borrarArt&id_articulo=$id_articulo");
        exit;
      }
      break;

      case 'articulosAlmacenados':
        $usuarioInfo = $_SESSION['usuarioInfo'];
        $articulosAlmacenados = obtenerArticulosAlmPorUsuario($usuarioInfo['id_usuario']);
        $mostrarArticulos = mostrarArticulos($articulosAlmacenados);
        
        include '../views/mis-articulos-almacenados.php';
        exit;

        break;




  default:
    $usuarioInfo = $_SESSION['usuarioInfo'];
    $listaArticulos = obtenerArticulosPorUsuario($usuarioInfo['id_usuario']);
    $mostrarArticulos = mostrarArticulos($listaArticulos);
    include '../views/mis-articulos.php';
    break;
    
}