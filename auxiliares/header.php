<div class="row mt-3" id="encabezado-logo">
    <div class="col-md-4 col-xs-12 col-sm-12 text-center">
      <h4><i class="fa-solid fa-kitchen-set"></i></h4>
      <h3>Stock-AR</h3> 
    </div>
    <div class="col-md-4 off offset-md-4 col-xs-12 col-sm-12" id="inicio-sesion">
        <i class="fa fa-user" aria-hidden="true" id="logo-inicio-sesion"></i>
        <?php 
        if(isset($_SESSION['loggedin'])){
            echo "<div><a href='/c6-13-m-php/usuarios/?action=loggedin'>Bienvenido ", $_SESSION['usuarioInfo']['nombre_usuario'], '</a>', " | ", "<a href='/c6-13-m-php/usuarios/?action=logout'>Cerrar Sesión</a></div>";
          } else {
            echo "<a href='/c6-13-m-php/usuarios/?action=login'>Iniciar Sesión</a>";
          } ?>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12" id="banner-principal">
        
    </div>
</div>