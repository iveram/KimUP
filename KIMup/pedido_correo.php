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
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>
              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
                <?php
                            include("conexion.inc");
                            mysql_select_db("kimup", $BDD);
                            if ($_SERVER["REQUEST_METHOD"] == "POST")
                            {  
                                $id=$_POST["id"];
                                $count = count($id);
                                for ($i = 0; $i < $count; $i++) 
                                {
                                    $destino = $id[$i];
                                }
                            }
                
                                                
                            
                            
             echo" <article>
                    <form  action='pedido_enviar.php' id='formcorreo' method='POST'>            
                      <fieldset >
				          <legend>PEDIDOS</legend><br><br><br>
                              <div>    
                                 <div>Destino: <input type='text' name='dest' maxlength='100' value='$destino' /></div>
                                  <div>Asunto: <input type='text' name='asunto' required='required' maxlength='50' /></div><br>
                                  <div><textarea type='text' name='mensaje' required='required' cols='200' rows='20'></textarea></div>		
                                  <div><input type='submit'' name='submit' value='ENVIAR'/></div><br> 
                              </div>                                        
                     </fieldset>          
                 </form>                                           
              </article> " ;?>        
       	</section>      <br><br><br><br><br>
       	 	
       <footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>		 
					 
   </body>          
</html>
