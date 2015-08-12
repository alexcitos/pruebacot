<?php 


//GUARDA LA COTIZACION Y GENERA EL ID.
$fecha = date("Y-m-d");
$curso=$_POST['curso'];
$paisCentro=$_POST['paisCentro'];
$ciudadCentro=$_POST['ciudadCentro'];
$centro=$_POST['centro'];
$semanasCurso=$_POST['semanasCurso'];
$leccionesSemana=$_POST['leccionesSemana'];
$jornadaLecciones=$_POST['jornadaLecciones'];
$alojamiento=$_POST['alojamiento'];
$semanas_alojamiento=$_POST['semanas_alojamiento'];
$tipo_alojamiento=$_POST['tipo_alojamiento'];
$tipo_alimentacion=$_POST['tipo_alimentacion'];
$traslado=$_POST['traslado'];
$seguro=$_POST['seguro'];
$pasaje=$_POST['pasaje'];
$tipo_moneda=$_POST['tipo_moneda'];
$alimentacion = $_POST['alimentacion'];

$valor_curso=str_replace('.', '' ,$_POST['valor_curso']);
$valor_inscripcion=str_replace('.', '' ,$_POST['valor_inscripcion']);
$valor_alojamiento=str_replace('.', '' ,$_POST['valor_alojamiento']);
$valor_traslado=str_replace('.', '' ,$_POST['valor_traslado']);
$valor_envio=str_replace('.', '' ,$_POST['valor_envio']);
$valor_seguro=str_replace('.', '' ,$_POST['valor_seguro']);
$valor_visa=str_replace('.', '' ,$_POST['valor_visa']);
$valor_total=str_replace('.', '' ,$_POST['valor_total']);
$valor_total_pesos=str_replace('.', '' ,$_POST['valor_total_pesos']);


$variable_sql = "INSERT INTO cotizaciones (cod ,fecha ,curso ,pais ,ciudad ,centro, semanascurso ,leccionessemana ,jornadalecciones ,alojamiento ,semanas_alojamiento ,tipo_alojamiento ,tipo_alimentacion ,traslado ,seguro ,pasaje ,tipo_moneda ,valor_curso ,valor_inscripcion ,valor_alojamiento ,valor_traslado ,valor_envio ,valor_seguro ,valor_visa ,valor_total ,valor_total_pesos ,obervaciones
)
VALUES (
NULL , '$fecha', '$curso', '$paisCentro', '$ciudadCentro', '$centro', '$semanasCurso', '$leccionesSemana', '$jornadaLecciones', '$alojamiento', '$semanas_alojamiento', '$tipo_alojamiento', '$alimentacion', '$traslado', '$seguro', '$pasaje', '$tipo_moneda', '$valor_curso', '$valor_inscripcion', '$valor_alojamiento', '$valor_traslado', '$valor_envio', '$valor_seguro', '$valor_visa', '$valor_total', '$valor_total_pesos', ''
);";


$hostname_consejeria = "localhost";
$database_consejeria = "britcons_cotizador";
$username_consejeria = "britcons_raber";
$password_consejeria = "rafael7961";
$consejeria = mysql_pconnect($hostname_consejeria, $username_consejeria, $password_consejeria) or trigger_error(mysql_error(),E_USER_ERROR); 
		
		mysql_select_db($database_consejeria, $consejeria);
        $rs = mysql_query($variable_sql, $consejeria) or die(mysql_error());

		$numero_cotizacion=mysql_insert_id();
?>