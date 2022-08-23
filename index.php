<?php

// This is the main controller

// Create or acces a session
session_start();

// Get the database connection file
require_once 'libreria/conexion.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');

}

switch($action){


    default:
    include 'views/home.php';
    break;
    
}









