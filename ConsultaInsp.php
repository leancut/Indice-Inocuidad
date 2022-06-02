<?php
require_once 'funciones/funciones_conexion.inc.php';
require_once 'funciones/funciones.inc.php';
require_once 'funciones/funciones.inc.php';
//esta funcion la declaramos en el script respectivo de funciones.inc.php
$Provincias = Listar_Provincias();
$cntProvincias = count($Provincias);

$inpeccs=Tipos_Insp();
$cntInsp = count($inpeccs);
$mensaje="";

?>


<!DOCTYPE html>
<html>


<head>

<style type="text/css">
   
</style>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- agrego la libreria q voy a utilizar -->
         <title>Buscar</title>
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


<h1>CONSULTA INSPECCIÓN</h1>
<br>
<body>
    <form method="post"  enctype="multipart/form-data">
<div style=" position: relative;text-align: center; border-left: : #5bb2d4 2px solid; border-right: #5bb2d4 2px solid;border-top: #5bb2d4 2px solid; letter-spacing: 2px; margin-left: 2px; margin-left: 2px; width: 100%;">
    <p style="font-size: 250%">Ingrese los filtros de búsqueda deseados</p>
    </div>
    <br>
<div style=" display: flex; 
  flex-direction: row; 
  flex-wrap: nowrap;
  justify-content: center; 
  padding: 15px;
">

    <div style="border: solid; width: 350px; border: #5bb2d4 2px solid; padding: 5px; align-items: center; margin-left: 30px; margin-right: 30px; text-align: center; border-radius: 20px; ">
        <p style="font-size: 200%; width: 100%;">Filtrar por Fecha</p>
        <table style="text-align: center; align-items: center; margin: 0px;">
<tr style="text-align: center;">
<br>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td> Desde&nbsp;</td><td><input type="date" name="desde" class="select-css" style="width: 200px; margin: 3px; "></td>
        </tr>
        <tr>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> <td>Hasta&nbsp;&nbsp;&nbsp;</td> <td><input type="date" name="hasta" class="select-css" style="width: 200px; margin: 3px; "></td>
        </tr>
        </table>
    </div>

 <div style="border: solid; width: 350px; border: #5bb2d4 2px solid; padding: 0px; align-items: left; margin-left: 30px; margin-right: 30px; text-align: center; border-radius: 20px; ">
    <br>
    <br>
        <p style="font-size: 200%">Filtrar por Tipo de Inspección</p>
        
         <select class="select-css" style="width: 300px;" name="insp" id="insp" >
                    <option value="" selected="selected" >Selecciona...</option>
                    <?php 
                    //aqui recorro las provincias y las muestro en el primer selector
                    for ($i = 0; $i < $cntInsp; $i++) { ?>
                        <option value="<?php echo $inpeccs[$i]['ID']; ?>"><?php echo $inpeccs[$i]['INSP']; ?></option>
                    <?php } ?>
                </select>
    </div>

 <div style="border: solid; width: 350px; border: #5bb2d4 2px solid; padding: 0px; align-items: left; margin-left: 30px; margin-right: 30px; text-align: center; border-radius: 20px; ">
    <br>
    <br>
        <p style="font-size: 200%">Filtrar por Planta</p>
        
         <div>
                <select class="select-css" style="width: 300px; "name="Provincia" id="provincia" >
                    <option value="0">Selecciona...</option>
                    <?php 
                    //aqui recorro las provincias y las muestro en el primer selector
                    for ($i = 0; $i < $cntProvincias; $i++) { ?>
                        <option value="<?php echo $Provincias[$i]['ID']; ?>"><?php echo $Provincias[$i]['NOMBRE']; ?></option>
                    <?php } ?>
                </select>
            </div>
    </div>

 <div style="border: solid; width: 350px; border: #5bb2d4 2px solid; padding: 0px; align-items: left;  margin-left: 30px; margin-right: 30px; text-align: center; border-radius: 20px; ">
    <br>
    <br>
        <p style="font-size: 200%">Filtrar por Sector</p>
        
         <div id="DivCiudades">
                <!-- esta parte sera actualizada por la respuesta de ajax -->
               
                <select name="Ciudad" style="width: 300px;" id="ciudad" class="select-css" >
                    <option value="" selected="selected" disabled="disabled">Primero seleccionar una planta...</option>
                </select>
            </div>
    </div>
</div>
<div style="text-align: center; border-left: #5bb2d4 2px solid; border-right: #5bb2d4 2px solid;border-bottom: #5bb2d4 2px solid; padding: 10px;">
<input type="submit" class="btn-material" value="Buscar Inspección" name="enviar" style='width:250px; height:35px; text-align: center;'>
</div>
	<br>
</form>
 <br>
 <br>

        <table  id="tablaAlineamientos" border="2px" align="center"> <!-- Lo cambiaremos por CSS -->
<tr style="padding: 0%">
	<td align="center" style="font-size:200%; font-weight: bold; background-color: #5bb2d4;;width:200px;" colspan="3">Id Inspección</td>
               
            <td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:250px;">Tipo de inspección</td>

	<td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:150px;">Fecha</td>
        <td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:150px;">Hora</td>
	<td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:200px;">Planta</td>
	<td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:200px;">Sector</td>
                <td align="center" style="font-size:200%; font-weight: bold;background-color: #5bb2d4;width:200px;">Inspector</td>
</tr>



<?php  


$ListadoEquipo = array();

    $MiConexion = ConexionBD();

$SQL="";

if (isset($_POST['enviar'])) {

////desde acá si no hay fecha//////////////////////
    if (empty($_POST['desde'])) {
 if (empty($_POST['hasta'])) {


if (empty($_POST['insp'])) {

  if (empty($_POST['Provincia'])) {

if (empty($_POST['IdCiudad'])) {
   echo '<script type="text/javascript">alert("Por favor ingrese algun criterio de busqueda");</script>'; 
}

}else{

if(empty($_POST['IdCiudad'])){


    $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp  FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.planta= {$_POST['Provincia']} ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}

}else{

    $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.sector= {$_POST['IdCiudad']} ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
        if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}


}
}
}else{
        if (empty($_POST['Provincia'])) {

                $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.tipoInsp= {$_POST['insp']} ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
        if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}

              
        }else{

if(empty($_POST['IdCiudad'])){



    $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp  FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.planta= {$_POST['Provincia']} AND I.tipoInsp= {$_POST['insp']} ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
        if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}



}else{

    $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp  FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.sector= {$_POST['IdCiudad']} AND I.tipoInsp= {$_POST['insp']} ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
        if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}


}
}
}     
}
}else{
        /////////////si hay fecha///////////////////
        if (empty($_POST['hasta'])) {
                 echo '<script type="text/javascript">alert("Por favor ingrese hasta que fecha desea realizar la busqueda");</script>'; 
        echo "aca";
}else{
        if ($_POST['hasta']<$_POST['desde']) {
               echo '<script type="text/javascript">alert("La fecha de inicio de busqueda no puede ser mayor a la final");</script>'; 
        }else{
     
if(empty($_POST['insp'])){
        if (empty($_POST['IdCiudad'])) {
            if (empty($_POST['Provincia'])) {
/////////////si ha fecha, no hay inspeccion, no hay planta, no hay sector////////////////////

 $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.fechaIns BETWEEN '{$_POST['desde']}' AND '{$_POST['hasta']}'";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
        if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}




            }


        }else{

     ////////// si hay fecha, si hay sector, no hay  inspección          

      $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.sector= {$_POST['IdCiudad']} AND I.fechaIns BETWEEN '{$_POST['desde']}' AND '{$_POST['hasta']}'";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}


        }


        }else{
////////////si hay fecha, si hay inspección
if (empty($_POST['Provincia'])) {
       if (empty($_POST['IdCiudad'])) {

        ///////////solo por fecha, si inspección, no planta, no sector
             
      $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND  I.tipoInsp= {$_POST['insp']} AND I.fechaIns BETWEEN '{$_POST['desde']}' AND '{$_POST['hasta']}'";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}




       }else{
/////si fecha, si inspeccion, si sector


      $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND  I.tipoInsp= {$_POST['insp']} AND I.fechaIns BETWEEN '{$_POST['desde']}' AND '{$_POST['hasta']}' AND I.sector= {$_POST['IdCiudad']}";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}



       }
}else{


//////////si hay una fecha e inspección, SI planta, no sector////////////////////////

                $SQL="SELECT I.idInspec as idInspec, DATE_FORMAT(I.fechaIns, '%d/%m/%Y %H:%i') as fechaIns , I.inspector, P.nombPlanta as planta, S.nombreSector as sector, IP.Insp as tipoInsp FROM inspecciones as I, planta as P, sectores as S, tipoinsp as IP WHERE P.idPlanta=I.planta AND S.idSector=I.sector AND IP.idInsp=I.tipoInsp AND I.tipoInsp= {$_POST['insp']} AND I.fechaIns BETWEEN '{$_POST['desde']}' AND '{$_POST['hasta']}' AND I.planta= {$_POST['Provincia']}";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {

?>               <form method="post" action="ConsultaInsp2.php" enctype="multipart/form-data">
                 <tr style="font-size: 120%;"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;"><button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 25px; height: 25px; background: transparent;" src="images/lupa.ico"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);
            ?></td><input style="visibility:hidden; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" >
    </form>
 <form method="post" action="ConsultaInsp2imprimir.php" enctype="multipart/form-data"><td style=" margin: 0px; height: 10px; width:50px; border-right: 0.001em transparent solid;">
                 <button type="submit" class="material1" style="border: 0px; background: transparent; padding-top: 2px; margin-bottom: 0px;"><img style=" margin: 0px; width: 20px; height: 20px; background: transparent;" src="images/imprimir.png"></button><?php
            $ListadoEquipo[$i]['ID'] = ($data['idInspec']);?><input style="visibility:hidden ; width: 0px; height: 0px;" type="text" name="IDNSPE" value="<?php echo $ListadoEquipo[$i]['ID'];?>" > </td>
    </form>

<td style="font-size: 120%; text-align:left; "><?php  
             echo $ListadoEquipo[$i]['ID']; ?> </td>

<?php
            $ListadoEquipo[$i]['TIPO'] = ($data['tipoInsp']);?>
            <td style="font-size: 120%;"><?php
            echo  utf8_encode($ListadoEquipo[$i]['TIPO']);?>
            </td>           
            <?php  
            $ListadoEquipo[$i]['FECHA'] = ($data['fechaIns']);
            ?><td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 0, -6));?>
            </td>
<td style="font-size: 120%;"><?php  
            echo  (substr($ListadoEquipo[$i]['FECHA'], 11));?>
            </td>
            <?php  
            $ListadoEquipo[$i]['PLANTA'] = ($data['planta']);?>
            <td style="font-size: 120%;"><?php  
            echo  $ListadoEquipo[$i]['PLANTA'];?>
            </td><?php  
            $ListadoEquipo[$i]['SECTOR'] = utf8_encode(($data['sector']));?>
            <td style="font-size: 120%;"><?php
            echo  $ListadoEquipo[$i]['SECTOR'];?>
            </td>
<td></td>
            <?php
            $i++;
            ?></tr><?php
        }
        if (mysqli_num_rows ($rs)==0) {
        $mensaje= "<tr><h1>No hay concidencias con los criterios de búsqueda</h1></tr>";
}

}
        }
}
}
}
}

?>

</table>

<?php echo $mensaje; ?>


    </body>
<br>
 <br>
            
<br>

<div style="text-align: center;">
    <button class="btn-material"  onclick="window.location='index.html'"> HOME </button>


</html>