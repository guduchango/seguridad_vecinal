
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Seguridad Vecinal</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!--barra de navegacion-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/poanes/public/">Seguridad Vecinal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="#">Hola, pepe</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="page-header">
  <pre><h3><b>   Registro</h3></pre>
</div>
<div class="container">

  <form>
    <div class="row">
    <div class="form-group col-md-6">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Introducir Nombre">
  </div>
  <div class="form-group col-md-6">
    <label for="apellido">Apellido</label>
    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Introducir Apellido">
  </div></div>
  <div class="row">
  <div class="form-group col-md-12">
    <label for="email">Correo Electronico</label>
    <input type="email" class="form-control" name="correo" id="correo" placeholder="Introducir Correo Electronico">
  </div>
</div>

 <div class="row">
 <div class="form-group col-md-12">
    <label for="contraseña">contraseña</label>
    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="introducir contraseña">
</div>
</div>

 <div class="row">
 <div class="form-group col-md-12">
    <label for="dni">DNI</label>
    <input maxlength="8" type="text" class="form-control" name="dni" id="dni" placeholder="introducir DNI">
</div>
</div>
 

<div class="row">
 <div class="form-group col-md-12">
  <label for="localidad">Localidad</label>
 <select class="form-control">
  <option>San Rafael</option>
  <option>General Alvear</option>
  <option>Mendoza</option>
  <option>Valle Grande</option>
  </select>
</div>
</div>

   <div class="row">
    <div class="form-group col-md-4">
    <label for="calle">Calle</label>
    <input type="text" class="form-control" name="calle" id="calle" placeholder="Introducir calle">
  </div>
  <div class="form-group col-md-4">
    <label for="numero">numero</label>
    <input type="text" class="form-control" name="numero" id="numero" placeholder="Introducir numero">
  </div>
    <div class="form-group col-md-4">
    <label for="piso">Piso</label>
    <input type="text" class="form-control" name="piso" id="piso" placeholder="Introducir piso">
  </div></div>
  <div class="row">
    <div class="form-group col-md-6">
    <label for="telefono">Telefono</label>
    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Introducir telefono">
  </div>
  <div class="form-group col-md-6">
    <label for="celular">Celular</label>
    <input type="text" class="form-control" name="celular" id="celular" placeholder="Introducir celular">
  </div></div>
  <button type="submit" class="btn btn-info pull-right">Aceptar</button>

</body></html>