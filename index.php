<html>
<head>
<title>Insertar Usuarios</title>
 <meta charset="UTF-8">
    <title>Ejemplo Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <script language="JavaScript">
    function validacion() {
    valor = document.getElementById("txtUser").value;
      if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        alert('[ERROR] Debe escribir un nombre de Usuario');
        return 1;
    } 
  
    valor1 = document.getElementById("txtPass").value;
      if( valor1.length <= 5 ) {
        alert('[ERROR] Debe escribir una contraseña de 6 o mas caracteres');
        return 1;
    } 
    
      return 0
    }
    
    function agregar()
    { 
        if (validacion()==0){
      document.formulario.action=
    "procesarLogin.php";
    document.formulario.submit();
    }
    }  
  </script>
</head>
<body>
<div>
    <form class="form-container col-6 col-sm-6 col-md-2"
          name='formulario'
          id='formulario'
          method='POST' 
          action= 'procesarLogin.php'>
<section class="container-fluid">
            <section class="row justify-content-center">
                    <div class="form-group">
        <label for="txtUser">Nombre de Usuario</label>
            <input type="text" class="form-control" id="txtUser" name="txtUser" placeholder="Usuario">
    </div>
    <div class="form-group">
        <label for="txtPass">Password</label>
            <input type="password" class="form-control"  id="txtPass" name="txtPass" placeholder="Password">
    </div> 
        <input type='button' 
           name='accion'
         value='Login'
         OnClick='JavaScript:agregar();'
         class="btn btn-success">    
            </section>
        </section>       
    </form>    
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
