<?php
require_once 'funciones/funciones_conexion.inc.php';
require_once 'funciones/funciones.inc.php';
//esta funcion la declaramos en el script respectivo de funciones.inc.php
$Zonas = Listar_Zona($_POST['IdCiudad']);
$cntZonas = count($Zonas);
$sect=$_POST['IdCiudad'];
$idButon=0;
?>


<!DOCTYPE html>
<html>


<head>

<style type="text/css">
   
</style>

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
         <script src="js/funciones.js"></script>
          <script src="js/jquery-1.11.3.min.js"></script>
        <link href='images/letra' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style10.css" />        <link rel="stylesheet" type="text/css" href="funciones.inc" />



    </head>


<h1>CARGA DE DATOS</h1>

	<br>

 <body>
    <form method="post" action="action.php" enctype="multipart/form-data">
        <table  id="tablaAlineamientos" border="2px" align="center"> <!-- Lo cambiaremos por CSS -->
<tr style="padding: 0%">
	<td align="center" style="font-size:200%; font-weight: bold; background-color: #5bb2d4;;width:300px;">Equipo</td>
	<td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:100px;">Criticidad</td>
	<td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:100px">Tipo desvío</td>
	<td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:350px">Detalle del desvío</td>
    <td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:350px">Imagen</td>
</tr>
<?php

if ($_POST['insp']==1) { //si es auditoria


 $Listado = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT nombreEquipo FROM equipo where idSector=$sect AND audit='a'";//traer agua y elementos de limpieza

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
        	
?>
<tr>
        	<td  style="font-size:150%;"> <input style="width:300px; " type="" class="equipo" name="equipo[]" value="

<?php

          echo  $Listado[$i]['NOMBRE_ZONA'] = utf8_encode(($data['nombreEquipo'])); //completar agua y elementos de limpieza si es auditoría
            ?>"></td>

	<td  align="left" style="padding: 0%;"><select name= "criticidad[]" id="criticidad[]" style=" width:100px; height:25px; margin: 1%; font-size: 100%; padding: 0%; background-color: transparent; " class="select-css" ><option>NV</option><option>AC</option><option>NA</option><option>NAC</option></select></td>

	<td align="left" style="padding: 0%;"> <select name="tipo[]" style=" width:100px; height:25px; margin: 1%; font-size: 100%; padding: 0%; background-color: transparent; " class="select-css" ><option value="0" selected="selected">--</option><option>SSOP</option><option>MTO</option></select> </td>

	<td align="center" style="margin: 2px;">
 <input name="observaciones[]" type="text" style="width: 230px;">
         <button type="button" id="<?php echo $i; ?>" onclick="addRow();" class="btn btn-circle" style="padding-right: 0; padding-bottom: 20px;">+</button>
</td>
<td><input class="imag" type="file" name="Imagen[]" /></td>

</tr> 
<?php

            $i++;
        }
        $idButon=$idButon+$i;
    }



}; ?>
        
<!-- desde aquí empiezo a cargar las zonas -->

          <?php
        for ($i = 0; $i < $cntZonas; $i++) {
        ?>

        <tr>
            <td align="center" colspan="5" style="font-size:200%; font-weight: bold; background-color: #5bb2d4;"><?php 

$zonai=$Zonas[$i]['ID_ZONA'] ;
            echo utf8_encode($Zonas[$i]['NOMBRE_ZONA']) ;

            ?> 
            </td> 

        </tr>
<!-- Aquí empiezo a cargar los equipos -->
<?php
$Equipo = Listar_Equipo($zonai);
$cntEquipo = count($Equipo);

for ($j = 0;$j < $cntEquipo;$j++) {
        ?>
 <tr align="left">
            <td style="font-size:150%;" ><input style="width:300px;" type="" class="equipo" name="equipo[]" value="<?php echo $Equipo[$j]['NOMBRE_EQUIPO'] ; ?> ">
            </td> 


    <td  align="center" style="padding: 0%;"><select name="criticidad[]" id="criticidad[]" style=" width:100px; height:25px; margin: 1%; font-size: 100%; padding: 0%; background-color: transparent; " class="select-css" ><option>NV</option><option>AC</option><option>NA</option><option>NAC</option></select></td>

    <td align="center" style="padding: 0%;"> <select name="tipo[]" style=" width:100px; height:25px; margin: 1%; font-size: 100%; padding: 0%; background-color: transparent; align-self: center;" class="select-css"><option value="0" selected="selected" >--</option><option>SSOP</option><option>MTO</option></select> </td>

   <td align="center" style="margin: 2px;">
 <input type="text" style="width: 230px;" name="observaciones[]">
         <button type="button" id="<?php echo $idButon; ?>" onclick="addRow();" class="btn btn-circle" style="padding-right: 0; padding-bottom: 20px;">+</button>
</td>
<td><input class="imag" type="file" name="Imagen[]" /></td>

        </tr>
        <?php
        $idButon=$idButon+1;
        }

    }
        ?>
        </table>
        <br>
        <br>

<input style="visibility:hidden" type="" name="IdProvinciaElegida" value=" <?php echo  $_POST['Provincia'] ?>">
<input style="visibility:hidden" type="" name="IdCiudad" value=" <?php echo  $_POST['IdCiudad'] ?>">
<input style="visibility:hidden" type="" name="insp" value=" <?php echo  $_POST['insp'] ?>">

  <div  style="text-align:center;">

          <input type="submit" style='width:250px; height:35px' name="Enviar" value="Alta Inspección" class="btn-material" style=" display: flex;align-items: center; justify-content: center; " onclick=""  />

            </div>


</form>
    </body>
<br>
 <br>
            
<br>




</html>