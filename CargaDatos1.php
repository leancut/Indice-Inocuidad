<?php
require_once 'funciones/funciones_conexion.inc.php';
require_once 'funciones/funciones.inc.php';
//esta funcion la declaramos en el script respectivo de funciones.inc.php
$Provincias = Listar_Provincias();
$cntProvincias = count($Provincias);

$inpeccs=Tipos_Insp();
$cntInsp = count($inpeccs);

?>


<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- agrego la libreria q voy a utilizar -->
         <title>INICIO - IS</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Creative CSS3 Animation Menus" />
        <meta name="keywords" content="menu, navigation, animation, transition, transform, rotate, css3, web design, component, icon, slide" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style10.css" />
        <link href='images/letra' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style10.css" />        <link rel="stylesheet" type="text/css" href="funciones.inc" />
        <link rel='stylesheet' type='text/css' />
        <link href='images/letra.css' rel='stylesheet' type='text/css' />
        <script src="js/jquery-1.11.3.min.js"></script>
        <!-- programo con jquery para que al cambiar la provincia, se actualice solo el listado de ciudades-->
        <script>
            /* cuando se cargue toda la pagina... */
            $(document).ready(function() {  
                /* cuando elija algun elemento del control identificado como "provincia" */
                $("#provincia").change(function() {
                    /*al tomar el seleccionado*/
                    $("#provincia option:selected").each(function() {
                        /*el valor del item seleccionado es .val()  , se lo asignamos a la variable ProvinciaSeleccionada */
                        ProvinciaSeleccionada = $('#provincia').val();
                        /*luego ese valor lo pasamos por POST al script especificado ajax/ListadoCiudades.inc.php */
                        $.post("ajax/ListadoCiudades.inc.php", {
                            /* y le enviamos el valor seleccionado, el valor llega como IdProvinciaElegida */
                            IdProvinciaElegida : ProvinciaSeleccionada
                        }, function(data) {
                            /*aqui se dibuja en pantalla la respuesta del otro script, q es el selector de ciudades*/
                            $("#DivCiudades").html(data);
                        });
                    });
                })
            });
        </script>
    </head>

    <body>
        
<div class="container">
            <div class="header">
                <span class="right">
                    <a href="" target="_blank"> LC </a>
                    <a href=""><strong></strong></a>
                </span>
                <div class="clr"></div>
            </div>
	<h1> CARGA DE DATOS</span> </h1>
<br>
<br>
<br>
<br>

        <form method="post" onsubmit="return validarForm();" action="CargaDatos2.php">

<h2 style="font-size: 2em; text-align: center; ">TIPO DE INSPECCIÓN</h2> 


            <div>
                <select class="select-css" name="insp" id="insp" required="Por favor ingrese un tipo de inspección">
                    <option value="" selected="selected" disabled="disabled">Selecciona...</option>
                    <?php 
					//aqui recorro las provincias y las muestro en el primer selector
					for ($i = 0; $i < $cntInsp; $i++) { ?>
                        <option value="<?php echo $inpeccs[$i]['ID']; ?>"><?php echo $inpeccs[$i]['INSP']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <br />
            <br />

<h2 style="font-size: 2em; text-align: center; ">PLANTA</h2> 


            <div>
                <select class="select-css" name="Provincia" id="provincia" required="Por favor ingrese la planta">
                    <option value="0">Selecciona...</option>
                    <?php 
					//aqui recorro las provincias y las muestro en el primer selector
					for ($i = 0; $i < $cntProvincias; $i++) { ?>
                        <option value="<?php echo $Provincias[$i]['ID']; ?>"><?php echo $Provincias[$i]['NOMBRE']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <br />
            <br />

<h2 style="font-size: 2em; text-align: center; ">SECTOR</h2>
 
            <div id="DivCiudades">
                <!-- esta parte sera actualizada por la respuesta de ajax -->
               
                <select name="Ciudad" id="ciudad" class="select-css" required="Por favor ingrese el sector">
                    <option value="" selected="selected" disabled="disabled">Primero seleccionar una planta...</option>
                </select>
            </div>
            
            <br />
            <br />
            <div  style="text-align:center;">
            <input type="submit" style='width:250px; height:35px' name="Enviar" value="Realizar la carga" class="btn-material" align="center" onclick= "<?php if(validarForm()== false){ ?> location.href= 'CargaDatos2.php';  " <?php } ?> onsubmit= "  return validar_CargaDatos1();" />
            </div>
        </form>


    </body>


       
        
</html>