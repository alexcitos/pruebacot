<?php

//include_once("include/mysql_conf.php");
/*
if (!$basedatos) {

	echo "<br><CENTER><span class=\"tex_menu\">

				                               Problemas de conexion con la base de datos.

				                               </CENTER>";

	exit;

}
*/


//GUARDA LA COTIZACION
include("guarda_cotizacion.php");

/* Definición de los meses del año en castellano */



$mes[0]="-";

$mes[1]="enero";

$mes[2]="febrero";

$mes[3]="marzo";

$mes[4]="abril";

$mes[5]="mayo";

$mes[6]="junio";

$mes[7]="julio";

$mes[8]="agosto";

$mes[9]="septiembre";

$mes[10]="octubre";

$mes[11]="noviembre";

$mes[12]="diciembre";



/* Definición de los días de la semana */



$dia[0]="Domingo";

$dia[1]="Lunes";

$dia[2]="Martes";

$dia[3]="Mi&eacute;rcoles";

$dia[4]="Jueves";

$dia[5]="Viernes";

$dia[6]="S&aacute;bado";



/* Implementación de las variables que calculan la fecha */



$gisett=(int)date("w");

$mesnum=(int)date("m");



/* Variable que calcula la hora

*/



$hora = date(" H:i",time());



?>



<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link  type="text/css" rel="stylesheet" href="style/style.css">

<script src="js/ajax.js"></script>

<script>

function valores(){



	combo = opener.document.getElementById('curso');

	//document.getElementById('div_curso').innerHTML = combo.value;



	combo = opener.document.getElementById('paisCentro');

	document.getElementById('div_pais').innerHTML = combo.options[combo.selectedIndex].text;



	combo = opener.document.getElementById('ciudadCentro');

	document.getElementById('div_ciudad').innerHTML = combo.options[combo.selectedIndex].text;



	combo = opener.document.getElementById('centro');

	document.getElementById('div_centro').innerHTML = combo.options[combo.selectedIndex].text;



	combo = opener.document.getElementById('semanasCurso');

	document.getElementById('div_semanasCurso').innerHTML = combo.options[combo.selectedIndex].text;



	combo = opener.document.getElementById('leccionesSemana');

	document.getElementById('div_leccionesSemana').innerHTML = combo.options[combo.selectedIndex].text;



	combo = opener.document.getElementById('jornadaLecciones');

	document.getElementById('div_jornadaLecciones').innerHTML = combo.options[combo.selectedIndex].text;



	combo = opener.document.getElementById('alojamiento');

	document.getElementById('div_alojamiento').innerHTML = combo.options[combo.selectedIndex].value;



	if (combo.options[combo.selectedIndex].value == 'Si'){

		combo = opener.document.getElementById('semanas_alojamiento');

		document.getElementById('div_semanas_alojamiento').innerHTML = combo.options[combo.selectedIndex].value;



		combo = opener.document.getElementById('tipo_alojamiento');

		document.getElementById('div_tipo_alojamiento').innerHTML = combo.options[combo.selectedIndex].text;



		combo = opener.document.getElementById('tipo_alimentacion');

		document.getElementById('div_tipo_alimentacion').innerHTML = combo.options[combo.selectedIndex].text;



	}



	combo = opener.document.getElementById('traslado');

	document.getElementById('div_traslado').innerHTML = combo.options[combo.selectedIndex].value;



	combo = opener.document.getElementById('seguro');

	document.getElementById('div_seguro').innerHTML = combo.options[combo.selectedIndex].value;



	combo = opener.document.getElementById('pasaje');

	//document.getElementById('div_pasaje').innerHTML = combo.value;



	//VALORES INVERSION

	combo = opener.document.getElementById('tipo_moneda');

	document.getElementById('tipo_moneda').innerHTML = "<b>"+combo.options[combo.selectedIndex].text+"</b>";



	document.getElementById('valor_curso').innerHTML = opener.document.getElementById('valor_curso').innerHTML;

	document.getElementById('valor_inscripcion').innerHTML = opener.document.getElementById('valor_inscripcion').innerHTML;

	document.getElementById('valor_alojamiento').innerHTML = opener.document.getElementById('valor_alojamiento').innerHTML;

	document.getElementById('valor_traslado').innerHTML = opener.document.getElementById('valor_traslado').innerHTML;

	//document.getElementById('valor_pasaje').innerHTML = opener.document.getElementById('valor_pasaje').value;

	document.getElementById('valor_envio').innerHTML = opener.document.getElementById('valor_envio').innerHTML;

	document.getElementById('valor_seguro').innerHTML = opener.document.getElementById('valor_seguro').innerHTML;

	document.getElementById('valor_visa').innerHTML = opener.document.getElementById('valor_visa').innerHTML;

	document.getElementById('total').innerHTML = opener.document.getElementById('td_total').innerHTML;

	document.getElementById('total_pesos').innerHTML = opener.document.getElementById('td_total_pesos').innerHTML;

	

	self.print();



}

</script>

</head>



<body onLoad="valores()">
<table width="633" border="0" cellpadding="2" cellspacing="1" class="tabla_cotizador" align="center">

	<tr class="titulo_tabla_cotizacion">
	  <td colspan="3" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td colspan="2" bgcolor="#FFFFFF"><img src="images/logoconsejeriap.png" width="194" height="80"></td>
        </tr>
        <tr>
          <td width="76%"><b>Cotizaci&oacute;n programa para estudios de Ingl&eacute;s  </b></td>
          <td width="24%"><div align="right"><b># <?php echo $numero_cotizacion; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $dia[$gisett].", ".date("d")." de ".$mes[$mesnum]." de ".date("Y"); ?></div></td>
        </tr>
      </table></td>
  </tr>
	

	

	<tr>

		<td valign="top">

			<table cellpadding="5">

				<tr>

					<td width="111" align="left">Pais</td>

					<td id="div_pais" align="right">--</td>
				</tr>

				<tr>

					<td align="left">Ciudad</td>

					<td id="div_ciudad" align="right">--</td>
				</tr>

				<tr>

					<td align="left">Centro</td>

					<td id="div_centro" align="right">--</td>
				</tr>

				<tr>

					<td align="left">Semanas curso</td>

					<td id="div_semanasCurso" align="right">--</td>
				</tr>

				<tr>

					<td align="left">Lecciones por Semana</td>

					<td id="div_leccionesSemana" align="right">--</td>
				</tr>

				<tr>

					<td align="left">Jornada lecciones</td>

					<td align="right" id="div_jornadaLecciones">--</td>
				</tr>
	  </table>		</td>

		<td width="186" valign="top"><table cellpadding="5">

          <tr>
            <td width="111" >Alojamiento</td>
           <td id="div_alojamiento" align="right">--</td>
          </tr>
          <tr>
            <td>Semanas Alojamiento</td>
            <td id="div_semanas_alojamiento" align="right">--</td>
          </tr>
          <tr>
            <td>Tipo Alojamiento</td>
            <td id="div_tipo_alojamiento" align="right">--</td>
          </tr>
          <tr>
            <td>Tipo Alimentaci&oacute;n</td>
           <td id='div_tipo_alimentacion' align="right">--</td>
          </tr>
          <tr>
            <td>Traslado</td>
           <td id='div_traslado' align="right">--</td>
          </tr>
          <tr>
            <td>Seguro</td>
            <td id='div_seguro' align="right">--</td>
          </tr>
          
      </table></td>
	    <td width="1%" rowspan="2" valign="top" id="div_cotizacion"><table width="200" border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
          <tr>
            <td bgcolor="#FFFFFF"><table cellpadding="3" cellspacing="1" class="tabla_cotizacion" width="100%">
                <tr>
                  <td align="center" colspan="2" class="titulo_tabla_cotizacion"><b>INVERSION</b></td>
                </tr>
                <tr>
                  <td width="102"><b>Tipo Moneda</b></td>
                  <td id='tipo_moneda' width="86" align="right">--</td>
                </tr>
                <tr>
                  <td>Curso</td>
                  <td id='valor_curso' width="86" align="right">--</td>
                </tr>
                <tr>
                  <td>Inscripci&oacute;n</td>
                  <td id='valor_inscripcion' align="right">--</td>
                </tr>
                <tr>
                  <td>Estadia</td>
                  <td id='valor_alojamiento' align="right">--</td>
                </tr>
                <tr>
                  <td>Traslado</td>
                  <td id='valor_traslado' align="right">--</td>
                </tr>
                <tr>
                  <td>Gastos de Env&iacute;o</td>
                  <td id='valor_envio' align="right">--</td>
                </tr>
                <tr>
                  <td>Seguro</td>
                  <td id='valor_seguro' align="right">--</td>
                </tr>
                <tr>
                  <td>Derechos Visa</td>
                  <td id='valor_visa' align="right">--</td>
                </tr>
                <tr>
                  <td height="1" colspan="2" bgcolor="#666666"></td>
                </tr>
                <tr>
                  <td><b>TOTAL</b></td>
                  <td id='total' align="right">--</td>
                </tr>
                <tr>
                  <td colspan="2" align="right" id='total_pesos'></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
	</tr>

	
	<tr valign="top">
	  <td colspan="2" align="center" bordercolor="#FF0000"><div align="justify"><span class="Estilo3">
     Para
      
      Reino Unido se toman los valores en libras esterlinas
      
       sujetos a cambios sin previo aviso. Valores en otras monedas
      
      son informativos. Pagos en pesos a la tasa CB 
      
      del dia de pago</span></div>
      <br>
      Validez de la presente cotizaci&oacute;n 7 d&iacute;as </td>
  </tr>
	<tr valign="top">

          <td align="center" colspan="3" bordercolor="#FF0000"> <blockquote>
            <div align="right"><strong><font size="4">&copy;

                </font></strong><font size="1" >Consejer&iacute;a

                Britanica Ltda.<br>

                Derechos de autor 2005-2009</font></font></div>

            </blockquote></td>
        </tr>
    </table>

</html>