<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// NIVEL PLUS / USER NO TIENE PERMITIDO BORRAR OTROS USUARIOS NI EL MISMO
/*if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
					master_index();
					ver_todo();
					info();
								}

else*/if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	require 'Inc_Logica_01.php';

} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	require 'Inc_Show_Form_01_Val.php';

	return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	if (strlen(trim($_POST['Apellidos'])) == 0){$apellido = $nombre;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nombre = $apellido;}
	
	show_form();
		
	if ($_SESSION['Nivel'] == 'admin') { 
	/*
	// PARA PODER BORRARME A MI MISMO
	$sqlc =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '%$nombre%' OR `Apellidos` LIKE '%$apellido%'  ORDER BY `Nombre` ASC  ";
	*/
	// PARA NO PODER BORRARME A MI MISMO
	$sqlb =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '%$nombre%' OR `Apellidos` LIKE '%$apellido%' ORDER BY `Nombre` ASC ";
	$qb = mysqli_query($db, $sqlb);
				}
// DEPRECATED
//$sqlc =  "SELECT * FROM `admin` WHERE `Nombre` LIKE '%$nombre%' OR `Apellidos` LIKE '%$apellido%' ORDER BY `Nombre` ASC ";
//	$qc = mysqli_query($db, $sqlc);
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS BORRAR";
	
	global $formularioh;
	$formularioh = "<form name='borra' action='Admin_Borrar_02.php' method='POST'>";

	global $formulariof;
	$formulariof = "<td colspan=5 class='BorderInf'>&nbsp;</td>
					<td colspan=2 align='right' class='BorderInf'>
						<input type='submit' value='BORRAR ESTOS DATOS' />
					</td>
						<input type='hidden' name='oculto2' value=1 />
					</form>";
				
	global $formulariohi;
	$formulariohi = "";

	global $formulariofi;
	$formulariofi = "";

	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){

	$ctemp = "../cbj_Docs/temp";
	if(file_exists($ctemp)){$dir1 = $ctemp."/";
							$handle1 = opendir($dir1);
							while ($file1 = readdir($handle1))
									{if (is_file($dir1.$file1))
										{unlink($dir1.$file1);}
										}	
								//rmdir ($ctemp);
						} else {}

	global $titulo;
	$titulo = "CONSULTA BORRAR USUARIOS";

	require 'Inc_Show_Form_01.php';
	
	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	/* */
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
	$ref = $_SESSION['ref'];
	$sqlb =  "SELECT * FROM `admin` WHERE `ref` = '$ref'";
	$qb = mysqli_query($db, $sqlb);
	}
	
	elseif ($_SESSION['Nivel'] == 'admin') { 
				$orden = $_POST['Orden'];
				$sqlb =  "SELECT * FROM `admin` ORDER BY $orden ";
				$qb = mysqli_query($db, $sqlb);
				}
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "TODOS USUARIOS BORRAR";
	
	global $formularioh;
	$formularioh = "<form name='borra' action='Admin_Borrar_02.php' method='POST'>";

	global $formulariof;
	$formulariof = "<td colspan=5 class='BorderInf'>&nbsp;</td>
					<td colspan=2 align='right' class='BorderInf'>
						<input type='submit' value='BORRAR ESTOS DATOS' />
					</td>
						<input type='hidden' name='oculto2' value=1 />
					</form>";

	global $formulariohi;
	$formulariohi = "";

	global $formulariofi;
	$formulariofi = "";

	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////
		
	} // FIN FUNCTION	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../'.$_SESSION['menu'].'/Master_Index_Admin.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$rf = isset($_POST['ref']);
	/*
	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	*/	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../cbj_Docs/log";
	
	global $text;
	$text = PHP_EOL."- USER BORRAR BUSCAR ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */

?>
