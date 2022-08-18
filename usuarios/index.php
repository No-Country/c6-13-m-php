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
require_once '../model/main-model.php';
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
        $nombrecliente = trim(filter_input(INPUT_POST, 'nombrecliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $apellidocliente = trim(filter_input(INPUT_POST, 'apellidocliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $fechanacimientocliente = trim(filter_input(INPUT_POST, 'fechanacimientocliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $emailcliente = trim(filter_input(INPUT_POST, 'emailcliente', FILTER_SANITIZE_EMAIL));
        $clavecliente = trim(filter_input(INPUT_POST, 'clavecliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $emailcliente = checkEmail($emailcliente);
        $clavecliente = checkPassword($clavecliente);
        //Variable to check for the return value from the function to check for unique emails
        $emailUnique = checkUniqueEmail($emailcliente);
        //Condtion to check if an existing email was returned
        if($emailUnique == 1){
            $message = "<p class='errorMsg'>El mail ya existe .</p>";
            include '../view/login.php';
            exit;

        }

        //Code block to check if the the user sent any empty form inputs
        if (empty($nombrecliente) || empty($apellidocliente) || empty($emailcliente) || empty($checkPassword)) {
            $message = "<p class='errorMsg'>Por favor, brinde los datos correctos.</p>";
            include '../views/registro.php';
            exit;
        }
        //Code to hash the password before sending it to the DB
        $hashedPassword = password_hash($clientPassword,PASSWORD_DEFAULT);

        $fechanacimiento_cliente = strtotime($fechanacimientocliente);

        //calls the function in the accounts-model and passes in values
        $regOutCome = regClient($nombrecliente,$apellidocliente,$fechanacimientocliente,$emailcliente,$hashedPassword);

        //checks if the right value was returend, and gives a congratulatory message
        //gives a failure message if not
        if ($regOutCome === 1) {
            //Set Cookie
            setcookie('firstname', $nombrecliente, strtotime('+ 1 year'), '/');
            $_SESSION['message'] = "<p class='successMsg'>Gracias por registrarse, $nombrecliente. Por favor, loguearse con email y contraseña.</p>";
            header('Location: /c6-13-m-php/usuarios/?action=Login');
            exit;
        }
        else{
            $message = "<p class='errorMsg'>Disculpe $nombrecliente. Fallo en el registro. Reintente.</p>";
            include '../views/registro.php';
            exit;
        }
        break;
    case 'login':
        $emailcliente = trim(filter_input(INPUT_POST, 'emailcliente', FILTER_SANITIZE_EMAIL));
        $clavecliente = trim(filter_input(INPUT_POST, 'clavecliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $emailcliente = checkEmail($emailcliente);
        $checkPassword = checkPassword($clavecliente);

        if ( empty($emailcliente) || empty($checkPassword)) {
            $message = "<p class='errorMsg'>Error. Coloque los datos correctamente</p>";
            include '../views/login.php';
            exit;
        }

        //Since a valid password exists, continue with the login process
        //call the getClient function to get the users details with a matching email address
        $UsuarioInfo = getUsuario($emailcliente);
        
        //check that the password matches with the hashed one from the DB
        $hashCheck = password_verify($clavecliente, $clientInfo['clientPassword']);
       
        if(!$hashCheck){
            $message = '<p class="errorMsg">Error en la clave. Reingresela correctamente.</p>';
            include '../views/login.php';
            exit;
        }
        //All the details are correct and the user info is valid
        $_SESSION['loggedin'] = TRUE;
        //Remove the password from the array, the function removes the last item in an array
        array_pop($clientInfo);
        //Store the array in a session
        $_SESSION['clientData'] = $clientInfo;
        //Send users to the admin.php page
        include '../views/perfil.php';
        exit;

        break;
    case 'logout':
        SESSION_UNSET();
        session_destroy();
        setcookie('firstname', $nombrecliente, strtotime('-1 Year'),'/');
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
        $clavecliente = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //Check for the password pattern to make sure it is a match
        $checkPassword = checkPassword($clavecliente);

        if (empty($checkPassword)) {
            $message = '<p class="errorMsg">Chequear la contraseña ingresada</p>';
            include '../views/modificar-perfil.php';
            exit;
        }
        //Hash the password to make sure it is secure
        $hashedPassword = password_hash($clavecliente,PASSWORD_DEFAULT);
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
    case 'updateClientInfo':
        //Get the user details and sanitize the values
        $nombrecliente = trim(filter_input(INPUT_POST, 'nombrecliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $apellidocliente = trim(filter_input(INPUT_POST, 'ape$apellidocliente', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $emailcliente = trim(filter_input(INPUT_POST, 'emailclie$emailcliente', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        //Check the email to ensure it is valid
        $emailcliente = checkEmail($emailcliente);
        //Get the current client Email address that is stored in the Session Variable
        $curEmail = $_SESSION['clientData']['emailclie$emailcliente'];

        //Code block to check if the the user sent any empty form inputs
        if (empty($nombrecliente) || empty($apellidocliente) || empty($emailcliente)){
            $message = "<p class='errorMsg'>Por favor, rellene con los datos solicitados.</p>";
            include '../views/modificar-perfil.php';
            exit;
        }
        elseif ($curEmail != $emailcliente){
            $emailUnique = checkUniqueEmail($emailcliente);
            if ($emailUnique == 1) {
                $message = "<p class='errorMsg'>Email no disponible, pruebe con otro</p>";
                include '../views/modificar-perfil.php';
                exit;
            }
        }
        //call the function in the model that inserts the update in the table
        $updateStatus = updateUsuarioInfo($clientId, $nombrecliente, $apellidocliente, $emailcliente);
        if ($updateStatus === 1) {
            $clientUpdate = getUsuarioUpdate($clientId);
            //Remove the password from the array, the function removes the last item in an array
            array_pop($clientUpdate);
            //Store the array in a session
            $_SESSION['clientData'] = $clientUpdate;
            $_SESSION['message'] = "<p class='successMsg'>$nombrecliente, su informacion fue actualizada correctamente.</p>";
            header("Location: /c6-13-m-php/usuarios/");
            exit;
        }
        else{
            $_SESSION['message'] = "<p class='errorMsg'>$nombrecliente, su informacion no fue actualizada. Reintente.</p>";
            header("Location: /c6-13-m-php/usuarios/");
            exit;
        }

        break;

    //The default case to deliver the admin view
    default:
    include '../view/admin.php';        
}
?>