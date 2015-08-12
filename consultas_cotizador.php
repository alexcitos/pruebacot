<?

include_once("include/mysql_conf.php");

if (!$basedatos) {

	echo "<br><CENTER><span class=\"tex_menu\">Problemas de conexion con la base de datos.                            </CENTER>";

	exit;

}



$action = $_GET["action"];



switch ($action) {

	case 'getPais':



		$curso = urldecode($_GET["curso"]);

//		$curso = $_GET["curso"];



		echo "<select id='paisCentro' name='paisCentro' class='select' onchange=\"if(this.value!=''){showDivMasInfo('Pais','mostrar',this.options[this.selectedIndex].text);getData('ciudad');getData('moneda')}\">";

		echo "<option value=''>[ Seleccione ]</option>";



		$sql = "SELECT DISTINCT nombrePais, idPais FROM curso WHERE nombre='$curso' ORDER by nombrePais ASC";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while ($row_rs = @mysql_fetch_array($rs)){

			$pais = $row_rs[0];

		    $idPais = $row_rs[1];



			echo "<option value='".$idPais."'>".$pais."</option>";

		}



		echo "</select>";



	break;



	case 'getCiudad':



		$curso = urldecode($_GET["curso"]);

//		$curso = $_GET["curso"];

		$paisCentro = $_GET["id_pais"];



		echo "<select id='ciudadCentro' name='ciudadCentro' class='select' onchange=\"if(this.value!=''){showDivMasInfo('Ciudad','mostrar',this.options[this.selectedIndex].text);getData('centro')}\">";

		echo "<option value=''>[ Seleccione ]</option>";



		$sql = "select DISTINCT ciudad.nombre, ciudad.idCiudad from curso inner join centroeducativo ON curso.idCentroEducativo = centroeducativo.idCentroEducativo inner join ciudad on centroeducativo.idCiudad = ciudad.idCiudad where curso.nombre = '$curso' and curso.idPais = $paisCentro ORDER BY ciudad.nombre";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while ($row_rs = @mysql_fetch_array($rs)){

			$ciudad = $row_rs[0];

		    $id = $row_rs[1];



			echo "<option value='".$id."'>".$ciudad."</option>";

		}

		



	break;





	case 'getCentro':



		$curso = urldecode($_GET["curso"]);

		$paisCentro = $_GET["id_pais"];

		$ciudadCentro = $_GET["id_ciudad"];

		$cen = 0;



		echo "<select id='centro' name='centro' class='select' onchange=\"if(this.value!=''){showDivMasInfo('Centro','mostrar',this.options[this.selectedIndex].text);getData('semanasCurso')}\">";



		echo "<option value=''>[ Seleccione ]</option>";

          $sql = "SELECT DISTINCT idCentroEducativo  FROM curso  WHERE  nombre ='$curso' AND idPais=$paisCentro ";

	      $resultado = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		   while ($row = mysql_fetch_array($resultado))

		  {



		    $sql2 = "SELECT  nombre , idCentroEducativo  FROM centroeducativo  WHERE  idCentroEducativo=$row[0] AND idCiudad = $ciudadCentro";

	          $resultado2 = mysql_query($sql2) or die("La consulta fall&oacute;: ".mysql_error());

			  $row2=mysql_fetch_array($resultado2);

			if (isset($row2[0])){

				//echo "<option value='".$row2[1]."'>".$row2[0]."</option>";

				$centros[$cen] = $row2[0];

				$id_centros[$row2[0]] = $row2[1];



				$cen++;

			}

	       }



	       //Ordena alfabéticamente los centros

			sort($centros);



			//Imprime las opciones

			foreach ($centros as $centro) {

				echo "<option value='".$id_centros[$centro]."'>".$centro."</option>";

			}



	       echo "</select>";



	break;



	case 'getsemanasCurso':



		$centro = $_GET["centro"];



		echo "<select id='semanasCurso' name='semanasCurso' class='select' onchange=\"if(this.value!=''){getData('leccionesSemana')}\">";

		echo "<option value='' selected>[ Seleccione ]</option>";



		$sql = "SELECT DISTINCT semanasCurso FROM curso WHERE idCentroEducativo = $centro ORDER BY semanasCurso ASC";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while ($array = @ mysql_fetch_array($rs)){

			$value = $array[0];

			echo "<option value='".$value."'>".$value."</option>";

		}



		echo "</select>";

	break;



	case 'getleccionesSemana':



		$centro = $_GET["centro"];

		$curso = urldecode($_GET["curso"]);



		echo "<select id='leccionesSemana' name='leccionesSemana' class='select' onchange=\"if(this.value!=''){getData('jornadaLecciones')}\">";

		echo "<option value='' selected>[ Seleccione ]</option>";



		$sql = "SELECT DISTINCT leccionesSemana FROM curso WHERE idCentroEducativo = $centro AND nombre = '$curso' ORDER BY leccionesSemana ASC";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while ($array = @ mysql_fetch_array($rs)){

			$value = $array[0];

			echo "<option value='".$value."'>".$value."</option>";

		}



		echo "</select>";



	break;



	case 'getjornadaLecciones':



		$centro = $_GET["centro"];



		echo "<select id='jornadaLecciones' name='jornadaLecciones' class='select' onchange=\"getDataCotizacion();\">";

		echo "<option value='' selected>[ Seleccione ]</option>";

		$sql = "SELECT DISTINCT jornadaLecciones FROM curso WHERE idCentroEducativo = $centro ORDER BY jornadaLecciones ASC";



		$resultado = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while ($array = @ mysql_fetch_array($resultado)){

			$value = $array[0];

			echo "<option value='".$value."'>".$value."</option>";

		}



		echo "</select>";



	break;





	case 'gettipoAlimentacion':



		$tipo_alojamiento = $_GET["tipo_alojamiento"];

		$centro = $_GET["centro"];

		$tabla = array('','habindividual','habdoble','habtriple');



		echo "<select id='tipo_alimentacion' name='tipo_alimentacion' class='select_w' onchange='getDataCotizacion()'>";



		$sql = "SELECT sinComida, desayuno, mediaPension, completa, derechoCocina FROM ".$tabla[$tipo_alojamiento]." WHERE idCentroEducativo = $centro";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		$row_rs = @ mysql_fetch_array($rs);



		$sinComida = $row_rs[0];

		$desayuno = $row_rs[1];

		$mediaPension = $row_rs[2];

		$completa = $row_rs[3];

		$cocina = $row_rs[4];



		if ($sinComida == 0 && $desayuno == 0 && $mediaPension == 0 && $completa == 0 && $cocina == 0){

			echo "<option value=''>No Aplica</option>";

		}

		else{

			echo "<option value=''>[ Seleccione ]</option>";



			if ($sinComida != 0)	echo "<option value=$sinComida>Sin alimentaci&oacute;n</option>";

			if ($desayuno != 0)	echo "<option value=$desayuno>Desayuno</option>";

			if ($mediaPension != 0)	echo "<option value=$mediaPension>Desayuno y Cena</option>";

			if ($cocina != 0)	echo "<option value=$cocina>Derecho Cocina</option>";

		}



		echo "</select>";



	break;



	case 'cotizar':



		//INICIALIZA VARIABLES

		$curso = urldecode($_GET["curso"]);

		$pais = $_GET["pais"];

		$ciudad = $_GET["ciudad"];

		$centro = $_GET["centro"];

		$semanas_curso = $_GET["semanas_curso"];

		$lecciones_semana = $_GET["lecciones_semana"];

		$jornada_lecciones = $_GET["jornada_lecciones"];

		$alojamiento = $_GET["alojamiento"];

		$tipo_alojamiento = $_GET["tipo_alojamiento"];

		$semanas_alojamiento = $_GET["semanas_alojamiento"];

		$tipo_alimentacion = $_GET["tipo_alimentacion"];

		$traslado = $_GET["traslado"];

		$seguro = $_GET["seguro"];

		$pasaje = $_GET["pasaje"];

		$tipo_moneda = $_GET["tipo_moneda"];

		$moneda_chk = array('l' => 'selected','d' => '','e'=>'','p'=>'');

		$moneda_simbolo = array('l' => '&#163;','d' => 'US', 'e' => '&euro;','p'=>'$');

		$moneda_chk[$tipo_moneda] = ' selected ';



		//Valores de Moneda

		$sql = "SELECT nombreMoneda, valorRespectoDolar FROM moneda";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		while($row_rs = @ mysql_fetch_array($rs)){



			$moneda = $row_rs[0];

			$valorMoneda = $row_rs[1];



			if ($moneda == 'Libra') {

				$libra = $valorMoneda;

			}

			elseif ($moneda == 'Peso') {

				$peso = $valorMoneda;

			}

			elseif ($moneda == 'Euro') {

				$euro = $valorMoneda;

			}

		}



		$sql = "SELECT valorCurso, valorInscripcion, tipoMoneda, traslado, derechosVisa, pasajeAereo, gastosEnvio, seguro FROM curso WHERE nombre='$curso' AND semanasCurso=$semanas_curso AND idCentroEducativo = $centro AND jornadaLecciones = '$jornada_lecciones' AND leccionesSemana = $lecciones_semana";

		$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

		$row_rs = @ mysql_fetch_array($rs);



		$valor_curso = $row_rs[0];

		$valor_inscripcion = $row_rs[1];

		$tipo_moneda_curso = $row_rs[2];

		$valor_traslado = $row_rs[3];

		$valor_visa = $row_rs[4];

		$valor_pasaje = $row_rs[5];

		$valor_envio = $row_rs[6];

		$valor_seguro = $row_rs[7];



		if ($alojamiento == 'No')	$valor_alojamiento = 0;

		if ($traslado == 'No')		$valor_traslado = 0;

		if ($seguro == 'No')		$valor_seguro = 0;

		if ($pasaje == 'No')		$valor_pasaje = 0;



		//ESTADIA

		$valor_alojamiento = 0;

		if ($alojamiento == 'Si' && $tipo_alojamiento != ''){

			$tabla = array('','habindividual','habdoble','habtriple');



			$sql = "SELECT reserva FROM ".$tabla[$tipo_alojamiento]." WHERE idCentroEducativo = $centro";

			$rs = mysql_query($sql) or die("La consulta fall&oacute;: ".mysql_error());

			$row_rs = @ mysql_fetch_array($rs);



			$valor_reserva = $row_rs[0];



			$valor_alojamiento = ($semanas_alojamiento * $tipo_alimentacion ) + $valor_reserva;



		}

		/**CONVERSION DE MONEDAS*/

		if ($tipo_moneda_curso == "l") {

			if ($tipo_moneda == "d") {

				$valor_curso = $valor_curso * $libra;

				$valor_inscripcion = $valor_inscripcion * $libra;

				$valor_alojamiento = $valor_alojamiento * $libra;

				$valor_traslado = $valor_traslado * $libra;

				$valor_visa = $valor_visa * $libra;

				$valor_pasaje = $valor_pasaje * $libra;

				$valor_envio = $valor_envio * $libra;

				$valor_seguro = $valor_seguro * $libra;

			}

			elseif ($tipo_moneda == "e") {

				$valor_curso = ($valor_curso * $libra) / $euro;

				$valor_inscripcion = ($valor_inscripcion * $libra) / $euro;

				$valor_traslado = ($valor_traslado * $libra) / $euro;

				$valor_visa = ($valor_visa * $libra) / $euro;

				$valor_pasaje = ($valor_pasaje * $libra) / $euro;

				$valor_envio = ($valor_envio * $libra) / $euro;

				$valor_seguro = ($valor_seguro * $libra) / $euro;

				

				$valor_alojamiento = ($valor_alojamiento * $libra) / $euro;

			}

			elseif ($tipo_moneda == "p") {

				$valor_curso = ($valor_curso * $libra) * $peso;

				$valor_inscripcion = ($valor_inscripcion * $libra) * $peso;

				$valor_traslado = ($valor_traslado * $libra) * $peso;

				$valor_visa = ($valor_visa * $libra) * $peso;

				$valor_pasaje = ($valor_pasaje * $libra) * $peso;

				$valor_envio = ($valor_envio * $libra) * $peso;

				$valor_seguro = ($valor_seguro * $libra) * $peso;

				

				$valor_alojamiento = ($valor_alojamiento * $libra) * $peso;

			}



		}

		else if ($tipo_moneda_curso == "d") {

			if ($tipo_moneda == "l") {

				$valor_curso = $valor_curso / $libra;

				$valor_inscripcion = $valor_inscripcion / $libra;

				$valor_alojamiento = $valor_alojamiento / $libra;

				$valor_traslado = $valor_traslado / $libra;

				$valor_visa = $valor_visa / $libra;

				$valor_pasaje = $valor_pasaje / $libra;

				$valor_envio = $valor_envio / $libra;

				$valor_seguro = $valor_seguro / $libra;

			}

			elseif ($tipo_moneda == "e") {

				$valor_curso = ($valor_curso / $euro);

				$valor_inscripcion = ($valor_inscripcion / $euro);

				$valor_traslado = ($valor_traslado / $euro);

				$valor_visa = ($valor_visa / $euro);

				$valor_pasaje = ($valor_pasaje / $euro);

				$valor_envio = ($valor_envio / $euro);

				$valor_seguro = ($valor_seguro / $euro);

				

				$valor_alojamiento = ($valor_alojamiento / $euro);

			}

			elseif ($tipo_moneda == "p") {

				$valor_curso = ($valor_curso * $peso);

				$valor_inscripcion = ($valor_inscripcion * $peso);

				$valor_traslado = ($valor_traslado * $peso);

				$valor_visa = ($valor_visa * $peso);

				$valor_pasaje = ($valor_pasaje * $peso);

				$valor_envio = ($valor_envio * $peso);

				$valor_seguro = ($valor_seguro * $peso);

				

				$valor_alojamiento = ($valor_alojamiento * $peso);

			}

		}

		else if ($tipo_moneda_curso == "e") {

			if ($tipo_moneda == "l") {

				$valor_curso = ($valor_curso * $euro ) / $libra;

				$valor_inscripcion = ($valor_inscripcion * $euro ) / $libra;

				$valor_alojamiento = ($valor_alojamiento * $euro ) / $libra;

				$valor_traslado = ($valor_traslado * $euro ) / $libra;

				$valor_visa = ($valor_visa * $euro ) / $libra;

				$valor_pasaje = ($valor_pasaje * $euro ) / $libra;

				$valor_envio = ($valor_envio * $euro ) / $libra;

				$valor_seguro = ($valor_seguro * $euro ) / $libra;

			}

			elseif ($tipo_moneda == "d") {

				$valor_curso = ($valor_curso / $euro);

				$valor_inscripcion = ($valor_inscripcion / $euro);

				$valor_traslado = ($valor_traslado / $euro);

				$valor_visa = ($valor_visa / $euro);

				$valor_pasaje = ($valor_pasaje / $euro);

				$valor_envio = ($valor_envio / $euro);

				$valor_seguro = ($valor_seguro / $euro);

				

				$valor_alojamiento = ($valor_alojamiento / $euro);

			}

			if ($tipo_moneda == "p") {

				$valor_curso = ($valor_curso * $euro ) * $peso;

				$valor_inscripcion = ($valor_inscripcion * $euro ) * $peso;

				$valor_alojamiento = ($valor_alojamiento * $euro ) * $peso;

				$valor_traslado = ($valor_traslado * $euro ) * $peso;

				$valor_visa = ($valor_visa * $euro ) * $peso;

				$valor_pasaje = ($valor_pasaje * $euro ) * $peso;

				$valor_envio = ($valor_envio * $euro ) * $peso;

				$valor_seguro = ($valor_seguro * $euro ) * $peso;

				

				$valor_alojamiento = ($valor_alojamiento * $euro ) * $peso;

			}

		}



		$valor_total = $valor_curso + $valor_inscripcion+$valor_alojamiento+$valor_traslado+$valor_visa+$valor_pasaje+$valor_envio+$valor_seguro;



		if ($tipo_moneda != 'p'){

			if ($tipo_moneda == "l")	$valor_total_pesos = ($valor_total * $libra) * $peso;

			else if ($tipo_moneda == "d") $valor_total_pesos = $valor_total * $peso;

			else if ($tipo_moneda == "e") $valor_total_pesos = ($valor_total * $euro) * $peso;

			

			$valor_total_pesos = number_format($valor_total_pesos, 0, ',', '.');

				

		}		

		

		$valor_curso = number_format($valor_curso, 0, ',', '.');

		$valor_inscripcion = number_format($valor_inscripcion, 0, ',', '.');

		$valor_alojamiento = number_format($valor_alojamiento, 0, ',', '.');

		$valor_traslado = number_format($valor_traslado, 0, ',', '.');

		$valor_visa = number_format($valor_visa, 0, ',', '.');

		$valor_pasaje = number_format($valor_pasaje, 0, ',', '.');

		$valor_envio = number_format($valor_envio, 0, ',', '.');

		$valor_seguro = number_format($valor_seguro, 0, ',', '.');

		$valor_total = number_format($valor_total, 0, ',', '.');



		echo "<table border=0 cellpadding='3' cellspacing='0' class='tabla_cotizacion' width='100%' height='263'>";

		echo "<tr><td align='center' colspan='2' class='titulo_tabla_cotizacion'><b>IMPRIMIR</b>&nbsp;&nbsp;<a href='javascript:imprimir()'><img src='images/cotizador/print.gif' border='0' title='Imprimir Cotizacion'></a></td></tr>";

		echo "<tr><td align='left'><b>Moneda</b></td>";

		echo "<td width='100' align='right'><select name='tipo_moneda' id='tipo_moneda' class='select_i' onchange='getDataCotizacion()'>";

		echo "<option value='l' ".$moneda_chk['l'].">Libras</option><option value='d' ".$moneda_chk['d'].">Dolares</option><option value='e' ".$moneda_chk['e'].">Euros</option><option value='p' ".$moneda_chk['p'].">Pesos</option></select></td></tr>";

		echo "<tr><td align='left'>Curso</td><td id='valor_curso' width='100' align='right'>$valor_curso
		<input type='hidden' name='valor_curso' value='$valor_curso'></td></tr>";

		echo "<tr><td align='left'>Inscripci&oacute;n</td><td id='valor_inscripcion' align='right'>$valor_inscripcion
		<input type='hidden' name='valor_inscripcion' value='$valor_inscripcion'>
		</td></tr>";

		echo "<tr><td align='left'>Estadia</td><td id='valor_alojamiento' align='right'>$valor_alojamiento
		<input type='hidden' name='valor_alojamiento' value='$valor_alojamiento'>
		</td></tr>";

		echo "<tr><td align='left'>Traslado</td><td id='valor_traslado' align='right'>$valor_traslado
		<input type='hidden' name='valor_traslado' value='$valor_traslado'>
		</td></tr>";

		echo "<tr><td align='left'>Env&iacute;o</td><td id='valor_envio' align='right'>$valor_envio
		<input type='hidden' name='valor_envio' value='$valor_envio'>
		</td></tr>";

		echo "<tr><td align='left'>Seguro</td><td id='valor_seguro' align='right'>$valor_seguro
		<input type='hidden' name='valor_seguro' value='$valor_seguro'>
		</td></tr>";

		echo "<tr><td align='left'>Visa</td><td id='valor_visa' align='right'>$valor_visa
		<input type='hidden' name='valor_visa' value='$valor_visa'>
		</td></tr>";

		//echo "<tr><td align='left'>Pasaje</td><td align='right'><input type='text' id='valor_pasaje' class='input_text_cotizador' value='$valor_pasaje' size='8'></td></tr>";

		echo "<tr><td align='left'><b>TOTAL</b></td><td id='td_total' align='right'>".$moneda_simbolo[$tipo_moneda]." $valor_total
		<input type='hidden' name='valor_total' value='$valor_total'>
		</td></tr>";

		

		//Total en pesos

		if ($tipo_moneda != 'p'){

			echo "<tr><td align='left'>&nbsp;</td><td id='td_total_pesos' align='right'>$ $valor_total_pesos
			<input type='hidden' name='valor_total_pesos' value='$valor_total_pesos'>
			</td></tr>";

		}

		else{

			echo "<tr><td align='left'>&nbsp;</td></tr>";

		}

		

		//echo "<tr><td colspan=\"2\" align=\"center\"	><br><a href=\"javascript:nuevaCotizacion()\"><img src=\"images/cotizador/nueva_cotizacion.gif\" border=\"0\">&nbsp;Nueva Cotizacion</a></td> </tr>";



	break;

}



?>