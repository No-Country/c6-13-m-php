<?php 

//The articulos model

// agregarArtículo() function will handle adding new articules to the inventory
function agregarArticulo($nombre_articulo, $cod_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $cod_usuario, $estado, $fecha_ingreso){
  //create a connection object using the connection to the database
  $db = conectar();
  //The SQL statement
  $sql = 'INSERT INTO tbl_articulos (nombre_articulo, cod_categoria, unidad_medida, cantidad_articulo, fecha_vencimiento, cod_usuario, estado, fecha_ingreso)
  VALUES (:nombre_articulo, :cod_categoria, :unidad_medida, :cantidad_articulo, :fecha_vencimiento, :cod_usuario, :estado, :fecha_ingreso)';
  //Create the prepared statement using the database connection
  $stmt = $db->prepare($sql);
  //The next 8 lines replace the placeholders in the SQL statement
  //with the actual values in the variables
  //and tells the database the type of data it is
  $stmt->bindValue(':nombre_articulo', $nombre_articulo, PDO::PARAM_STR);
  $stmt->bindValue(':cod_categoria', $cod_categoria, PDO::PARAM_INT);
  $stmt->bindValue(':unidad_medida', $unidad_medida, PDO::PARAM_STR);
  $stmt->bindValue(':cantidad_articulo', $cantidad_articulo, PDO::PARAM_INT);
  $stmt->bindValue(':fecha_vencimiento', $fecha_vencimiento, PDO::PARAM_STR);
  $stmt->bindValue(':cod_usuario', $cod_usuario, PDO::PARAM_INT);
  $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
  $stmt->bindValue(':fecha_ingreso', $fecha_ingreso, PDO::PARAM_STR);

  //Insert the data 
  $stmt->execute();
  //ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  //Close the database interaction
  $stmt->closeCursor();
  //Return the indication of succes (rows changed)
  return $rowsChanged;
}

function obtenerInfoArticulo($id_articulo){
  //create a connection object using the connection to the database
  $db = conectar();
  //The SQL statement
  $sql = 'SELECT * FROM tbl_articulos WHERE id_articulo = :id_articulo';
  //Create the prepared statement using the database connection
  $stmt = $db->prepare($sql);
  //The next line replace the placeholder in the SQL statement
  //with the actual value in the variable
  //and tells the database the type of data it is
  $stmt->bindValue(':id_articulo', $id_articulo, PDO::PARAM_INT);
  //Insert the data 
  $stmt->execute();
  //ask how many rows changed as a result of our insert
  $info_articulo = $stmt->fetch(PDO::FETCH_ASSOC);
  //Close the database interaction
  $stmt->closeCursor();
  //Return the indication of succes (rows changed)
  return $info_articulo;
}

function editarArticulo($nombre_articulo, $cod_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $estado, $id_articulo){
  //create a connection object using the php motors connection
  $db = conectar();
  //the SQL statement
  $sql = 'UPDATE tbl_articulos SET nombre_articulo = :nombre_articulo, cod_categoria = :cod_categoria, unidad_medida = :unidad_medida,
  cantidad_articulo = :cantidad_articulo, fecha_vencimiento = :fecha_vencimiento, estado = :estado
  WHERE id_articulo = :id_articulo';
  //create the prepared statement using the php motors connection
  $stmt = $db->prepare($sql);
  //The next nine lines replace the placeholders in the SQL
  //statement with the actual values in the variables
  //and tells the database the type of data it is 
  $stmt->bindValue(':nombre_articulo', $nombre_articulo, PDO::PARAM_STR);
  $stmt->bindValue(':cod_categoria', $cod_categoria, PDO::PARAM_INT);
  $stmt->bindValue(':unidad_medida', $unidad_medida, PDO::PARAM_STR);
  $stmt->bindValue(':cantidad_articulo', $cantidad_articulo, PDO::PARAM_INT);
  $stmt->bindValue(':fecha_vencimiento', $fecha_vencimiento, PDO::PARAM_STR);
  $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
  $stmt->bindValue(':id_articulo', $id_articulo, PDO::PARAM_INT);
  //insert the data
  $stmt->execute();
  //ask how maany rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  //close the database interaction
  $stmt->closeCursor();
  //return the indication of succes (rows changed)
  return $rowsChanged;
}

function obtenerArticuloPorUsuario($cod_usuario){
  $db = conectar();
  $sql = 'SELECT *
  FROM tbl_articulos
  WHERE cod_usuario = :cod_usuario';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':cod_usuario', $cod_usuario, PDO::PARAM_INT);
  $stmt->execute();
  $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $articulos;
}