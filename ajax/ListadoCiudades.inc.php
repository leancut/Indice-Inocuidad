<?php
//este script es al que apunta desde el jquery
//
//llamamos a las funciones, de conexion y de listados... 
//noten que estan una carpeta encima de la nuestra, aqui estamos dentro de ajax/....
require_once '../funciones/funciones_conexion.inc.php';
require_once '../funciones/funciones.inc.php';

$Ciudades = array();
$cntCiudades = 0;
//valido que la variable que me llega es la que viene por POST, la cual debiera tener valor y ser numerica.
if (!empty($_POST['IdProvinciaElegida']) && is_numeric($_POST['IdProvinciaElegida'])) {
	//de ser asi, genero el listado de ciudades que pertenezcan a esa provincia elegida.
    $Ciudades = Listar_Ciudades($_POST['IdProvinciaElegida']);  //le paso por parametro este valor
    $cntCiudades = count($Ciudades);
}
?>

<!-- noten que esta parte del codigo no es toda una pagina html, sino solamente la seccion que necesitamos actualizar -->

<select name="IdCiudad" id="ciudad" class="select-css">
	   <option value="0">Selecciona el sector...</option>
    <?php for ($i= 0; $i< $cntCiudades; $i++) { ?>
        <option value="<?php echo $Ciudades[$i]['ID_CIUDAD']; ?>"><?php echo $Ciudades[$i]['NOMBRE_CIUDAD']; ?></option>
    <?php } ?>
        
</select>

