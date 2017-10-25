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

        <script type="text/javascript" >
            
			var miObjetoAjax = null
			if (window.XMLHttpRequest) miObjetoAjax = new XMLHttpRequest() //para Mozilla
			else if (window.ActiveXObject)miObjetoAjax = new ActiveXObject("Microsoft.XMLHTTP") //Para IExplorer

			function Borrar(codigo)
			{
				if(!confirm("Se eliminará el producto " + codigo))
					return;
				url = "inventario_borrar.php?codigo=" + codigo;
				miObjetoAjax.open("GET", url);
				miObjetoAjax.send(null);
				miObjetoAjax.onreadystatechange = RecibeRespuesta;
			}
			function Oferta(codigo)
			{
				if(!confirm("Se aplicará una oferta " + codigo))
					return;
				
				var descuento;
				descuento=prompt('Ingrese descuento:','');
				url = "inventario_borrar2.php?codigo="+codigo+"&oferta="+descuento;
				miObjetoAjax.open("GET", url);
				miObjetoAjax.send(null);
				miObjetoAjax.onreadystatechange = RecibeRespuesta;
			}
			function RecibeRespuesta()
			{
				if(miObjetoAjax.readyState == 4)document.getElementById("Inventario").innerHTML = miObjetoAjax.responseText;
			}            
		</script>  
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