function createRequestObject(){
	var request_o = false;

	try{
		request_o = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e){
		try {
			request_o = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (E){
			request_o = false;
		}
	}

	if (!request_o && typeof XMLHttpRequest != 'undefined'){
		request_o = new XMLHttpRequest();
	}

	return request_o;
}

function getData(combo){
	//Inicializa el Objeto
	var http = createRequestObject();

	if (combo == 'pais'){
		var curso = document.getElementById('curso').value;
		var url = 'consultas_cotizador.php?action=getPais&curso='+curso;
		var field = 'div_pais';

		document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";
	}

	else if (combo == 'ciudad'){

		var curso = document.getElementById('curso').value;
		var id_pais = document.getElementById('paisCentro').options[document.getElementById('paisCentro').selectedIndex].value;
		var url = 'consultas_cotizador.php?action=getCiudad&curso='+ curso +'&id_pais='+id_pais;
		var field = 'div_ciudad';

		document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";

	}

	else if (combo == 'centro'){


		var curso = document.getElementById('curso').value;
		var id_pais = document.getElementById('paisCentro').options[document.getElementById('paisCentro').selectedIndex].value;
		var id_ciudad = document.getElementById('ciudadCentro').options[document.getElementById('ciudadCentro').selectedIndex].value;
		var url = 'consultas_cotizador.php?action=getCentro&curso='+ curso +'&id_pais='+id_pais+'&id_ciudad='+id_ciudad;
		var field = 'div_centro';

		document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";

	}

	else if (combo == 'semanasCurso'){
		var field = 'div_semanasCurso';
		var centro = document.getElementById('centro').options[document.getElementById('centro').selectedIndex].value;
		var url = 'consultas_cotizador.php?action=getsemanasCurso&centro='+ centro;

		document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";

	}

	else if (combo == 'leccionesSemana'){
		var field = 'div_leccionesSemana';
		var centro = document.getElementById('centro').options[document.getElementById('centro').selectedIndex].value;
		var curso = document.getElementById('curso').value;
		var url = 'consultas_cotizador.php?action=getleccionesSemana&centro='+ centro+'&curso='+curso;

		document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";
	}

	else if (combo == 'jornadaLecciones'){
		var field = 'div_jornadaLecciones';
		var centro = document.getElementById('centro').options[document.getElementById('centro').selectedIndex].value;
		var url = 'consultas_cotizador.php?action=getjornadaLecciones&centro='+ centro;

		document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";
	}

	else if (combo == 'tipoAlimentacion'){
		var field = 'div_tipoAlimentacion';
		var tipo_alojamiento = document.getElementById('tipo_alojamiento').options[document.getElementById('tipo_alojamiento').selectedIndex].value;
		var centro = document.getElementById('centro').options[document.getElementById('centro').selectedIndex].value;
		var url = 'consultas_cotizador.php?action=gettipoAlimentacion&tipo_alojamiento='+ tipo_alojamiento+'&centro='+centro;

		document.getElementById('tr_tipo_alimentacion').style.display = '';
		document.getElementById('tr_tipo_alimentacion_1').style.display = '';

		document.getElementById(field).innerHTML = "<select class='select_w'><option>Cargando...</option></select>";
	}
	//ABRE CONEXION
	http.open('GET',url,true);
	http.onreadystatechange = function(){
		if (http.readyState == 4){
			var response = http.responseText;
			document.getElementById(field).innerHTML = response;
		}
	}

	//Se envia el objeto
	http.send(null);
}

function getDataCotizacion(){

	//Inicializa el Objeto
	var http = createRequestObject();

		var curso = document.getElementById('curso').value;
		
		var pais = document.getElementById('paisCentro').options[document.getElementById('paisCentro').selectedIndex].value;
		var ciudad = document.getElementById('ciudadCentro').options[document.getElementById('ciudadCentro').selectedIndex].value;
		var centro = document.getElementById('centro').options[document.getElementById('centro').selectedIndex].value;
		var semanas_curso = document.getElementById('semanasCurso').options[document.getElementById('semanasCurso').selectedIndex].value;
		var lecciones_semana = document.getElementById('leccionesSemana').options[document.getElementById('leccionesSemana').selectedIndex].value;
		var jornada_lecciones = document.getElementById('jornadaLecciones').options[document.getElementById('jornadaLecciones').selectedIndex].value;
		var alojamiento = document.getElementById('alojamiento').options[document.getElementById('alojamiento').selectedIndex].value;

		var tipo_alojamiento = 0;
		var semanas_alojamiento = 0;
		var tipo_alimentacion = 0;
		if (alojamiento == 'Si'){
			tipo_alojamiento = document.getElementById('tipo_alojamiento').options[document.getElementById('tipo_alojamiento').selectedIndex].value;
			semanas_alojamiento = document.getElementById('semanas_alojamiento').options[document.getElementById('semanas_alojamiento').selectedIndex].value;
			tipo_alimentacion = document.getElementById('tipo_alimentacion').options[document.getElementById('tipo_alimentacion').selectedIndex].value;
			//RAFAEL
			
			document.getElementById('alimentacion').value = document.getElementById('tipo_alimentacion').options[document.getElementById('tipo_alimentacion').selectedIndex].text;

		
		}

		var traslado = document.getElementById('traslado').options[document.getElementById('traslado').selectedIndex].value;
		var seguro = document.getElementById('seguro').options[document.getElementById('seguro').selectedIndex].value;
		var pasaje = document.getElementById('pasaje').value;

		var tipo_moneda = 'l';
		if (document.getElementById('tipo_moneda')){
			tipo_moneda = document.getElementById('tipo_moneda').options[document.getElementById('tipo_moneda').selectedIndex].value;
		}
		var url = 'consultas_cotizador.php?action=cotizar&curso='+curso+'&pais='+pais+'&ciudad='+ciudad+'&centro='+centro+'&semanas_curso='+semanas_curso+'&lecciones_semana='+lecciones_semana+'&jornada_lecciones='+jornada_lecciones+'&alojamiento='+alojamiento+'&tipo_alojamiento='+tipo_alojamiento+'&semanas_alojamiento='+semanas_alojamiento+'&tipo_alimentacion='+tipo_alimentacion+'&traslado='+traslado+'&seguro='+seguro+'&pasaje='+pasaje+'&tipo_moneda='+tipo_moneda;
		var field = 'div_cotizacion';

		//document.getElementById(field).innerHTML = "<select class='select'><option>Cargando...</option></select>";



	//ABRE CONEXION
	http.open('GET',url,true);
	http.onreadystatechange = function(){
		if (http.readyState == 4){
			var response = http.responseText;
			document.getElementById(field).innerHTML = response;
		}
	}

	//Se envia el objeto
	http.send(null);
}

function docwidth(){
	if (self.innerWidth)
	{
		WidthW = self.innerWidth;
	}
	else if (document.documentElement && document.documentElement.clientWidth)
	{
		WidthW = document.documentElement.clientWidth;
	}
	else if (document.body)
	{
		WidthW = document.body.clientWidth;
	}

	WidthS = document.body.scrollWidth;

	if (WidthW > WidthS)	return WidthW;
	else					return WidthS;

}