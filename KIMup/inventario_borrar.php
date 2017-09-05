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
                    include("conexion.inc");  
                    mysql_select_db("kimup",$BDD);  
                    $consulta = "DELETE FROM productos WHERE codigo = '$codigo'";
                    $resp = mysql_query($consulta, $BDD);				
              ?>
              
               <article id ='Inventario'> 
                    <form >            
                      <fieldset id = "productos">
				          
				          <legend>INVENTARIO</legend><br><br>       
                            <button type="submit" id="boton" name="act"><img src="img/boton-de-actualizar-pagina.png"></button>
                            <button title = "Exportar a Excel" id="botonh"><img src="img/icon.png"></button> 
                            <button title = "Generar oferta" id="botono"><img src="img/etiqueta-de-oferta.png"></button> 
                             <?php
                            include("conexion.inc");
                            mysql_select_db("kimup", $BDD); 
                  
                             $sql = "SELECT * FROM productos where month(fecha)={$a} order by descripcion asc";
                            $result = mysql_query($sql); 
                        
                             echo "<table class='Inventario'>";
                                echo "<tr id='invh'>
                                            <td>Código</td>
                                            <td>Fecha</td>
                                            <td>Descripción</td>
                                            <td>Proveedor</td>
                                            <td>Cantidad</td>
                                            <td>Stock minimo</td>
                                            <td>Costo</td>
                                            <td>Precio venta</td>
                                            <td>Departamento</td>
                                            <td id = 'img'></td>
                                      </tr><br>"; 

                                while ($row = mysql_fetch_row($result))
                                { 
                                    echo "<tr>
                                                <td>$row[1]</td>
                                                <td>$row[0]</td>
                                                <td>$row[2]</td>
                                                <td>$row[3]</td>
                                                <td>$row[5]</td>
                                                <td>$row[9]</td>
                                                <td>$$row[6]</td>
                                                <td>$$row[7]</td>
                                                <td>$row[8]</td>
                                                <td id='img'><img src ='img/cancelar.png' id='accion' title='Borrar' onclick=Borrar('$row[1]')></td>
                                         </tr> \n";                                     
                                } 	                  
                                echo "</table>";		
                        ?>
                        
                        <br><br><button title = "Exportar a Excel" id="botonh"><img src="img/icon.png"></button>                        
                        <script> 
                            $("button").click(function(){
                                $(".Inventario").table2excel({
                                exclude: ".noExl",
                                name: "Inventario",
                                filename: "Inventario" 
                                });
                                });
                        </script>  
                     </fieldset>                      
				   </form>                                                                         
              </article>         
       	</section>      
       	 	
       <footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>		 
					 
   </body>          
</html>
