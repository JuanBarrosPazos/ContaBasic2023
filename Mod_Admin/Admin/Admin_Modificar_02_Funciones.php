<?php

function validate_form(){
	
		/* global $sqld;global $qd;global $rowd;*/
	
	require '../Inclu/validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $password;
	$password = $_POST['Password'] ;
	global $passwordhash;
	$passwordhash = password_hash($password, PASSWORD_DEFAULT, array ( "cost"=>10));

	if ($_SESSION['Nivel'] == 'admin') {
		global $tlf2;
		if(strlen(trim($_POST['Tlf2'])) == 0){
			$tlf2 = 0;
		} else { $tlf2 = $_POST['Tlf2']; }
			
	$sqlc = "UPDATE `$db_name`.$table_name_a SET `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Usuario` = '$_POST[Usuario]', `Password` = '$passwordhash', `Pass` = '$password', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$tlf2' WHERE $table_name_a.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ 	
		
	if (($_SESSION['dni'] == $_SESSION['webmaster']) && ($_SESSION['id'] == $_POST['id']) && ($_POST['dni'] != $_SESSION['webmaster'])) { 	$_SESSION['dni'] = $_POST['dni'];
							// CREA EL ARCHIVO MYDNI.TXT $_SESSION['webmaster'].
							$filename = "../Inclu/webmaster.php";
							$fw2 = fopen($filename, 'w+');
							$mydni = '<?php $_SESSION[\'webmaster\'] = '.$_POST['dni'].'; ?>';
							fwrite($fw2, $mydni);
							fclose($fw2);
										}
	elseif (($_SESSION['dni'] != $_SESSION['webmaster']) && ($_SESSION['id'] == $_POST['id']) && ($_POST['dni'] != $_SESSION['dni'])) { 
							$_SESSION['dni'] = $_POST['dni'];
					}else{ }
								 
					require '../Inclu/webmaster.php';

	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3  class='BorderInf'>
						NUEVOS DATOS DEL USUARIO.
					</th>
				</tr>
			");
	
			global $rutaimg;
			$rutaimg = "src='../Users/".$_SESSION['refcl']."/img_admin/".$_SESSION['myimgcl']."'";
			require 'table_data_resum.php';

		print("<tr><td colspan=3 style='text-align:right;' class='BorderSup BorderInf'>
					<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
						<input type='hidden' name='closewin' value=1 />
					</form></td></tr>
				</table>");
		} else { print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 220: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
		
					} // FIN CONDICIONAL ADMIN
	
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
		global $tlf2;
		if(strlen(trim($_POST['Tlf2'])) == 0){
			$tlf2 = 0;
		} else { $tlf2 = $_POST['Tlf2']; }
			
			$sqlc = "UPDATE `$db_name`.$table_name_a SET `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$tlf2' WHERE $table_name_a.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ 
		
			print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3  class='BorderInf'>
						NUEVOS DATOS DEL USUARIO.
					</th>
				</tr>
			");
	
			global $rutaimg;
			$rutaimg = "src='../Users/".$_SESSION['refcl']."/img_admin/".$_SESSION['myimgcl']."'";
			require 'table_data_resum.php';

		print("<tr><td colspan=3 style='text-align:right;' class='BorderSup BorderInf'>
					<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
						<input type='hidden' name='closewin' value=1 />
					</form></td></tr>
				</table>");

		} else { print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 241: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
					} // FIN CONDICIONAL USER / PLUS
	
 	} // FIN FUNCTION PROCESS_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
			
function show_form($errors=[]){
	
			require '../Inclu/webmaster.php';

	if(isset($_POST['oculto2'])){

				$_SESSION['refcl'] = $_POST['ref'];
				$_SESSION['myimgcl'] = $_POST['myimg'];
				
				global $dt;
				$dt = $_POST['doc'];
				global $password;
				$password = $_POST['Pass'];
				global $password2;
				$password2 = $_POST['Pass'];

				global $array_b;
				$array_b = 1;
				require 'admin_array_total.php';

			}
								   
	elseif(isset($_POST['modifica'])){
			
			global $dt;
			$dt = $_POST['doc'];
			global $password;
			$password = $_POST['Password'];
			global $password2;
			$password2 = $_POST['Password2'];

			global $array_b;
			$array_b = 1;
			require 'admin_array_total.php';

		} else {  global $array_defaults;
				  $array_defaults = 1;
				  require 'admin_array_total.php';
					}

	if ($errors){
		print("<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
					}
		global $array_nive_doc;
		$array_nive_doc = 1;
		require 'admin_array_total.php';

	if ($_SESSION['Nivel'] == 'admin'){
	
		global $modifadmin;
		$modifadmin = 1;
		require 'table_crea_admin.php';

	} // FIN IF ADMIN
	
	elseif(($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
	
		global $modifadmin;
		$modifadmin = 1;
		require 'table_crea_admin.php';

			} // FIN ELSE IF USER / PLUS
	
	} // FIN FUNCTION SHOW_FOMR

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function UserLog(){

	global $texerror;
	global $orden;
	$orden = isset($_POST['Orden']);	

	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $InfoLog;
	global $password;

	global $text;
	$text = PHP_EOL.$InfoLog.$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$password.".\n\t ".$_POST['doc'].": ".$_POST['dni'].$_POST['ldni'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Telefono 2: ".$_POST['Tlf2'].PHP_EOL."\t Imagen: ".$_POST['myimg'].$texerror;

	require 'log_write.php';

	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>