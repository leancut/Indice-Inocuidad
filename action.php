 <!DOCTYPE html>
<html>
 <link href='images/letra' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style10.css" />
<body>
 <?php 
require_once 'funciones/funciones_conexion.inc.php';

$MiConexion = ConexionBD();

if($_POST['insp']==1)
$aux="A-";

if($_POST['insp']==2)
$aux="S-";

if($_POST['insp']==3)
$aux="C-";

if($_POST['insp']==4)
$aux="P-";

if($_POST['insp']==5)
$aux="L-";

    $Id="";
    if ($MiConexion != false) {

        $SQL = "SELECT idInspec FROM inspecciones WHERE idInspec like '$aux%' ORDER BY idInspec DESC LIMIT 1";

        $rs = mysqli_query($MiConexion, $SQL);
        
        while ($data = mysqli_fetch_array($rs)) { 
        	$Id = ($data['idInspec']);
        	$Id=$aux.(int)(substr($Id, 2)+1);
 } }


$bandera=0;
$equipo=$_POST['equipo'];  
$criticidad=$_POST['criticidad']; 
$tipo=$_POST['tipo']; 
$observaciones=$_POST['observaciones']; 
$nombreIm=$_FILES['Imagen']['name'];
$tamañoIm=$_FILES['Imagen']['size'];
$carpeta=$_SERVER['DOCUMENT_ROOT'].'Indice/';
$tmp=$_FILES['Imagen']['tmp_name'];
$filas=sizeof($equipo);

if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

for ($i=0; $i < $filas; ++$i) { 
if ($criticidad[$i]=="AC" || $criticidad[$i]=="NV") {

if ($tipo[$i]=="0"){

	if ($observaciones[$i]=="") {
		$bandera=0;
	}else{
		$bandera=1;
echo '<script type="text/javascript">alert("No hay desv\u00edos seleccionados para el \u00edtem ' . utf8_encode($equipo[$i]).'	, por favor borre la observaci\u00f3n o ingrese la criticidad y tipo de desv\u00edo.");window.history.back();</script>';
break;
	}
	
}else{
$bandera=1;
echo '<script type="text/javascript">alert("El desv\u00edo para el \u00edtem ' .utf8_encode($equipo[$i]). ' figura como ' .$criticidad[$i].' por lo tanto no puede recibir desv\u00edos del tipo '.$tipo[$i].', por favor correjir");window.history.back();</script>';
break;
		

}

}


else
{
if ($tipo[$i]=="0") 
{
	$bandera=1;
	echo '<script type="text/javascript">alert("Ingrese el tipo de desv\u00edo del \u00edtem ' . utf8_encode($equipo[$i]). '");window.history.back();</script>';
break;
}
else
{
if($observaciones[$i]=="")
{
	$bandera=1;
	echo '<script type="text/javascript">alert("Describa la observaci\u00f3n para el desv\u00edo del \u00edtem ' . utf8_encode($equipo[$i]). '");window.history.back();</script>';
break;
}else{
		$bandera=0;
}
}
}
}


if ($bandera==0) {

for ($i=0; $i < $filas; ++$i) { 
$idZona="";

if (($nombreIm[$i])=="") {
$imag[$i]="";
	}else{
move_uploaded_file($tmp[$i], $carpeta.$nombreIm[$i]);
$imagenObj[$i]= fopen($carpeta.$nombreIm[$i] , "r");
$imag[$i]=fread($imagenObj[$i], $tamañoIm[$i]);
$imag[$i]=addslashes($imag[$i]);
fclose($imagenObj[$i]);
}
$equipo[$i]=utf8_decode($equipo[$i]);
$equi=$equipo[$i];
$idZona="";

    if ($MiConexion != false) {

$SQL1 = "SELECT idZona FROM equipo WHERE nombreEquipo='$equi' AND idSector={$_POST['IdCiudad'] }";
 $rs = mysqli_query($MiConexion, $SQL1);
 while ($data = mysqli_fetch_array($rs)) { 
        	$idZona = ($data['idZona']);
        	break;
 }

       
       }
        
        


	$SQL="INSERT INTO observaciones ( nombreEquipo, criticidad, tipo, descripcion, imagen,idInspec) VALUES ( '$equipo[$i]', '$criticidad[$i]', '$tipo[$i]', '$observaciones[$i]', '$imag[$i]','$Id')";




mysqli_query($MiConexion, $SQL);

}
$SQL0="INSERT INTO inspecciones ( idInspec, fechaIns, inspector, planta, sector, zona, tipoinsp) VALUES ( '$Id', now(), '', '{$_POST['IdProvinciaElegida']}', '{$_POST['IdCiudad']}','$idZona','{$_POST['insp']}' )";

mysqli_query($MiConexion, $SQL0);
echo '<script type="text/javascript">alert("La inspecci\u00f3n se ingres\u00f3 correctamente");location.href="index.html";</script>';
}




?>
</body>
</html>
