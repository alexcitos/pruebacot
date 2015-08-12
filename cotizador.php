<?php

include_once("include/mysql_conf.php");

if (!$basedatos) {

	echo "<br><CENTER><span class=\"tex_menu\">

				                               Problemas de conexion con la base de datos.

				                               </CENTER>";

	exit;

}

?>



<link  type="text/css" rel="stylesheet" href="style/style.css">

<script src="js/ajax.js"></script>

<script>

function alojamiento(valor){

	if (valor == 'no'){

		getDataCotizacion();

	}

}

function imprimir(){

	if (document.getElementById('td_total')){

		window.open('blanco.php','nueva','top=100,left=100,width=650,height=600');
        document.form1.submit();
	}

	else{

		alert("No hay cotizaci�n")

	}

}

function nuevaCotizacion(){

	

	document.getElementById('div_mas_info').style.visibility = '';	

	

	combos = Array('alojamiento','traslado','seguro','pasaje');



	for (c=0;c<combos.length;c++){

		if (document.getElementById(combos[c])){

			combo = document.getElementById(combos[c]);

			combo.value = 'No';

		}

	}

	

	combos = Array('centro','semanasCurso','leccionesSemana',

					'jornadaLecciones','semanas_alojamiento','tipo_alojamiento','tipo_alimentacion');



	for (c=0;c<combos.length;c++){

		if (document.getElementById(combos[c])){

			combo = document.getElementById(combos[c]);

			combo.value = '';

		}

	}



	

	totales = Array('valor_curso','valor_inscripcion','valor_alojamiento','valor_traslado','valor_pasaje','valor_envio',

					'valor_seguro','valor_visa','td_total','td_total_pesos');



	for (c=0;c<totales.length;c++){

		if (totales[c] != 'valor_pasaje'){

			document.getElementById(totales[c]).innerHTML = '--';

		}

		else{

			document.getElementById(totales[c]).value = '';

		}

	}



	//document.getElementById('tipo_moneda').style.display = 'none';



}

function showDivInfo(div_name,accion){

	

	var ancho_body = 950;

	var ancho_div_info = 227;

	

	div = 'div_' + div_name;

		

	document.getElementById('div_cursos').style.visibility = 'hidden';

	document.getElementById('div_alojamiento').style.visibility = 'hidden';

	document.getElementById('div_centros').style.visibility = 'hidden';

	document.getElementById('div_traslado').style.visibility = 'hidden';

	document.getElementById('div_seguro').style.visibility = 'hidden';

	document.getElementById('div_pasaje').style.visibility = 'hidden';



	if (accion == 'mostrar'){



		left = ((docwidth() - ancho_body) / 2 ) + ancho_body - ancho_div_info - 4;

		

		document.getElementById(div).style.left = left + 'px';

		document.getElementById(div).style.visibility = 'visible';

		document.getElementById(div+'_inner').innerHTML = '<img src="info_mas/'+div_name+'.jpg">';



	}

}

function showDivMasInfo(cual,accion,nombre){

	//alert(nombre)

	var ancho_body = 950;

	var ancho_div_info = 227;

	var navegador = navigator.appName;

	

	document.getElementById('div_cursos').style.visibility = 'hidden';

	document.getElementById('div_centros').style.visibility = 'hidden';

	document.getElementById('div_alojamiento').style.visibility = 'hidden';

	document.getElementById('div_traslado').style.visibility = 'hidden';

	document.getElementById('div_seguro').style.visibility = 'hidden';

	document.getElementById('div_pasaje').style.visibility = 'hidden';

	

	if (accion == 'mostrar'){

		

		document.getElementById('div_titulo_mas_info').innerHTML = '';

		document.getElementById('div_td_mas_info').innerHTML = '';

		

		if (navegador == "Microsoft Internet Explorer"){

			left = ((docwidth() - ancho_body) / 2 ) + ancho_body - ancho_div_info - 4;

		}

		else{

			left = ((docwidth() - ancho_body) / 2 ) + ancho_body - ancho_div_info - 11;	

		}

		

		document.getElementById('div_mas_info').style.left = left + 'px';



		/*if (cual == 'Pais' || cual == 'Ciudad'){

			//document.getElementById('div_mas_info').style.height = 376;

			document.getElementById('div_header_mas_info').style.display = '';

			document.getElementById('div_titulo_mas_info').innerHTML = '&nbsp;<b>'+nombre+'</b>';

		}

		else{

			document.getElementById('div_header_mas_info').style.display = 'none';

		}*/

		

		document.getElementById('div_header_mas_info').style.display = 'none';

		document.getElementById('div_mas_info').style.visibility = 'visible';

		document.getElementById('div_td_mas_info').innerHTML = '<img src="info_mas/'+nombre+'.jpg" width="237">';

	}

	else{

		document.getElementById('div_mas_info').style.visibility = '';

	}



}

</script>
<form action="cotizador_print.php" method="post" target="nueva" name="form1">
<!-- DIVS PARA INFO -->

<div id='div_mas_info' class="div_info">

	<table cellpadding="0" cellspacing="0">

		<tr id='div_header_mas_info'>

		<td id='div_titulo_mas_info' class="titulo_div_info" align="left"></td>

		<td class="titulo_div_info"><a href="javascript:showDivMasInfo('','','')">X</a></td>
		</tr>

		<tr>

			<td id='div_td_mas_info' colspan="2"></td>
		</tr>
	</table>
</div>

<div id='div_centros' class="div_info">

	<table cellpadding="0" cellspacing="0" width="100%">

		<!--<tr>

		<td class="titulo_div_info" align="left"><img src="images/tabs/centro_icon.gif" border="0">&nbsp;&nbsp;<b>CENTROS</b></td>

		<td class="titulo_div_info" width="10"><a href="javascript:showDivInfo('div_alojamiento','')">X</a></td>

		</tr>-->

		<tr>

			<td id="div_centros_inner"></td>
		</tr>
	</table>
</div>

<div id='div_cursos' class="div_info">

	<table cellpadding="0" cellspacing="0" width="100%">

		<!--<tr>

		<td class="titulo_div_info" align="left"><img src="images/tabs/curso_icon.gif" border="0">&nbsp;&nbsp;<b>CURSOS</b></td>

		<td class="titulo_div_info" width="10"><a href="javascript:showDivInfo('div_alojamiento','')">X</a></td>

		</tr>-->

		<tr>

			<td id="div_cursos_inner"></td>
		</tr>
	</table>
</div>

<div id='div_alojamiento' class="div_info">

	<table cellpadding="0" cellspacing="0" width="100%">

		<!--<tr>

		<td class="titulo_div_info" align="left"><img src="images/tabs/alojamiento_icon.gif" border="0">&nbsp;&nbsp;<b>ALOJAMIENTO</b></td>

		<td class="titulo_div_info" width="10"><a href="javascript:showDivInfo('div_alojamiento','')">X</a></td>

		</tr>-->

		<tr>

			<td id="div_alojamiento_inner"></td>
		</tr>
	</table>
</div>

<div id='div_traslado' class="div_info">

	<table cellpadding="0" cellspacing="0" width="100%">

		<!--<tr>

		<td class="titulo_div_info" align="left"><img src="images/tabs/traslado_icon.gif" border="0">&nbsp;&nbsp;<b>TRASLADO</b></td>

		<td class="titulo_div_info" width="10"><a href="javascript:showDivInfo('div_traslado','')">X</a></td>

		</tr>-->

		<tr>

			<td id="div_traslado_inner"></td>
		</tr>
	</table>
</div>

<div id='div_seguro' class="div_info">

	<table cellpadding="0" cellspacing="0" width="100%">

		<!--<tr>

		<td class="titulo_div_info" align="left"><img src="images/tabs/seguro_icon.gif" border="0">&nbsp;&nbsp;<b>SEGURO</b></td>

		<td class="titulo_div_info" width="10"><a href="javascript:showDivInfo('div_seguro','')">X</a></td>

		</tr>-->

		<tr>

			<td id="div_seguro_inner"></td>
		</tr>
	</table>
</div>

<div id='div_pasaje' class="div_info">

	<table cellpadding="0" cellspacing="0" width="100%">

		<!--<tr>

		<td class="titulo_div_info" align="left"><img src="images/tabs/pasaje_icon.gif" border="0">&nbsp;&nbsp;<b>PASAJE</b></td>

		<td class="titulo_div_info" width="10"><a href="javascript:showDivInfo('div_pasaje','')">X</a></td>

		</tr>-->

		<tr>

			<td id="div_pasaje_inner"></td>
		</tr>
	</table>
</div>

<table border="0" cellpadding="0" cellspacing="0" width="460">

<tr><td><img src="images/spacer.gif" height="2"></td></tr>



</table>

<table width="450" border="0" cellspacing="0" cellpadding="0" class="tabla_cotizador">
  <tr>
    <td width="169" valign="top"><table cellpadding="1" cellspacing="0" border="0">
      <tr>
        <td><img src="images/dz.gif" width="6" height="9">Paises</td>
      </tr>
      <tr>
        <td>
		<input id="curso" name="curso"  class="select" value="Ingles" type="hidden">
		<span id="div_pais">
         <?php 
		$curso = "Ingles";
		echo "<select id='paisCentro' name='paisCentro' class='select' onchange=\"if(this.value!=''){showDivMasInfo('Pais','mostrar',this.options[this.selectedIndex].text);getData('moneda')}\">";

		echo "<option value=''>[ Seleccione ]</option>";



		$sql = "SELECT DISTINCT nombrePais, idPais FROM curso WHERE nombre='$curso' ORDER by nombrePais ASC";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while ($row_rs = @mysql_fetch_array($rs)){

			$pais = $row_rs[0];

		    $idPais = $row_rs[1];



			echo "<option value='".$idPais."'>".$pais."</option>";

		}



		echo "</select>";
		
		?>
        </span></td>
      </tr>
      <tr>
        <td><img src="images/dz.gif" width="6" height="9">Ciudad</td>
      </tr>
      <tr>
        <td><span id="div_ciudad">
          <select name="select" class="select">
            <option></option>
          </select>
        </span></td>
      </tr>
      <tr>
        <td><img src="images/dz.gif" width="6" height="9">Centro</td>
      </tr>
      <tr>
        <td><span id="div_centro">
          <select name="select" class="select">
            <option></option>
          </select>
        </span></td>
      </tr>
      <tr>
        <td><img src="images/dz.gif" width="6" height="9">Semanas curso</td>
      </tr>
      <tr>
        <td><span id="div_semanasCurso">
          <select name="select" class="select">
            <option></option>
          </select>
        </span></td>
      </tr>
      <tr>
        <td><img src="images/dz.gif" width="6" height="9">Lecciones por Semana</td>
      </tr>
      <tr>
        <td><span id="div_leccionesSemana">
          <select name="select" class="select">
            <option></option>
          </select>
        </span></td>
      </tr>
      <tr>
        <td><img src="images/dz.gif" width="6" height="9">Jornada lecciones</td>
      </tr>
      <tr>
        <td><span id="div_jornadaLecciones">
          <select name="select" class="select">
            <option></option>
          </select>
        </span></td>
      </tr>
    </table></td>
    <td width="152" valign="top"><table cellpadding="1" width="100%" cellspacing="0">
      <tr id='tr_alojamiento'>
        <td><img src="images/dz.gif" width="6" height="9">Alojamiento
          <input name="alimentacion" type="hidden" id="alimentacion" size="8" />
		  <input id='pasaje' name='pasaje' type="hidden" value="No"  >
		  </td>
      </tr>
      <tr id='tr_alojamiento_1'>
        <td><select id='alojamiento' name='alojamiento' class="select_w" onchange="alojamiento(this.value);">
            <option value='No'>No</option>
            <option value='Si'>Si</option>
          </select>        </td>
      </tr>
      <tr id="tr_semanas_alojamiento">
        <td><img src="images/dz.gif" width="6" height="9">Semanas Alojamiento</td>
      </tr>
      <tr id="tr_semanas_alojamiento_1">
        <td><select id='semanas_alojamiento' name='semanas_alojamiento' class="select_w" onchange="getDataCotizacion()">
          -->
            <option value=''></option>
            <?

							for($sem=1;$sem<53;$sem++){

								echo "<option value=$sem>$sem</option>";

							}

							?>
          </select>        </td>
      </tr>
      <tr id="tr_tipo_alojamiento">
        <td><img src="images/dz.gif" width="6" height="9">Tipo Alojamiento</td>
      </tr>
      <tr id="tr_tipo_alojamiento_1">
        <td><select id='tipo_alojamiento' name='tipo_alojamiento' class="select_w" onChange="getData('tipoAlimentacion')">
            <option value=''></option>
            <option value='1'>Sencillo</option>
            <option value='2'>Doble</option>
            <option value='3'>Triple</option>
          </select>        </td>
      </tr>
      <tr id="tr_tipo_alimentacion">
        <td><img src="images/dz.gif" width="6" height="9">Tipo Alimentaci&oacute;n</td>
      </tr>
      <tr id="tr_tipo_alimentacion_1">
        <td><span id='div_tipoAlimentacion'>
          <select id="tipo_alimentacion" class="select_w" name="tipo_alimentacion">
            <option></option>
          </select>
        </span></td>
      </tr>
      <tr id="tr_traslado">
        <td><img src="images/dz.gif" width="6" height="9">Traslado</td>
      </tr>
      <tr id="tr_traslado_1">
        <td><select id='traslado' name='traslado' class="select_w"  onchange="getDataCotizacion()">
            <option value='No' selected>No</option>
            <option value='Si'>Si</option>
          </select>        </td>
      </tr>
      <tr id="tr_seguro">
        <td><img src="images/dz.gif" width="6" height="9">Seguro</td>
      </tr>
      <tr id="tr_seguro_1">
        <td><select id='seguro' name='seguro' class="select_w"  onchange="getDataCotizacion()">
            <option value='No' selected>No</option>
            <option value='Si'>Si</option>
          </select>        </td>
      </tr>
    </table></td>
    <td width="135" rowspan="2" valign="top" id="div_cotizacion">
	
	
	<table cellpadding="3" cellspacing="0" class="tabla_cotizacion" width="100%" border=0>
      <tr>
        <td align="center" colspan="2" class="titulo_tabla_cotizacion"><b>IMPRIMIR</b>&nbsp;&nbsp;<a href="javascript:imprimir()"> <img src="images/cotizador/print.gif" border="0" title="Imprimir Cotizaci�n"> </a></td>
      </tr>
      <tr>
        <td><b>Moneda</b></td>
        <td align='right'><select name='moneda' id='tipo_moneda' class='select_i'>
            <option value='l'>Libras</option>
            <option value='d'>Dolares</option>
            <option value='e'>Euros</option>
            <option value='p'>Pesos</option>
          </select>          </tr>
      <tr>
        <td align="left">Curso</td>
        <td id='valor_curso' width="100" align="right">--</td>
      </tr>
      <tr>
        <td align="left">Inscripci&oacute;n</td>
        <td id='valor_inscripcion' align="right">--</td>
      </tr>
      <tr>
        <td align="left">Estadia</td>
        <td id='valor_estadia' align="right">--</td>
      </tr>
      <tr>
        <td align="left">Traslado</td>
        <td id='valor_traslado' align="right">--</td>
      </tr>
      <tr>
        <td align="left">Env&iacute;o</td>
        <td id='valor_envio' align="right">--</td>
      </tr>
      <tr>
        <td align="left">Seguro</td>
        <td id='valor_seguro' align="right">--</td>
      </tr>
      <tr>
        <td align="left">Visa</td>
        <td id='valor_visa' align="right">--</td>
      </tr>
      <tr>
        <td align="left"><b>TOTAL</b></td>
        <td align="right">--</td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><div align="justify"><font color="#312F70">Para
      
      Reino Unido se toman los valores en libras esterlinas
      
       sujetos a cambios sin previo aviso. Valores en otras monedas
      
      son informativos. Pagos en pesos a la tasa CB 
      
      del dia de pago . </font></div></td>
    </tr>
</table>
<p>&nbsp;</p>
</form>
