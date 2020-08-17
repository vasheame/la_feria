<html>
<head>
<title>Calcular Ventas</title>
 <meta charset="UTF-8">
    <title>Calcular Ventas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">

</head>
<body>
<div>
    <form class="form-container col-6 col-sm-6 col-md-2"
          name='formulario'
          id='formulario'
          method='POST' 
          action= "listarVentas.php?action=listar&id=1">
<section class="container-fluid">
            <div class="form-group row">
  <label for="example-date-input" class="col-2 col-form-label">Fecha</label>
  <div class="col-10">
    <input class="form-control" type="date" value="2020-06-22" id="fecha" name="fecha">
  </div>
</div>
        <button type="submit" name='action'
         value='Buscar' class="btn btn-success">Buscar</button>   
           
    <a href="carrito2.php">
    <button type="button" class="btn btn-secondary float-right">Volver</button>
    </a>
               
    </form>  
        
</div>

<sript src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
