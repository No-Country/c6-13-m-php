<?php 

//The articulos model

// agregarArtículo() function will handle adding new articules to the inventory
function agregarArticulo($nombre_articulo, $id_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $id_usuario, $estado, $fecha_ingreso){
  //create a connection object using the connection to the database
  $db = conectar();
  //The SQL statement
  $sql = 'INSERT INTO tbl_articulos (nombre_articulo, id_categoria, unidad_medida, cantidad_articulo, fecha_vencimiento, id_usuario, estado, fecha_ingreso)
  VALUES (:nombre_articulo, :id_categoria, :unidad_medida, :cantidad_articulo, :fecha_vencimiento, :id_usuario, :estado, :fecha_ingreso)';
  //Create the prepared statement using the database connection
  $stmt = $db->prepare($sql);
  //The next 8 lines replace the placeholders in the SQL statement
  //with the actual values in the variables
  //and tells the database the type of data it is
  $stmt->bindValue(':nombre_articulo', $nombre_articulo, PDO::PARAM_STR);
  $stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
  $stmt->bindValue(':unidad_medida', $unidad_medida, PDO::PARAM_STR);
  $stmt->bindValue(':cantidad_articulo', $cantidad_articulo, PDO::PARAM_INT);
  $stmt->bindValue(':fecha_vencimiento', $fecha_vencimiento, PDO::PARAM_STR);
  $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
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

function editarArticulo($nombre_articulo, $id_categoria, $unidad_medida, $cantidad_articulo, $fecha_vencimiento, $estado, $id_articulo){
  //create a connection object using the php motors connection
  $db = conectar();
  //the SQL statement
  $sql = 'UPDATE tbl_articulos SET nombre_articulo = :nombre_articulo, id_categoria = :id_categoria, unidad_medida = :unidad_medida,
  cantidad_articulo = :cantidad_articulo, fecha_vencimiento = :fecha_vencimiento, estado = :estado
  WHERE id_articulo = :id_articulo';
  //create the prepared statement using the php motors connection
  $stmt = $db->prepare($sql);
  //The next nine lines replace the placeholders in the SQL
  //statement with the actual values in the variables
  //and tells the database the type of data it is 
  $stmt->bindValue(':nombre_articulo', $nombre_articulo, PDO::PARAM_STR);
  $stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
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

function obtenerArticulosPorUsuario($id_usuario){
  $db = conectar();
  $sql = 'SELECT art.nombre_articulo, art.unidad_medida, art.cantidad_articulo,
  art.fecha_vencimiento, art.estado, art.id_articulo, cat.nombre_categoria
  FROM tbl_articulos as art
  LEFT JOIN tbl_categorias as cat ON art.id_categoria = cat.id_categoria
  WHERE id_usuario = :id_usuario';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();
  $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $articulos;
}

function obtenerCategorias(){
  $db = conectar();
  $sql = 'SELECT *
  FROM tbl_categorias ORDER BY id_categoria ASC';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $categorias;
}

function borrarArticulo($id_articulo){
  //create a connection object using the php motors connection
  $db = conectar();
  //the SQL statement
  $sql = 'DELETE FROM tbl_articulos WHERE id_articulo = :id_articulo';
  //create the prepared statement using the php motors connection
  $stmt = $db->prepare($sql);
  //The next nine lines replace the placeholders in the SQL
  //statement with the actual values in the variables
  //and tells the database the type of data it is 
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

function obtenerArticulosAlmPorUsuario($id_usuario){
  $db = conectar();
  $sql = 'SELECT art.nombre_articulo, art.unidad_medida, art.cantidad_articulo,
  art.fecha_vencimiento, art.estado, art.id_articulo, cat.nombre_categoria
  FROM tbl_articulos as art
  LEFT JOIN tbl_categorias as cat ON art.id_categoria = cat.id_categoria
  WHERE id_usuario = :id_usuario AND art.estado = "almacenado" 
  ORDER BY art.fecha_vencimiento';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
  $stmt->execute();
  $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $articulos;
}