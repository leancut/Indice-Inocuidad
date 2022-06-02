$(document).on('ready', funcPrincipal);
function funcPrincipal() 
{
	$(".center").on('click', funcNuevoAlineamiento);
    $("tr").on('click', ".btn-circle1", funcEliminarFila);
}

function addRow() {


        var evt = event.srcElement.id;
        var btn_clicked = document.getElementById(evt);
        var tr_referred = btn_clicked.parentNode.parentNode;


    var total= "";
 total = $(tr_referred).find("input").eq(0).val();


        var td = document.createElement('td');
        td.innerHTML= '<td ><input class="equipo" name="equipo[]" value="'+total+'"></td>';
        var td1 = document.createElement('td');
        td1.innerHTML = '<td align="center" class="td1" style="padding: 0%;"><select style="margin-left: auto; margin-right: auto; width:100px; height:25px; margin: 1%; font-size: 100%; padding: 0%; background-color: transparent; " class="select-css" name="criticidad[]"><option value="0" selected="selected">NV</option><option>AC</option><option>NA</option><option>NAC</option></select></td>';
        var td2 = document.createElement('td');
        td2.innerHTML = ' <td align="center" class="td1" style="padding: 0%;"> <select style=" margin-left: auto; margin-right: auto;width:100px; height:25px; margin: 1%; font-size: 100%; padding: 0%; background-color: transparent; " class="select-css"><option value="0" name="tipo[]" selected="selected" disabled="disabled">--</option><option>SSOP</option><option>MTO</option></select> </td>';
        var td3 = document.createElement('td');
        td3.innerHTML = '<td align="center" class="td1" style="margin: 2px; align-items="center";"> <input type="text" style="width: 230px;" name="observaciones[]"><button type="button" id="" class="btn1 btn-circle1" style="padding-right: 0px;">x&nbsp</button></td>';
        var td4 = document.createElement('td');
        td4.innerHTML = '<input class="imag" type="file" name="Imagen[]" />';
        
        var tr = document.createElement('tr');

        tr.appendChild(td);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr_referred.parentNode.insertBefore(tr, tr_referred.nextSibling).fadeIn("slow");
        return tr;
    }

function funcEliminarFila() 
{
    $(this).parent().fadeOut( "slow", function() { $(this).remove(); } );
}

function pulsar() {
alert("Se ha ingresado la inspección");
window.location.href = '#';

}

function f_Cmb(){       
        document.frm.action="ConsultaInsp2.php";
        document.frm.submit();
}

function f_Cmb1(){      
        document.frm.action="ConsultaInsp2imprimir.php";
        document.submit();
}


function resultado(){
      var filas = $("#tablaAlineamientos").find("tr"); //devulve las filas del body de tu tabla segun el ejemplo que brindaste
      var resultado = "";
    for(i=0; i<filas.length; i++){ //Recorre las filas 1 a 1
        var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila
        equipo = $(celdas[0]).text();
        tipo= $($(celdas[1]).children(".tipo")[0]).text();
    margen_compra = $($(celdas[3]).children("input")[0]).text();
    impuesto = $($(celdas[4]).children("input")[0]).val();
        
    resultado += equipo+" - "+tipo+" - "+costo_base+" - "+margen_compra+" - "+impuesto+"\n";
    }
    
    alert(resultado)
  }