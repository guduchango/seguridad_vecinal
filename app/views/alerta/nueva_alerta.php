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

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

   
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
            <li styles="white" ><a href="#">Hola, Pepe</a></li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<pre></pre>
    <div class="container">

<div class="page-header">
  <h1> Alertas <small></small></h1>
</div>
      <div class="starter-template">
        <h4>Cargar alerta</h4>
        <p class="lead">
          <br> </p>
      </div>

<form>
   <div class="form-group">
    <label for="exampleInputEmail1">Tipo</label>
<select name="" class="form-control">

  <option>Seguridad</option>
  <option>Medicos</option>
  <option>Alerta</option>
 
</select>
<div class="form-group">
    <label for="exampleInputEmail1">Breve Descripcion de su Alerta</label>
   <textarea class="form-control" rows="6"></textarea>
</div>
<div class="form-group">
    <label for="exampleInputEmail1"> Ubicacion</label>
     <input type="text" class="form-control">
</div>
<button class="pull-right btn btn-default"  type="submit"> Enviar </button>
</div>
</form>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    
    
  </body>
</html>