<?php
function Listar_Provincias() {

    $Listado = array();
	//me conecto
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {
		//y genero la consulta de las provincias
        $SQL = "SELECT * FROM planta ";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['idPlanta'];
            $Listado[$i]['NOMBRE'] = utf8_encode($data['nombPlanta']);
            $i++;
        }
    }
    return $Listado;
}

function Tipos_Insp() {

    $Listado = array();
    //me conecto
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {
        //y genero la consulta de las provincias
        $SQL = "SELECT * FROM tipoinsp";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID'] = $data['idInsp'];
            $Listado[$i]['INSP'] = utf8_encode($data['Insp']);
            $i++;
        }
    }
    return $Listado;
}

function Listar_Ciudades($IdProvinciaElegida) {

    $Listado = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT * FROM sectores where nombrePlanta=$IdProvinciaElegida ORDER BY 2";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['ID_CIUDAD'] = $data['idSector'];
            $Listado[$i]['NOMBRE_CIUDAD'] = utf8_encode($data['nombreSector']);
            $i++;
        }
    }
    return $Listado;
}


function validar_CargaDatos1(){
    if (empty($_POST['insp'] )) {

$message = "Por favor cargue el tipo de inspección";
echo "<script type='text/javascript'>alert('$message');</script>";
           ;}

            else{
                if (empty($_POST['Provincia']))
                {

$message = "Por favor cargue la planta";
echo "<script type='text/javascript'>alert('$message');</script>";

                    
                }else{
                    if(empty($_POST['Ciudad'])){

$message = "Por favor cargue el sector";
echo "<script type='text/javascript'>alert('$message');</script>";


                    }else
                    {
                        return false;
                    }
                }
            }
}

function validarForm(){
    if(validar_CargaDatos1() == false)
      return false;
    else{
      return true;
}
}

function Listar_Zona($IdSector) {

    $ListadoZona = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT * FROM zona where idSector=$IdSector";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
             $ListadoZona[$i]['ID_ZONA'] = ($data['idZona']);
            $ListadoZona[$i]['NOMBRE_ZONA'] = utf8_encode($data['nombreZona']);
            $i++;
        }
    }
    return $ListadoZona;
}


function Listar_Zona_INS($IdInsp) {

    $ListadoZona = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT Z.idZona, Z.nombreZona FROM zona AS Z, sectores AS S, inspecciones as I WHERE Z.idSector=S.idSector AND S.idSector=I.sector AND I.idInspec='$IdInsp'";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
             $ListadoZona[$i]['ID_ZONA'] = ($data['idZona']);
            $ListadoZona[$i]['NOMBRE_ZONA'] = utf8_encode($data['nombreZona']);
            $i++;
        }
    }
    return $ListadoZona;
}






function Listar_Equipo($IdZona) {

    $ListadoEquipo = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT * FROM equipo where idZona=$IdZona AND NOT audit='a'";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            $ListadoEquipo[$i]['NOMBRE_EQUIPO'] = utf8_encode($data['nombreEquipo']);
            $i++;
        }
    }
    return $ListadoEquipo;
}

function Listar_Equipo_INSP($IdIns, $nomZona) {

    $Listado = array();
    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT O.nombreEquipo, O.criticidad, O.tipo, O.descripcion, O.imagen FROM observaciones AS O, equipo AS E
WHERE O.idInspec = '$IdIns' AND NOT E.audit = 'a' AND E.nombreEquipo = O.nombreEquipo AND E.idZona='$nomZona'";

        $rs = mysqli_query($MiConexion, $SQL);
        $i = 0;
        while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['NOMBRE_EQUIPO'] = utf8_encode($data['nombreEquipo']);
            $Listado[$i]['CRITICIDAD'] = ($data['criticidad']);
            $Listado[$i]['TIPO'] = ($data['tipo']);
            $Listado[$i]['DESCRIPCION'] = ($data['descripcion']);

$Listado[$i]['IMAGEN'] = ($data['imagen']);

if (empty($Listado[$i]['IMAGEN'])) {
    echo "";
}else{

  //completar agua y elementos de limpieza si es auditoría
            echo "<img src='data:image/jpeg; base64,".base64_encode( $Listado[$i]['IMAGEN'])."'";


}
            $i++;
        }
    }
    return $Listado;
}


function TraerZona($nombreEquipo) {


    $MiConexion = ConexionBD();
    if ($MiConexion != false) {

        $SQL = "SELECT idZona FROM equipo where nombreEquipo=$nombreEquipo";

        $rs = mysqli_query($MiConexion, $SQL);
       
    }
    return $rs;
}


?>
