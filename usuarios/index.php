<?php
//This is the "accounts" controller for the site. 
//It will not interfare with the main index.php file
//as they are stored in different folders
//********************************************
//Create or access a session.
session_start();
// Get the DB connection file
require_once '../libreria/conexion.php';
//Get the PHP main model for use when needed

//Get the accounts-model.php file
require_once '../model/modelo-usuario.php';
//Get custom function Library
require_once '../libreria/funciones.php';

/*

//Build the nav bar
$navList = createNavlist($classifications);  
//***********Test code pieces**************
// echo $navList;
// exit;

*/ 

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_POST, 'action');
}

//Switch statement to perform action depending on the name/value pair
switch ($action){
    //Case statement to accept information from the registration form on the registration view
    case 'register':
        //Variables to hold values coming from the registration form
        $nombre_usuario = trim(filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $apellido_usuario = trim(filter_input(INPUT_POST, 'apellido_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $fechanacimiento_usuario = trim(filter_input(INPUT_POST, 'fechanacimiento_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email_usuario = trim(filter_input(INPUT_POST, 'email_usuario', FILTER_SANITIZE_EMAIL));
        $clave_usuario = trim(filter_input(INPUT_POST, 'clave_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email_usuario = checkEmail($email_usuario);
        $clave_usuario = checkPassword($clave_usuario);
        //Variable to check for the return value from the function to check for unique emails
        $emailUnique = checkUniqueEmail($email_usuario);
        //Condtion to check if an existing email was returned
        if($emailUnique == 1){
            $message = "<p class='errorMsg'>El mail ya existe .</p>";
            include '../view/login.php';
            exit;

        }

        //Code block to check if the the user sent any empty form inputs
        if (empty($nombre_usuario) || empty($apellido_usuario) || empty($email_usuario) || empty($checkPassword)) {
            $message = "<p class='errorMsg'>Por favor, brinde los datos correctos.</p>";
            include '../views/registro.php';
            exit;
        }
        //Code to hash the password before sending it to the DB
        $hashedPassword = password_hash($clave_usuario,PASSWORD_DEFAULT);

        $fechanacimiento_usuario = strtotime($fechanacimiento_usuario);

        //calls the function in the accounts-model and passes in values
        $regOutCome = regUsuario($nombre_usuario,$apellido_usuario,$fechanacimiento_usuario,$email_usuario,$hashedPassword);

        //checks if the right value was returend, and gives a congratulatory message
        //gives a failure message if not
        if ($regOutCome === 1) {
            //Set Cookie
            setcookie('firstname', $nombre_usuario, strtotime('+ 1 year'), '/');
            $_SESSION['message'] = "<p class='successMsg'>Gracias por registrarse, $nombre_usuario. Por favor, loguearse con email y contraseña.</p>";
            header('Location: /c6-13-m-php/usuarios/?action=Login');
            exit;
        }
        else{
            $message = "<p class='errorMsg'>Disculpe $nombre_usuario. Fallo en el registro. Reintente.</p>";
            include '../views/registro.php';
            exit;
        }
        break;
    case 'login':
        $email_usuario = trim(filter_input(INPUT_POST, 'email_usuario', FILTER_SANITIZE_EMAIL));
        $clave_usuario = trim(filter_input(INPUT_POST, 'clave_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email_usuario = checkEmail($email_usuario);
        $checkPassword = checkPassword($clave_usuario);

        if ( empty($email_usuario) || empty($checkPassword)) {
            $message = "<p class='errorMsg'>Error. Coloque los datos correctamente</p>";
            include '../views/login.php';
            exit;
        }


        
        //Since a valid password exists, continue with the login process
        //call the getClient function to get the users details with a matching email address
        $UsuarioInfo = getUsuario($email_usuario);
        
        //check that the password matches with the hashed one from the DB
        $hashCheck = password_verify($clave_usuario, $UsuarioInfo['clave$clave_usuario']);
       
        if(!$hashCheck){
            $message = '<p class="errorMsg">Error en la clave. Reingresela correctamente.</p>';
            include '../views/login.php';
            exit;
        }
        //All the details are correct and the user info is valid
        $_SESSION['loggedin'] = TRUE;
        //Remove the password from the array, the function removes the last item in an array
        array_pop($UsuarioInfo);
        //Store the array in a session
        $_SESSION['UsuarioData'] = $UsuarioInfo;
        //Send users to the admin.php page
        include '../views/perfil.php';
        exit;

        break;
    case 'logout':
        SESSION_UNSET();
        session_destroy();
        setcookie('firstname', $nombre_usuario, strtotime('-1 Year'),'/');
        header("Location: /c6-13-m-php/");
        
        break;

    //Case Statement to deliver the login view when the "My Account" link is clicked
    case 'Login':
      include '../views/login.php';
        break;
    //Case Statement to deliver the registration view when the "Sign Up now" link is clicked
    case 'Registration':
        include '../views/registro.php';
        break;
    
    //Case to deliver the account update view to the user
    case 'accountUpdateView':
        include "../views/modificar-perfil.php";
        break;

    //Case to change the client's password
    case 'changePassword':
        //get the password input and sanitize it
        $clave_usuario = trim(filter_input(INPUT_POST, 'clave_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //Check for the password pattern to make sure it is a match
        $checkPassword = checkPassword($clave_usuario);

        if (empty($checkPassword)) {
            $message = '<p class="errorMsg">Chequear la contraseña ingresada</p>';
            include '../views/modificar-perfil.php';
            exit;
        }
        //Hash the password to make sure it is secure
        $hashedPassword = password_hash($clave_usuario,PASSWORD_DEFAULT);
        //Call the function that updates the clients table with the new password
        $passwordStatus = changePassword($clientId, $hashedPassword);
        if ($passwordStatus === 1) {
            $_SESSION['message'] = "<p class='successMsg'>Su clave fue ingresada correctamente</p>";
            header("Location: /c6-13-m-php/usuarios/");
            exit;
        }
        else {
            $_SESSION['message'] = "<p class='errorMsg'>Su clave no fue actualizada.</p>";
            header("Location: /c6-13-m-php/usuarios/");
            exit;
        }

    //Case to update user information
    case 'updateUsuarioInfo':
        //Get the user details and sanitize the values
        $nombre_usuario = trim(filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $apellido_usuario = trim(filter_input(INPUT_POST, 'apellido_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email_usuario = trim(filter_input(INPUT_POST, 'email_usuario', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //Check the email to ensure it is valid
        $email_usuario = checkEmail($email_usuario);
        //Get the current client Email address that is stored in the Session Variable
        $curEmail = $_SESSION['UsuarioData']['emailclie$email_usuario'];

        //Code block to check if the the user sent any empty form inputs
        if (empty($nombre_usuario) || empty($apellido_usuario) || empty($email_usuario)){
            $message = "<p class='errorMsg'>Por favor, rellene con los datos solicitados.</p>";
            include '../views/modificar-perfil.php';
            exit;
        }
        elseif ($curEmail != $email_usuario){
            $emailUnique = checkUniqueEmail($email_usuario);
            if ($emailUnique == 1) {
                $message = "<p class='errorMsg'>Email no disponible, pruebe con otro</p>";
                include '../views/modificar-perfil.php';
                exit;
            }
        }
        //call the function in the model that inserts the update in the table
        $updateStatus = updateUsuarioInfo($clientId, $nombre_usuario, $apellido_usuario, $email_usuario);
        if ($updateStatus === 1) {
            $clientUpdate = getUsuarioUpdate($clientId);
            //Remove the password from the array, the function removes the last item in an array
            array_pop($clientUpdate);
            //Store the array in a session
            $_SESSION['UsuarioData'] = $clientUpdate;
            $_SESSION['message'] = "<p class='successMsg'>$nombre_usuario, su informacion fue actualizada correctamente.</p>";
            header("Location: /c6-13-m-php/usuarios/");
            exit;
        }
        else{
            $_SESSION['message'] = "<p class='errorMsg'>$nombre_usuario, su informacion no fue actualizada. Reintente.</p>";
            header("Location: /c6-13-m-php/usuarios/");
            exit;
        }

        break;

    //The default case to deliver the admin view
    default:
    include '../view/admin.php';        
}
?>