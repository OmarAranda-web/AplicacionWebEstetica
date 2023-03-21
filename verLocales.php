<?php
if (!isset($_SESSION)) {
  session_start();
}

require 'conexion/conexion.php';
$auth = $_SESSION['admin'] ?? false;
$user = $_SESSION['usuario'];

if ($auth) {
  # code...
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver Locales</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="inicio.css">

</head>

<body>

  <main class="contenedor-principal">


  <header class="content-header header2">
      <h2 class="NombreUsuario"><?php echo $user; ?></h2>
      <a href="./cerrarSesion.php" class="btn btn-secondary boton">Cerrar sesion</a>
     <a href="inicioUser.php"> <img src="IMG/logo2.png" class="img"></a>
    </header>
    <span class="placeholder col-12 bg-secondary"></span>

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
      <h3>Ver local</h3>
    </nav>


    <section class="fondo12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Direccion</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require 'conexion/conexion.php';
          $query = 'call proc_consul_locales()';
          $result = mysqli_query($db, $query);
          while ($local = mysqli_fetch_array($result)) {
            echo "
              <tr>
              <td>$local[1]</td>
              <td>$local[2]</td>
              <td><a href='editarLocales.php?id=$local[0]'>Editar</a></td>
              <td><a href='./conexion/local/eliminarLocal.php?id=$local[0]'>Eliminar</i></a></td>
              </tr>
              
              ";
          }
          ?>


        </tbody>
      </table>
    </section>


    <footer>
      <h4>@2022</h4>
    </footer>
  </main>
</body>

</html>

<?php
  }else{
   header('Location:index.php');
  }
?>