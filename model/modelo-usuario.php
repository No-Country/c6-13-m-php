<?php
//This is will be the ACCOUNTS Model

//en el modelo van las operaciones con la base de datos

//This new function will control site visitors registration
function regUsuario($nombre_usuario, $apellido_usuario, $fecha_nacimiento, $fecha_creacion, $mail_usuario, $clave_usuario){
    // Create a connection object using the phpmotors connection function
    $db = conectar(); //variable de conexion
    //The sql INSERT statement to register the user in the database
    $sql = 'INSERT INTO tbl_usuarios (nombre_usuario, apellido_usuario, fecha_nacimiento, fecha_creacion, mail_usuario, clave_usuario)
    VALUES (:nombre_usuario, :apellido_usuario, :fecha_nacimiento, :fecha_creacion, :mail_usuario, :clave_usuario)';
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The four lines replace the sql statement with the actual values in the variables
    //The also tell the database the type of data they are.
    $stmt->bindValue(':nombre_usuario',$nombre_usuario, PDO::PARAM_STR);
    $stmt->bindValue(':apellido_usuario',$apellido_usuario, PDO::PARAM_STR);
    $stmt->bindValue(':fecha_nacimiento',$fecha_nacimiento, PDO::PARAM_STR);
    $stmt->bindValue(':fecha_creacion',$fecha_creacion, PDO::PARAM_STR);
    $stmt->bindValue(':mail_usuario',$mail_usuario, PDO::PARAM_STR);
    $stmt->bindValue(':clave_usuario',$clave_usuario, PDO::PARAM_STR);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as result of the insert
    $rowsChanged = $stmt->rowCount();
    //closet the database interaction
    $stmt->closeCursor();
    //Return the indication of success(rows changed)
    return $rowsChanged;
}

//Function to check for unique email addresses to be stored in the client table
function checkUniqueEmail($mail_usuario){
    //Call the connection already made in the library
    $db = conectar();
    //sql to query the DB
    $sql = 'SELECT mail_usuario FROM tbl_usuarios WHERE mail_usuario = :mail_usuario';
    //A prepared statement to prepare the sql code
    $stmt = $db->prepare($sql);
    //Bind the real value to th eplac holder used
    $stmt->bindValue(':mail_usuario', $mail_usuario, PDO::PARAM_STR);
    //The next line executes the code in the DB
    $stmt->execute();
    //The next line fetches the row of data that matches the email address if any
    $emailMatch = $stmt->fetch(PDO::FETCH_NUM);
    //Close the connection with the server and DB
    $stmt->closeCursor();
    //If statement to determine what to return to the controller
    if(empty($emailMatch)){
        return 0;
    }
    else{
        return 1;      
    }
}

//function to get client info
function getUsuario($mail_usuario){
    //Gets the connection to the sever and DB
    $db = conectar();
    //SQL to get the user info mation from the DB
    $sql = 'SELECT id_usuario, nivel_usuario, nombre_usuario, apellido_usuario, fecha_nacimiento, fecha_creacion, mail_usuario, clave_usuario
    FROM tbl_usuarios
    WHERE mail_usuario = :mail_usuario';
    //code to prepare the sql statement
    $stmt = $db->prepare($sql);
    //bind the placeholder to the passed in variable
    $stmt->bindValue(':mail_usuario',$mail_usuario,PDO::PARAM_STR);
    //Execute the code
    $stmt->execute();
    //fetch the user detail with the the table column name as the associative name value pair
    $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $clientInfo;
}
//function to change client password
function changePassword ($clave_usuario, $id_usuario) {
            // Create a connection object using the phpmotors coonection function
        $db = conectar();
        //The sql INSERT statement to update the client password in the clients table
        $sql = 'UPDATE tbl_usuarios
                SET clave_usuario = :clave_usuario
                WHERE id_usuario = :id_usuario';
        // create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        //The next lines replace the sql placeholders with the actual values in the variables
        //The also tell the database the type of data they are.
        $stmt->bindValue(':clave_usuario',$clave_usuario, PDO::PARAM_STR);
        $stmt->bindValue(':id_usuario',$id_usuario, PDO::PARAM_INT);
        //Insert the data
        $stmt->execute();
        //Ask how many rows changed as result of the insert
        $rowsChanged = $stmt->rowCount();
        //close the database interaction
        $stmt->closeCursor();
        //Return the indication of success(rows changed)
        return $rowsChanged;
}

//function to update the client information
function updateUsuarioInfo($id_usuario, $nombre_usuario, $apellido_usuario, $fecha_nacimiento, $mail_usuario) {
    // Create a connection object using the phpmotors coonection function
    $db = conectar();
    //The sql INSERT statement to update the user info in the users table
    $sql = 'UPDATE tbl_usuarios
            SET nombre_usuario = :nombre_usuario, apellido_usuario = :apellido_usuario, fecha_nacimiento = :fecha_nacimiento, mail_usuario = :mail_usuario
            WHERE id_usuario = :id_usuario';
    // create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next lines replace the sql placeholders with the actual values in the variables
    //The also tell the database the type of data they are.
    $stmt->bindValue(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
    $stmt->bindValue(':apellido_usuario', $apellido_usuario, PDO::PARAM_STR);
    $stmt->bindValue(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
    $stmt->bindValue(':mail_usuario', $mail_usuario, PDO::PARAM_STR);
    $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
    //Insert the data
    $stmt->execute();
    //Ask how many rows changed as result of the insert
    $rowsChanged = $stmt->rowCount();
    //close the database interaction
    $stmt->closeCursor();
    //Return the indication of success(rows changed)
    return $rowsChanged;
}

function getUsuarioUpdate($id_usuario){
    //Gets the connection to the sever and DB
    $db = conectar();
    //SQL to get the updated user infomation from the DB
    $sql = 'SELECT id_usuario, nombre_usuario, apellido_usuario, fecha_nacimiento, fecha_creacion, mail_usuario, clave_usuario
            FROM tbl_usuarios
            WHERE id_usuario = :id_usuario';
    //code to prepare the sql statement
    $stmt = $db->prepare($sql);
    //bind the placeholder to the passed in variable
    $stmt->bindValue(':id_usuario',$id_usuario,PDO::PARAM_STR);
    //Execute the code
    $stmt->execute();
    //fetch the user detail with the the table column name as the associative name value pair
    $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientInfo;
}

function obtenerinfoUsuarios(){
    //Gets the connection to the sever and DB
    $db = conectar();
    //SQL to get the updated user infomation from the DB
    $sql = 'SELECT *
            FROM tbl_usuarios
            WHERE nivel_usuario = 1';
    //code to prepare the sql statement
    $stmt = $db->prepare($sql);
    //Execute the code
    $stmt->execute();
    //fetch the user detail with the the table column name as the associative name value pair
    $infoUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $infoUsuarios;
}

function obtenerUsuario($id_usuario){
    //Gets the connection to the sever and DB
    $db = conectar();
    //SQL to get the user info mation from the DB
    $sql = 'SELECT nombre_usuario, apellido_usuario, fecha_nacimiento, fecha_creacion, mail_usuario
    FROM tbl_usuarios
    WHERE id_usuario = :id_usuario';
    //code to prepare the sql statement
    $stmt = $db->prepare($sql);
    //bind the placeholder to the passed in variable
    $stmt->bindValue(':id_usuario',$id_usuario,PDO::PARAM_STR);
    //Execute the code
    $stmt->execute();
    //fetch the user detail with the the table column name as the associative name value pair
    $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt->closeCursor();

    return $clientInfo;
}
