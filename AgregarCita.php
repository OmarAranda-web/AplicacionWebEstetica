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
<body >
   
<main class="contenedor-principal">
    

        <header class="content-header header2">
            <h2 class="NombreUsuario">Nombre Usuario</h2>           
            <button type="button" class="btn btn-secondary boton">Cerrar sesion</button>
            <img src="IMG/logo2.png" class="img">
        </header>
        <span class="placeholder col-12 bg-secondary"></span>

        <aside class="aside1">
                <a class="brand-link aside1">
                    <img src="IMG/logoblanco.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                        <span class="brand-text font-weight-light">Estetica Union</span>
                        </a>
                        <a class="brand-link text-center">
                        <label >MENU</label>
                        </a>
                        <a class="brand-link">
                        <button type="button" class="btn btn-primary col-11">Insertar Servicio</button>
                        <br><br>
                        <button type="button" class="btn btn-primary col-11">Ver los servicios</button>
                        <br><br>
                        <button type="button" class="btn btn-danger col-11">Insertar Locales</button>
                        <br><br>
                        <button type="button" class="btn btn-danger col-11">Ver Locales</button>
                        </a>
        </aside>


        <nav>
            <h3>Citas</h3>
        </nav>


        <section class="fondo12">
            <section class="agregarcita">

              <div class="columns asd">
                <div class="col-md-15 mb-3">
                  <label for="firstName">Alias</label>
                  <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Escribe el Alias
                  </div>
                </div>
                <div class="col-md-15 mb-3">
                  <label for="firstName">Fecha</label>
                  <input type="date" class="form-control" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Escribe la Fecha
                  </div>
                </div>
                <div class="col-md-15 mb-3">
                  <label for="firstName">Hora</label>
                  <input type="time" width="500px" class="form-control" id="firstName" placeholder="" value="" required>
                  <div class="invalid-feedback">
                    Escribe la Hora
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Local</label>
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </div>
              </div>
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit">insertar</button>

            </section>
            <section class="servicios">
              <h4>Servicios</h4>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
              <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
            </div>
            </section>
        </section>


        <footer>
            <h4>@2022</h4>
        </footer>
    </main>
</body>
</html>