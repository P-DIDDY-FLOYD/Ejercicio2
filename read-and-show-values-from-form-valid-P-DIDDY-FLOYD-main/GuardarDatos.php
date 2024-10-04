<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
} else {
        $nombre = $_POST['name'];
        $contrasena = $_POST['password'];
        $correo = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
        $nac = $_POST['dateofbirth'];
        $telefono = $_POST['tel'];
        $tienda = $_POST['shop'];
        $edad = $_POST['age'];
        $suscripcionS = isset($_POST['subscription']) ? $_POST['subscription'] : null;
        
        if(empty($suscripcionS)){
            $suscripcion="No esta suscrito al boletin";
        }
        else{
            $suscripcion="Esta suscrito al boletin";
        }
        
        $patronNombre="/^[A-Za-z\s]{3,25}$/";
        $patronContra="/^[A-Za-z0-9]{6,8}$/";
        
        $errores=[];
        
        if (empty($correo) ||$correo===false){
            $errores[]="Falta el correo o es invalido";
        }
        
        if(empty($telefono)){
            $errores[]="Falta el telefono";
        }
        
        if(empty($tienda)){
            $errores[]="Falta indicar la tienda mas cercana";
        }
        
        if(empty($edad)){
            $errores[]="Falta indicar la edad";
        }
        
        if(empty($nac)){
            $errores[]="Falta la fecha de nacimiento";
        }
    
        if(empty($nombre) || !preg_match($patronNombre,$nombre)){
            $errores[]="Falta el nombre o es invalido";
        }
        
        if(empty($contrasena) || !preg_match($patronContra, $contrasena)){
            $errores[]="Falta la contraseña o es invalida";
        }
         
        if(!empty($errores)){
            $_SESSION['errores'] = $errores;
            header("Location: index.php");
        }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de datos</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <h1 class="info">Informacion de datos enviados</h1>
        <h3>Nombre: <?php echo $nombre; ?></h3>
        <h3>Contraseña: <?php echo $contrasena?></h3>
        <h3>Correo: <?php echo $correo?></h3>
        <h3>Fecha de nacimiento: <?php echo $nac?></h3>
        <h3>Telefono: <?php echo $telefono?></h3>
        <h3>Tienda mas cercana:<?php echo $tienda?></h3>
        <h3>Edad: <?php echo $edad?></h3>
        <h3>Suscripcion de boletin: <?php echo $suscripcion?></h3>
    </body>
</html>