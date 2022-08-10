<?php 

function conectar(){ // apertura funcion
    $hostname = "localhost";
    $username = "root";
    $password = " ";
    $dbname = "bd_compras";
    $dsn="mysql:host=$hostname;dbname=$dbname";
    $options=array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{

        $link = new PDO($dsn,$username,$password,$options);
        if(is_object($link)){
            echo "aceptado";
        }
        return $link;
    } catch (PDOException $e){

        echo"Error, no conectado: ". $e->getMessage();
        header('Location: /c6-m-php/views/500.php');
        exit; 
}

}//cierre funcion

?>