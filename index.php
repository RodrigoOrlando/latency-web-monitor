<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Ping Monitor</title>
    <link href="flotlib/examples/examples.css" rel="stylesheet" type="text/css">  
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="flotlib/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="flotlib/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="flotlib/jquery.flot.axislabels.js"></script>
<style>
.flot-tick-label {
	transform: rotate(-15deg);
}
</style>    
 </head>
    <body>
    <h1>Ping Monitor</h1>

    <div id="placeholder" class="demo-container"></div>

<script type="text/javascript">
$(document).ready(function recogerDatos() {
	var timeout = 5000;
    $.post("ping.php").done(function(response, status){
    	console.log(response);
    	$.plot($("#placeholder"), [eval(response)], 
    {
        yaxis : {
            show : true,
            axisLabel : 'Latencia [ms]',
            position: 'left',
        },
        xaxis : {
            show : true,
            axisLabel : 'Tiempo [Formato UNIX]',
        }

    }

            );
	});
    setTimeout(recogerDatos, timeout);
});
</script>
 </body>
</html> 
