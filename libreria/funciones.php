<?php  
//Function to make sure that the inputed email follows the right format.
function checkEmail($emailcliente){
    $valEmail = filter_var($emailcliente, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

//function to make sure that the password meets the specified pattern
function checkPassword($clave_usuario){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clave_usuario);
}

function crearListadeCategorias($categorias){
    $listaCategorias = '<label for="listaCategorias">Elige una categoria: <select name="id_categoria" id="listaCategorias">';
    $listaCategorias .= "<option>Categoria</option>";
    foreach ($categorias as $categoria) {
      $listaCategorias .= "<option value='$categoria[id_categoria]'>$categoria[nombre_categoria]</option>";
    }
    $listaCategorias .= '</select></label>';
    return $listaCategorias;
  }

function mostrarArticulos($listaArticulos){
    $dataTable = '<thead>';
    $dataTable .= '<tr><th>Articulo</th><td>Categoria</td><td>Unidad Medida</td><td>Cantidad</td><td>Vencimiento</td><td>Estado</td><td>Editar</td><td>Borrar</td></tr>';
    $dataTable .= '</thead><br>';
    //set up the table body
    $dataTable .= '<tbody>';
    //iterate over all vehicles in the array and put each in a row
    forEach($listaArticulos as $articulo){
        $dataTable .= "<tr><td>$articulo[nombre_articulo]</td>";
        $dataTable .= "<td>$articulo[nombre_categoria]</td>";
        $dataTable .= "<td>$articulo[unidad_medida]</td>";
        $dataTable .= "<td>$articulo[cantidad_articulo]</td>";
        $dataTable .= "<td>$articulo[fecha_vencimiento]</td>";
        $dataTable .= "<td>$articulo[estado]</td>";
        $dataTable .= "<td><a href='?action=editarArt&id_articulo=$articulo[id_articulo]' title='Click aquí para editar el articulo'>Editar</a></td>";
        $dataTable .= "<td><a href='?action=borrarArt&id_articulo=$articulo[id_articulo]' title='Click aquí para borrar el articulo'>Borrar</a></td></tr>";
    }
    $dataTable .= '</tbody>';
    return $dataTable;
}
function categoriaSeleccionada($categorias, $info_articulo){
    $listaCategorias = '<label for="listaCategorias">Elige una categoria: <select name="id_categoria" id="listaCategorias">';
    $listaCategorias .= "<option>Categoria</option>";
    foreach ($categorias as $categoria) {
      $listaCategorias .= "<option";
        if($categoria['id_categoria'] == $info_articulo['id_categoria']){
            $listaCategorias .= " selected='selected' ";
        }
      $listaCategorias .= "value='$categoria[id_categoria]'>$categoria[nombre_categoria]</option>";
    }
    $listaCategorias .= '</select></label>';
    return $listaCategorias;
  }

function categoriaSeleccionadafija($categorias, $info_articulo){
$listaCategorias = '<label for="listaCategorias">Elige una categoria: <select disabled name="id_categoria" id="listaCategorias">';
$listaCategorias .= "<option>Categoria</option>";
foreach ($categorias as $categoria) {
    $listaCategorias .= "<option";
    if($categoria['id_categoria'] == $info_articulo['id_categoria']){
        $listaCategorias .= " selected='selected' ";
    }
    $listaCategorias .= "value='$categoria[id_categoria]'>$categoria[nombre_categoria]</option>";
}
$listaCategorias .= '</select></label>';
return $listaCategorias;
}

function mostrarinfoUsuarios($infoUsuarios){
    $dataTable = '<thead>';
    $dataTable .= '<tr><th>Nombre</th><td>Apellido</td><td>Fecha de nacimiento</td><td>Fecha de creación de la cuenta</td><td>Mail del usuario</td><td>Borrar</td></tr>';
    $dataTable .= '</thead><br>';
    //set up the table body
    $dataTable .= '<tbody>';
    //iterate over all vehicles in the array and put each in a row
    forEach($infoUsuarios as $usuario){
        $dataTable .= "<tr><td>$usuario[nombre_usuario]</td>";
        $dataTable .= "<td>$usuario[apellido_usuario]</td>";
        $dataTable .= "<td>$usuario[fecha_nacimiento]</td>";
        $dataTable .= "<td>$usuario[fecha_creacion]</td>";
        $dataTable .= "<td>$usuario[mail_usuario]</td>";
        $dataTable .= "<td><a href='?action=borrarUsuario&id_usuario=$usuario[id_usuario]' title='Click aquí para borrar el usuario'>Borrar</a></td></tr>";
    }
    $dataTable .= '</tbody>';
    return $dataTable;
}



// ctrl + k + u = descomenta
