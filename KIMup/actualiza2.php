<?php
                    $a=date("m");
                    include("conexion.inc");  
                    mysql_select_db("kimup",$BDD);  
                    $consulta = "UPDATE productos INNER JOIN ventas ON productos.codigo = ventas.codigo
                    SET productos.cant_actual = productos.cant_actual - ventas.cantidad WHERE productos.codigo = ventas.codigo";   
                    $resp = mysql_query($consulta, $BDD);
					if (isset($_POST['botono']))
					{
						$sql2 = "UPDATE productos SET precio_venta = precio_venta*0.8 WHERE CURDATE() >= DATE_SUB(vencimiento,INTERVAL 4 DAY) and MONTH(vencimiento)= MONTH(CURDATE())";
						mysql_query($sql2);
					}		
?>

<html> 
<head> 
<title>Redirigir al navegador a otra URL</title> 
<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=ofertas.php"/> 
</head>  
</html>