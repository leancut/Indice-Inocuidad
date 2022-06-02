<?php
require_once 'funciones/funciones_conexion.inc.php';
require_once 'funciones/funciones.inc.php';
require_once 'funciones/funciones.inc.php';
//esta funcion la declaramos en el script respectivo de funciones.inc.php
$idInsp=$_POST['IDNSPE'];

$insa=$idInsp[0];

$Zonas = Listar_Zona_INS($idInsp);
$cntZonas = count($Zonas);
    $MiConexion = ConexionBD();

?>

<!DOCTYPE html>
<html>


<head>

<style type="text/css">
       body {
        font-family: 'Helvetica'
    }
</style>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- agrego la libreria q voy a utilizar -->
         <title>INICIO - IS</title>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Creative CSS3 Animation Menus" />
        <meta name="keywords" content="menu, navigation, animation, transition, transform, rotate, css3, web design, component, icon, slide" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link href='images/letra' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style10.css" />


    </head>


<h1 style="font-size: 60%;">CONSULTA DE INSPECCIÓN</h1>

    <br>

 <body>
        <table  id="tablaAlineamientos" border="2px" align="center"> <!-- Lo cambiaremos por CSS -->
<tr style="padding: 0%">
    <td align="center" style="font-size:100%; font-weight: bold; background-color: #5bb2d4;;width:200px">Equipo</td>
    <td align="center" style="font-size:100%; font-weight: bold;background-color: #5bb2d4;width:80px">Criticidad</td>
    <td align="center" style="font-size:100%; font-weight: bold;background-color: #5bb2d4;width:80px">Tipo desvío</td>
    <td align="center" style="font-size:100%; font-weight: bold;background-color: #5bb2d4;width:150px">Detalle del desvío</td>
    <td align="center" style="font-size:100%; font-weight: bold;background-color: #5bb2d4;width:250px">Imagen</td>
</tr>
<?php

if ($insa=="A") { //si es auditoria


 $Listado = array();
    $MiConexion = ConexionBD();

        $SQL = "SELECT O.nombreEquipo, O.criticidad, O.tipo, O.descripcion, O.imagen FROM observaciones AS O, equipo AS E
WHERE O.idInspec = '$idInsp' AND E.audit = 'a' AND E.nombreEquipo = O.nombreEquipo LIMIT 0 , 3";//traer agua y elementos de limpieza

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            
?>
<tr class="equipo" style="font-size: 50%;">
            <td  style="text-align: left;"> 

<?php

          echo  $Listado[$i]['NOMBRE_ZONA'] = utf8_encode(($data['nombreEquipo'])); //completar agua y elementos de limpieza si es auditoría
            ?></td>

    <td  align="left" style="padding: 0%;">
       <?php

          echo  $Listado[$i]['CRITICIDAD'] = (($data['criticidad'])); //completar agua y elementos de limpieza si es auditoría
            ?>
    </td>

    <td align="left" style="padding: 0%;"> 
<?php

 $Listado[$i]['TIPO'] = (($data['tipo']));
if ( $Listado[$i]['TIPO']== "0" ) {
 echo "";
}else{
    echo $Listado[$i]['TIPO'];
}

            ?>
    </td>

    <td align="center" style="margin: 2px;">
<?php

          echo  $Listado[$i]['DESCRIPCION'] = (($data['descripcion'])); //completar agua y elementos de limpieza si es auditoría
            ?>
</td>

<td>
<?php

$Listado[$i]['IMAGEN'] = ($data['imagen']);

if (empty($Listado[$i]['IMAGEN'])) {
    echo "";
}else{

?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode(($Listado[$i]['IMAGEN'])); ?>" width="180px" height="100px" />
<?php


}
            ?>
</td>

</tr> 
<?php

       $i++;     
        }
    }

//////////////desde aquí empiezo a cargar las zonas -->
 $ListadoZonas = array();


 $SQL1 = "SELECT Z.idZona, Z.nombreZona FROM zona AS Z, sectores AS S, inspecciones as I WHERE Z.idSector=S.idSector AND S.idSector=I.sector AND I.idInspec='$idInsp'";

        $rs1 = mysqli_query($MiConexion, $SQL1);
        $j = 0;
        while ($data1 = mysqli_fetch_array($rs1)) {

            ?>
            <tr style="font-size:80%; font-weight: bold; color: black; background-color: #5bb2d4;">
            <td colspan="5" >
<?php 
 $ListadoZonas[$j]['ID_ZONA']=$data1['idZona'];
 $nomZona= $ListadoZonas[$j]['ID_ZONA'];
echo   $ListadoZonas[$j]['NOMBRE_ZONA'] = utf8_encode(($data1['nombreZona']));



        $ListadoEquipo = array();
         $SQL2 = "SELECT O.nombreEquipo, O.criticidad, O.tipo, O.descripcion, O.imagen FROM observaciones AS O, equipo AS E
WHERE O.idInspec = '$idInsp' AND NOT E.audit = 'a' AND E.nombreEquipo = O.nombreEquipo AND E.idZona='$nomZona'";
 $rs2 = mysqli_query($MiConexion, $SQL2);
        $k = 0;

        //////////////desde aquí empiezo a cargar los equipos -->


        while ($data2 = mysqli_fetch_array($rs2)) {

?>
</tr>
<tr class="equipo" style="font-size: 50%;">
<td style="text-align: left;">
    <?php 
echo $ListadoEquipo[$k]['NOMBRE_EQUIPO'] = utf8_encode(($data2['nombreEquipo']));
    ?>
</td>
<TD>
<?php 
echo $ListadoEquipo[$k]['CRITICIDAD'] = (($data2['criticidad']));
    ?>
    </TD>
<td>
    <?php 
$ListadoEquipo[$k]['CRITICIDAD'] = (($data2['tipo']));
if ($ListadoEquipo[$k]['CRITICIDAD']== "0" ) {
 echo "";
}else{
    echo $ListadoEquipo[$k]['CRITICIDAD'];
}

    ?>
</td>

<td>
    <?php 
echo $ListadoEquipo[$k]['DESCRIPCION'] = (($data2['descripcion']));
    ?>
</td>

<td>
<?php

$ListadoEquipo[$k]['IMAGEN'] = ($data2['imagen']);

if (empty($ListadoEquipo[$k]['IMAGEN'])) {
    echo "";
}else{

?>

        <img src="data:image/jpeg;base64,<?php echo base64_encode(($ListadoEquipo[$k]['IMAGEN'])); ?>" width="180px" height="100px" />
<?PHP } ?>

</td>
</tr>
<?php


$k++;
}
$j++;
}
 ?>




        </table>
        <br>
        <br>

    </body>
<br>

</html>

<?php

use Dompdf\Dompdf;
use Dompdf\Options;
require_once 'dompdf/autoload.inc.php';
$options = new Options();
$dompdf = new DOMPDF();
$options->set('isRemoteEnabled', TRUE);
$options->set('tempDir', '/home2/directory/public_html/directory/pdf-export/tmp');
$dompdf = new Dompdf($options);

$options = new Options();
$options->setIsRemoteEnabled(true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->output();


$dompdf->load_html(ob_get_clean());
$dompdf->set_option('isRemoteEnable', TRUE);

$dompdf->setPaper('A4', 'portrait'); 
$dompdf->render();
$pdf = $dompdf->output();
$pdf= utf8_decode(utf8_encode($pdf));
$filename = "".$idInsp.".pdf";
file_put_contents($filename, $pdf);
$dompdf->stream();




?>