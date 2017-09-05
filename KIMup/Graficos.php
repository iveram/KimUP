<!DOCTYPE HTML>
<?php  
       $fecha_actual = date('F d/y',time()-21600); 
       $a=date("m");
       $con = include("conexion.inc");  
       mysql_select_db("kimup", $BDD);
       $sql="SELECT * FROM meta"; 
       $sql3="SELECT ROUND((((SUM(a.precio_venta*b.cantidad))*100)/c.monto),2) FROM productos a, ventas b, meta c WHERE a.codigo=b.codigo AND month(b.fecha)='{$a}' ";

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

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>KIMup Gráficos</title>
		 </head>
	
	<body>
        <img src="img/logo.png" alt=""  style="min-width: 120px; height: 80px; margin: 10px 0 0 50px">
        <script src="highcharts.js"></script>
        <script src="data.js"></script>
        
        <div id="container" style="width: 300px; height: 400px; margin: 40px 40px 0 40px">
            
            <script type="text/javascript">

                Highcharts.chart('container', { chart: { type: 'column' },
                                                title: { text: 'Alcance de meta' },
                                                subtitle: { text: 'Meta mensual: $<?php echo $meta; ?> '},
                                                xAxis: { type: '' },
                                                yAxis: { title: { text: ''}
                                               },

                    legend: { enabled: false },

                    plotOptions: { series: { borderWidth: 0,
                                             dataLabels: { enabled: true,
                                                           format: '{point.y:.2f}%'}
                                           } 
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
    </body>
</html>
