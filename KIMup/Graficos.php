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
                  <?php 
                       $fecha_actual = date('F d/y',time()-21600); 
                       $hora = date('H:i a',time()-21600); 
                       $a=date("m");   
                       $fecha_actual = date('F d/y',time()-21600); 
                       $a=date("m");
                       $con = include("conexion.inc");  
                       mysql_select_db("kimup", $BDD);
                       $sql="SELECT * FROM meta"; 
                       $sql3="SELECT ROUND((((SUM(a.precio_venta*b.cantidad))*100)/c.monto),2) FROM productos a, ventas b, meta c WHERE a.codigo=b.codigo AND month(b.fecha)='{$a}' ";
                       $sql4="SELECT (SUM(b.cantidad_mermas)*100)/(SUM(a.cantidad)) FROM  mermas b, productos a WHERE month(b.fecha)='{$a}'";
                       $sql6="SELECT (((SUM(a.precio_venta*b.cantidad))*100)/((SUM(a.precio_venta*b.cantidad))+ (SUM(a.precio_compra*a.cantidad)))),(((SUM(a.precio_compra*a.cantidad))*100)/((SUM(a.precio_venta*b.cantidad))+ (SUM(a.precio_compra*a.cantidad)))) FROM productos a, ventas b WHERE month(b.fecha)='{$a}' AND month(a.fecha)='{$a}'";                  
                       $sql7="SELECT a.departamento,SUM(a.precio_venta*b.cantidad),(((SUM(a.precio_venta*b.cantidad))*100)/(SELECT SUM(a.precio_venta * b.cantidad) FROM productos a, ventas b WHERE a.codigo=b.codigo)) from productos a, ventas b WHERE a.codigo=b.codigo AND month(b.fecha)='{$a}' GROUP BY a.departamento";
                       $result7 = mysql_query($sql7);

                       while ($row = mysql_fetch_row($result7))
                       { 
                             $depto[]= $row[0];
                             $ventadinero = $row[1];
                             $ventapor[] = $row[2]    ;                               
                       }
                       $result4 = mysql_query($sql4);
                       $result6 = mysql_query($sql6);
                       $result3 = mysql_query($sql3);
                       $result = mysql_query($sql);

                       while ($row = mysql_fetch_row($result3))
                       { 
                           $alcance = $row[0]; 
                       } 

                        while ($row = mysql_fetch_row($result))
                        { 
                           $meta = $row[0]; 
                        } 
                  
                        while ($row = mysql_fetch_row($result4))
                        { 
                           $m = $row[0]; 
                        } 
                        
                        while ($row = mysql_fetch_row($result6))
                        {
                            $v = $row[0];
                            $c = $row[1];
                        } 
                  
                        echo "Usuario: ".$_SESSION['nombre']." <br> 
                        $fecha_actual <br> 
                        $hora <br><br>                         
                        <a id = 'Volver' href = 'analisis.php'> Volver atrás </a><br>
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>
              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
                    
              <script src="highcharts.js"></script>
              <script src="data.js"></script>
              <div id="container" style="width: 300px; height: 400px; margin: 40px 40px 0 130px; ">
                      <script type="text/javascript">

                            Highcharts.chart('container', { chart: { type: 'column', backgroundColor: "rgba(255, 255, 255, 0.0)"},
                                                            title: { text: 'Alcance de meta'},
                                                            subtitle: { text: 'Meta mensual: $<?php echo $meta; ?> '},
                                                            xAxis: { type: '' },
                                                            yAxis: { title: { text: ''}
                                                           },

                                legend: { enabled: false },
                                plotOptions: { series: { borderWidth: 0, 
                                                         dataLabels: { enabled: true, format: '{point.y:.2f}%',color:'gray'}  } 
                                             },

                                series: [{ name: 'Brands',
                                           colorByPoint: true,
                                           data: [{
                                                    name: 'Alcance de meta',
                                                    y: <?php echo $alcance; ?>                                     
                                                 }]
                                         }],   

                            });
                        </script>
                </div>                  
                  
              <div id="container2" style="width: 400px; height: 400px; margin: -400px 0 0 900px; ">
                        <script type="text/javascript">

                            Highcharts.chart('container2', {
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie',backgroundColor: "rgba(255, 255, 255, 0.0)"
                                },

                                title: {text: 'Participación por departamento'},
                                tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
                                plotOptions: {
                                                pie: {
                                                        allowPointSelect: true,
                                                        cursor: 'pointer',
                                                        dataLabels: {
                                                                        enabled: true, color:'gray',
                                                                        format: '{point.name}<br> {point.percentage:.1f} %',
                                                                        style: { color: 'black' }
                                                                    }
                                                    }
                                            },

                                series: [{  name: 'Brands',
                                            colorByPoint: true,
                                            data: [ 
                                                    {        
                                                    name: "<?php echo $depto[0]; ?>" ,
                                                    y:   <?php echo $ventapor[0]; ?> 
                                                    },

                                                    {        
                                                    name: "<?php echo $depto[1]; ?>" ,
                                                    y:   <?php echo $ventapor[1]; ?> 
                                                    },

                                                    {        
                                                    name: "<?php echo $depto[2]; ?>" ,
                                                    y:   <?php echo $ventapor[2]; ?> 
                                                    },

                                                    {        
                                                    name: "<?php echo $depto[3]; ?>" ,
                                                    y:   <?php echo $ventapor[3]; ?> 
                                                    },

                                                    {        
                                                    name: "<?php echo $depto[4]; ?>" ,
                                                    y:   <?php echo $ventapor[4]; ?> 
                                                    },
                                                 ]
                                }]
                            });
                        </script>
               </div>      
              
              <div id="container3" style="width: 370px; height: 370px; margin: -400px 0 0 450px; ">
                        <script type="text/javascript">

                            Highcharts.chart('container3', {
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie',backgroundColor: "rgba(255, 255, 255, 0.0)"
                                },

                                title: {text: 'Compra/venta'},
                                tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' },
                                plotOptions: {
                                                pie: {
                                                        allowPointSelect: true,
                                                        cursor: 'pointer',
                                                        dataLabels: {
                                                                        enabled: true, color:'gray',
                                                                        format: '{point.name}<br> {point.percentage:.1f} %',
                                                                        style: { color: 'black' }
                                                                    }
                                                    }
                                            },

                                series: [{  name: 'Brands',
                                            colorByPoint: true,
                                            data: [ 
                                                    {        
                                                    name: "Venta" ,
                                                    y:   <?php echo $v; ?>
                                                    },

                                                    {        
                                                    name: "Compra" ,
                                                    y:   <?php echo $c; ?>
                                                    },
                                                 ]
                                }]
                            });
                        </script>
               </div>         
               
             <footer>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>	
       	</section>      
       	 	
   </body>          
</html>
