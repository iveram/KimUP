<?php
    session_start();
    include("conexion.inc");
    mysql_select_db("kimup", $BDD);
    $user = $_GET["usuario"];
    $pass = $_GET["clave"];
    $md5 = md5($pass);

    $sql = "SELECT * FROM login WHERE usuario = '$user' and md5 = '$md5'";
    $rec = mysql_query($sql);
    $count = 0;

    while($row = mysql_fetch_object($rec))
    {
        $count++;
        $result = $row;
    }

    if($count == 1)
    {
        if($user == 'Jefe de sala')
        {
         $_SESSION['estado'] = "logeado";
         $_SESSION['nombre'] = $user;
         header("Location: index_sala.php");
        }
        
        if($user == 'Administrador')
        {
         $_SESSION['estado'] = "logeado";
         $_SESSION['nombre'] = $user;
         header("Location: index_admin.php");
        }
    }

    else
    {
        header("Location: login.php?error=Error.+Usuario+o+contraseña+incorrecto");
    }

?>
