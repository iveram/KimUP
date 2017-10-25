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
    </head> 
     
        
    <body> 
       	<section>
                             
              <?php $fecha_actual = date('F d/y',time()-21600);
                        $a=date("m");                    
                    $codigo = $_GET["codigo"];
					$oferta = $_GET["oferta"];
                    include("conexion.inc");  
                    mysql_select_db("kimup",$BDD);  
                    $consulta = "UPDATE productos SET precio_venta = precio_venta*((100-'$oferta')/100) WHERE codigo = '$codigo' and CURDATE() >= DATE_SUB(vencimiento,INTERVAL 4 DAY) and MONTH(vencimiento)= MONTH(CURDATE())";
                    $resp = mysql_query($consulta, $BDD);				
              ?>
              
               <article id ='Inventario'> 			  
                    <form method="post" action="actualiza2.php" >            
                      <fieldset id = "productos">
				          <legend>Ofertas</legend><br><br>       
                            <button type="submit" id="boton" name="act"><img src="img/boton-de-actualizar-pagina.png"></button>               
                            <button type="submit" title = "Aplicar oferta a todo" name='botono' id="botono"><img src="img/etiqueta-de-oferta.png"></button> 
                            
                            <br><br>                       
                             <?php
                            include("conexion.inc");
                            mysql_select_db("kimup", $BDD); 
                  
                            $sql3 = "SELECT * FROM productos where CURDATE() >= DATE_SUB(vencimiento,INTERVAL 4 DAY) and MONTH(vencimiento)= MONTH(CURDATE())";
                            $result2 = mysql_query($sql3); 
                            
                             echo "<table class='Inventario'>";
                                echo "<tr id='invh'>
                                            <td>Código</td>
                                            <td>Fecha</td>
                                            <td>Descripción</td>
                                            <td>Proveedor</td>
                                            <td>Cantidad</td>
                                            <td>Cant. actual</td>
                                            <td>Stock minimo</td>
                                            <td>Costo</td>
                                            <td>Precio venta</td>
                                            <td>Departamento</td>
											<td id = 'img'></td>
                                            <td id = 'img2'></td>
											
                                      </tr><br>"; 

                                while ($row = mysql_fetch_row($result2))
                                { 
                                    echo "<tr>
                                                <td>$row[1]</td>
                                                <td>$row[0]</td>
                                                <td>$row[2]</td>
                                                <td>$row[3]</td>
                                                <td>$row[6]</td>
                                                <td>$row[11]</td>
                                                <td>$row[10]</td>
                                                <td>$".number_format($row[7])."</td>                                                
                                                <td>$".number_format($row[8])."</td>
                                                <td>$row[9]</td>
                                                <td id='img'><img src='img/cancelar.png' id='accion' title='Borrar' onclick=Borrar('$row[1]')></td>
												<td id='img2'><img src='img/oferta.png' id='accion' title='Oferta' onclick=Oferta('$row[1]')></td>
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