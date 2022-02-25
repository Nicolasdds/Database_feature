<?php 
if (isset($_POST['ejecutar'])) {
      $server = "localhost";
      $port = "3306"; 
      $user = $_POST['user'];
      $pass = $_POST['pass'];
      $database = $_POST['database'];
      $tabla = $_POST['tabla'];
      $campo = $_POST['campo'];
      $id_nombre = $_POST['id_nombre'];
      if ($_POST['radio'] == 'int') {
            $valor = intVal($_POST['valor']);
      } elseif ($_POST['radio'] == 'float') {
            $valor = floatVal($_POST['valor']);
      } else {
            $valor = $_POST['valor'];
      }

      $control = actualizar($server, $user, $pass, $database, $valor, $tabla, $campo, $id_nombre);
      echo $control;
      $_POST['ejecutar'] = '';
} 

function actualizar($server, $user, $pass, $database, $valor, $tabla, $campo, $id_nombre){
      $conexion = mysqli_connect($server, $user, $pass, $database) or die("Error al conectar");
      $respuesta = $conexion->query("SELECT * FROM `$tabla`");
      $cantidad = mysqli_num_rows($respuesta);
      $control = '';
      foreach($respuesta as $item){
            $id = $item[$id_nombre];
            $ingreso = "UPDATE `$tabla` SET `$campo`='$valor' WHERE `$id_nombre`='$id'";
            
            if (mysqli_query($conexion, $ingreso)) {
                  $control = ' -> Actualizado correctamente.';
            } else {
                  $control = ' -> Error al actualizar.';
            }
      };
      mysqli_close($conexion);
      return $control;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Actualizar datos</title>
    <style>
          label {
            margin-top: 12px;
          }
          .form-check {
                display: inline-block;
                margin: 15px 0;
          }
          .form-check-input:hover,
          .form-check label{
                cursor: pointer;
          }
    </style>
</head>
<body>
<div class="container" style="width:550px">
      <h3 class="text-center">Ingresar el mismo valor, en el mismo campo en toda la tabla:</h3>
     <form action="#" method="POST">
      <div class="form-group">
            <label for="database">Base de datos:</label>
            <input type="text" class="form-control" name="database" placeholder="Ingrese la base de datos">
      </div>
      <div class="form-group">
            <label for="user">Usuario:</label>
            <input type="text" class="form-control" name="user" placeholder="Ingrese el usuario">
      </div>
      <div class="form-group">
            <label for="pass">Contraseña:</label>
            <input type="password" class="form-control" name="pass" placeholder="Ingrese la contraseña">
      </div>
      <div class="form-group">
            <label for="tabla">Tabla:</label>
            <input type="text" class="form-control" name="tabla" placeholder="Ingrese la tabla">
      </div>
      <div class="form-group">
            <label for="id_nombre">Id de la tabla:</label>
            <input type="text" class="form-control" name="id_nombre" placeholder="Ingrese el id de la tabla">
      </div>
      <div class="form-group">
            <label for="campo">Campo:</label>
            <input type="text" class="form-control" name="campo" placeholder="Ingrese el campo">
      </div>
      <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" class="form-control" name="valor" id="valor" placeholder="Ingrese el valor">
      </div>
      <div class="form-group text-center">
            <div class="form-check">
                  <input class="form-check-input" value="text" type="radio" name="radio" id="radio_1">
                  <label class="form-check-label" for="radio_1">
                        Texto
                  </label>
            </div>
            <div class="form-check">
                  <input class="form-check-input" value="int" type="radio" name="radio" id="radio_2">
                  <label class="form-check-label" for="radio_2">
                        Entero
                  </label>
            </div>
            <div class="form-check">
                  <input class="form-check-input" value="float" type="radio" name="radio" id="radio_3">
                  <label class="form-check-label" for="radio_3">
                        Decimal
                  </label>
            </div>
      </div>
      
      <div class="form-group text-center">
            <button type="submit" name="ejecutar" id="ejecutar" class="btn btn-primary">Ejecutar</button>
      </div>
            
      </form>
</div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
          $(function(){
                   
                  $('#valor').attr('disabled', true);
                  $('input').bind('change', function(){
                        var radio_1 = $('#radio_1');
                        var radio_2 = $('#radio_2');
                        var radio_3 = $('#radio_3');
                        if (radio_1.prop('checked') || radio_2.prop('checked') || radio_3.prop('checked')) {
                              $('#valor').attr('disabled', false);
                        } else {
                              $('#valor').attr('disabled', true);
                        }
                  });
             
            });
    </script>
</body>
</html>
