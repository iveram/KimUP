<?php
    session_start();
    if ( $_SESSION['estado'] == "logeado" ) { header(""); }
    else { header("Location: login.php?error=Por+favor+inicie+sesion"); }
?>

<!DOCTYPE html>
<html>
	<head>  		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>KIM up</title>  
        <link rel="stylesheet" href="General.css" type="text/css" media="screen"> 
        <link rel="stylesheet" href="Css.css" type="text/css" media="screen"> 
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="jquery.table2excel.js"></script>
 
    </head> 
     
        
    <body> 
       	<section>
              <img src="img/logo.png" alt="">
              <p>
                  <?php $fecha_actual = date('F d/y',time()-21600);
                        $a=date("m");                    
                        $hora = date('H:i a',time()-21600); 
                        echo "Usuario: ".$_SESSION['nombre']." <br> 
                        $fecha_actual <br> 
                        $hora <br><br>                         
                        <a id = 'Volver' href = 'index_sala.php'> Volver atrás </a><br>
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
               
              <article id ='Inventario'> 			  
                    <form method="post" action="pedido_correo.php" >            
                      <fieldset id = "productos"><br><br>       
                          <input type="submit" name="submit" value="REALIZAR PEDIDO"/>
                                                           
                        <?php
                            include("conexion.inc");
                            mysql_select_db("kimup", $BDD); 
                  
                            $sql = "SELECT * FROM productos where cant_actual <= minimo order by proveedor asc";
                            $result = mysql_query($sql); 
                             echo "<table class='Inventario'>";
                                echo "<tr id='invh'>
                                            <td>Producto</td>
                                            <td>Cantidad</td>
                                            <td>Precio unidad</td>
                                            <td>Total compra</td>
                                            <td>Proveedor</td>
                                            <td></td>
                                      </tr><br>"; 
                          
                                while ($row = mysql_fetch_row($result))
                                { 
                                    
                                    $total = ($row[7] * $row[6]);
                                    echo "<tr>
                                                <td>$row[2]</td> 
                                                <td>$row[6]</td> 
                                                <td>$".number_format($row[7])."</td> 
                                                <td>$".number_format($total)."</td>
                                                <td>$row[3]</td>
                                                <td><input type='checkbox' name ='id[]'  value='$row[4]'  style='width:20px;'></td>
                                         </tr> \n";  
                                } 	                  
                                echo "</table>";	
                        ?>
                        <br><br>                  
                 
                        </fieldset><footer>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>	
				 
				   </form>                                                                         
              </article>          
       	</section>   
   </body>             
</html>
