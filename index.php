<?php

session_start();

require_once 'libreria/conexion.php';

$action = filter_input(INPUT_POST,'action');
if($action==NULL){
    $action = filter_input(INPUT_GET,'action');
}

switch($action){

    default:
    include 'views/home.php';
    break;
    
}










?>