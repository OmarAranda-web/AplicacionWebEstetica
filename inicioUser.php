<?php
if (!isset($_SESSION)) {
  session_start();
}
$auth = $_SESSION['admin'] ?? false;
$user = $_SESSION['usuario'];
$idUser = $_SESSION['idUsuario'];
if ($user) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar cita</title>
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="inicioUser.css">
  </head>

  <body>

    <main class="contenedor-principal">


      <header class="content-header header2">
        <h2 class="NombreUsuario"><?php echo $user; ?></h2>
        <a href="cerrarSesion.php" class="btn btn-secondary boton">Cerrar sesion</a>
        <img src="IMG/logo2.png" class="img">
      </header>


      <nav>
        <h3>Citas</h3>
      </nav>
      <section class="fondo12">
        <section class="section">

          <section class="citas-container">
                <?php
                require 'conexion/conexion.php';
                $query = "call ver_citas_user('$idUser')";
                $result = mysqli_query($db, $query);

                while ($cita = mysqli_fetch_array($result)) {
                  echo "
              <article class='cita'>
              <section class='info-cita'>
                <a href='conexion/crearPDF.php?cita=$cita[0]' class='alias-cita' target='_blank'>$cita[1]</a>
              
                <section class='date-cita'>
                  <p>$cita[2]</p>
                  <p>$cita[3]</p>
                </section>
                <p>$$cita[4]</p>
              </section>

              <a href='conexion/citas/cancelarCita.php?id=$cita[0]' class='btn-cancelar'>Cancelar</a>
              <a href='./editarCita.php?id=$cita[0]' class='btn-cancelar'>Editar</a>
              </article>
              
              ";
                }
                ?>
                  <a href="AgregarCita.php" class="add-cita">+</a>
          </section>
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
<?php
} else {
  header('Location:index.php');
}
?>