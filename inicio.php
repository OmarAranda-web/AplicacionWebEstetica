<?php 
  if (!isset($_SESSION)) {
    session_start();
  }
  $auth=$_SESSION['admin'] ?? false;
  $user=$_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar cita</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="inicio.css">
</head>

<body>

  <main class="contenedor-principal">


    <header class="content-header header2">
      <h2 class="NombreUsuario"><?php echo $user; ?></h2>
      <button type="button" class="btn btn-secondary boton">Cerrar sesion</button>
      <img src="IMG/logo2.png" class="img">
    </header>


    <aside class="aside1">
      <a class="brand-link aside1">
        <img src="IMG/logoblanco.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Estetica Union</span>
      </a>
      <a class="brand-link text-center">
        <label>MENU</label>
      </a>
      <a class="brand-link">
        <a href="InsertarServicio.php" class="btn btn-primary col-12">Insertar Servicio</a>
        <br><br>
        <a href="verservicios.php" class="btn btn-primary col-12">Ver servicios</a>
        <br><br>
        <a class="btn btn-danger col-12" href="insertarLocales.php">Insertar Locales</a>
        <br><br>
        <a class="btn btn-danger col-12" href="verLocales.php">Ver Locales</a>
      </a>
    </aside>


    <nav>
      <h3>Citas</h3>
    </nav>


    <section class="fondo12">
      <section class="section">
        <table class="table tabla1">
          <tr>
            <td scope="col ml-auto">Cita</td>
            <td><i class='fas fa-trash-alt' title='Eliminar'></i></td>
          </tr>
          <tr>
            <td scope="col ml-auto">Cita 1</td>
            <td><i class='fas fa-trash-alt' title='Eliminar'></i></td>
          </tr>
          <tr>
            <td scope="col ml-auto">Cita 2</td>
            <td><i class='fas fa-trash-alt' title='Eliminar'></i></td>
          </tr>
          <tr>
            <td scope="col ml-auto">Cita 3</td>
            <td><i class='fas fa-trash-alt' title='Eliminar'></i></td>
          </tr>
        </table>
      </section>
      <section class="aside2">
        <img src="IMG/InformacionSitio.gif" class="imagenServicios">
      </section>
    </section>


    <footer>
      <h4>@2022</h4>
    </footer>
  </main>
</body>

</html>