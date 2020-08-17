<html>
<head>
<title>Calcular Stock Critico</title>
 <meta charset="UTF-8">
    <title>Calcular stock</title>
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
          action= "listarProducto.php?action=listar&id=1">
<section class="container-fluid">
            <div class="form-group row">
   <div class="col-auto my-1">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Cantidad menor o igual a: </label>
      <select class="custom-select mr-sm-2" id="cant" name="cant">
        <option selected>Choose...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
    </div>
        <button type="submit" name='action'
         value='Buscar' class="btn btn-success">Buscar</button>   
           
    <a href="buscarProducto.php">
    <button type="button" class="btn btn-secondary float-right">Volver</button>
    </a>
               
    </form>  
        
</div>

<sript src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>