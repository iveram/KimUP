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
              <img src="img/logo.png" alt="">
              <p>
                  <?php $fecha_actual = date('F d/y',time()-21600);  
                        $f = date('Y-m-d');
                        $hora = date('H:i a',time()-21600); 
                        echo "Usuario: ".$_SESSION['nombre']." <br> 
                        $fecha_actual <br> 
                        $hora <br><br>                         
                        <a id = 'Volver' href = 'Pedidos.php'> Volver atrás </a><br>
                        <a href = 'login-salir.php'> Cerrar sesión </a>";
                            
                        $destino = $_POST['dest'];
                        $asunto  = $_POST['asunto'];
                        $mensaje = $_POST['mensaje'];
                        $contenido = "Mensaje: " . $mensaje;

                        mail($destino, $asunto, $contenido);	
                    ?>
              </p>
              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
                
                                
                            
                            
             echo" <article>
                    <form  action='pedido_enviar.php' id='formcorreo' method='POST'>            
                      <fieldset >
				          Pedido enviado                                        
                     </fieldset>          
                 </form>                                           
              </article> " ;?>        
       	</section>      <br><br><br><br><br>
       	 	
       <footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>		 
					 
   </body>          
</html>
