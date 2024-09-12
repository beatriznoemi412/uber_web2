<?php
  // Crea conexión PHP Mysql
  $db = new PDO('mysql:host=localhost;'.'dbname=uber_tandil;charset=utf8', 'root', '');

  // Prepara las consultas para usuario y conductor
  $queryUsuario = $db->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
  $queryConductor = $db->prepare('SELECT * FROM conductor WHERE id_conductor = ?');
  // Prepara la consulta para listar viajes
  $queryViaje = $db->prepare('SELECT * FROM viaje');//Una consulta (query) es una instrucción 
  //SQL que se envía a la base de datos para realizar una acción, como obtener datos (SELECT), 
  //insertar datos (INSERT), actualizar datos (UPDATE), eliminar datos (DELETE), etc.
  $queryViaje->execute();

  // PHP pide los resultados, vamos a mostrar al usuario y conductor que viajan
  $viajes = $queryViaje->fetchAll(PDO::FETCH_OBJ);

  foreach($viajes as $viaje){
     // Ejecuta las consultas preparadas para usuario y conductor
     $queryUsuario->execute([$viaje->id_usuario]);
     $usuario = $queryUsuario->fetch(PDO::FETCH_OBJ); // obtiene el usuario como objeto

     $queryConductor->execute([$viaje->id_conductor]);
     $conductor = $queryConductor->fetch(PDO::FETCH_OBJ); // obtiene el conductor como objeto

     // Muestra la información del viaje, usuario y conductor
     echo $viaje->id_viaje . " Fecha: " . $viaje->fecha . "<br>";
     echo "&nbsp;&nbsp;&nbsp; Usuario: " . $usuario->nombre . "<br>";
     echo "&nbsp;&nbsp;&nbsp; Conductor: " . $conductor->nombre . "<br>";
     echo "<br>";
  }
?>
