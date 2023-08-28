<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if (isset($_POST['oculto2'])){	show_form();
								info_01();
		} elseif(isset($_POST['oculto'])){
					if($form_errors = validate_form()){
							show_form($form_errors);
					} else { process_form();
							 info_02();
								}
		} else { show_form(); }
	
	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	global $sqld; 		global $qd; 		global $rowd;

	$errors = array();
	
	/* VALIDAMOS EL CAMPO factivae */
	
		if(strlen(trim($_POST['iva1'])) == ''){
			$errors [] = "RETENCION % <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['iva1'])){
			$errors [] = "RETENCION % <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['iva1'])){
			$errors [] = "RETENCION % <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		elseif(strlen(trim($_POST['iva2'])) == ''){
			$errors [] = "RETENCION % <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['iva2'])){
			$errors [] = "RETENCION % <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['iva2'])){
			$errors [] = "RETENCION % <font color='#FF0000'>SOLO NUMEROS</font>";
			}

	////////////////

		elseif(isset($_POST['oculto'])){

		global $db; 		global $db_name;
		
		$a = $_POST['iva1'].".".$_POST['iva2'];
		$a = trim($a);
																		
		global $vname; 		$vname = "`".$_SESSION['clave']."retencion`";
			
		$sqlx =  "SELECT * FROM `$db_name`.$vname WHERE `ret` = '$a'";
		$qx = mysqli_query($db, $sqlx);
		$countx = mysqli_num_rows($qx);
		$rowsx = mysqli_fetch_assoc($qx);
			
		global $exist;	
		if($countx > 0){$errors [] = "<font color='#FF0000'>YA EXISTE ESTE % RETENCION</font>";
							}
		}

		////////////////////
		
		return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
		
		global $db; 		global $db_name;	
		global $dyt1; 		global $dm1;
		
		$iva1 = $_POST['iva1'];
		$iva2 = $_POST['iva2'];
		global $tiva; 		$tiva = $iva1.".".$iva2; 	$tiva = trim($tiva);

		global $name; 		$name = $tiva." %";
		global $vname; 		$vname = "`".$_SESSION['clave']."retencion`";

		$tabla = "<table align='center' style='margin-top:10px'>
					<tr>
						<td colspan=4 style='text-align:center;'>
				<a href='retencion_Ver.php' class='botonverde' style='color:#343434;'>INICIO RETENCION</a>
						</td>
					</tr>
					<tr>
						<th colspan=4 >MODIFICADO EN ".strtoupper($vname)."</th>
					</tr>
					<tr>
						<td>RETENCION %</td><td>".$tiva."</td>
						<td>NAME</td><td>".$name."</td>
					</tr>
					<tr>
						<td colspan=4 style='text-align:center;'>
				<a href='retencion_Ver.php' class='botonverde' style='color:#343434;'>INICIO RETENCION</a>
						</td>
					</tr>
				</table>";	
		
		global $db; 		global $db_name;
		global $idx; 		$idx = $_SESSION['idx'];

	$sqla = "UPDATE `$db_name`.$vname SET `ret` = '$tiva', `name` = '$name' WHERE `id` = '$idx'";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
		} else {
			print("* MODIFIQUE LA ENTRADA 177: ".mysqli_error($db));
			show_form ();
			global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
					}
					
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){
	
		global $db; 		global $db_name;
	
		if(isset($_POST['oculto2'])){$_SESSION['idx'] = $_POST['id'];
		
			$ret = strlen(trim($_POST['ret']));
			$ret = $ret - 3;
			$ivax = $_POST['ret'];
			$iva1 = substr($_POST['ret'],0,$ret);
			$iva2 = substr($_POST['ret'],-2,2);

			$defaults = array (	'iva1' => $iva1,	
								'iva2' => $iva2);

		} elseif(isset($_POST['oculto'])){
			$defaults = $_POST;

		} else { $defaults = array ( 'iva1' => $_POST['iva1'],	
									'iva2' => $_POST['iva2']);
										}

		if ($errors){
			print("<table style='border:none, margin: 0.4em auto 0.4em auto;'>
					<tr>
						<th style='text-align:left'>
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
				</table>
			<div style='clear:both'></div>");
		}

////////////////////

	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<td colspan=2 style='text-align:center;'>
			<a href='retencion_Ver.php' class='botonverde' style='color:#343434;'>INICIO RETENCION</a>
					</td>
				</tr>
				<tr>
					<th colspan=2 >MODIFICAR % RETENCION</th>
				</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td>RETENCION % TIPO</td>
					<td>
		<input style='text-align:right' type='text' name='iva1' size=4 maxlength=2 value='".$defaults['iva1']."' />,<input type='text' name='iva2' size=4 maxlength=2 value='".$defaults['iva2']."' />%
					</td>
				</tr>
				<tr>
					<th colspan='2' valign='middle' >
						<input type='submit' class='botonazul' value='MODIFICAR % RETENCION' />
						<input type='hidden' name='oculto' value=1 />
			</form>														
					</td>
				</tr>
				<tr>
					<td colspan=2 style='text-align:center;'>
			<a href='retencion_Ver.php' class='botonverde' style='color:#343434;'>INICIO RETENCION</a>
					</td>
				</tr>
			</table>"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

		global $db;
		
		global $tiva; 		global $name;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
	
		global $text;
		$text = "\n- RETENCION MODIFICAR SELECCIONADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t % TIPO RETENCION: ".$_POST['ret'].".\n\t NOMBRE: ".$_POST['name'].".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_02(){

		global $db;
		
		global $tiva; 		global $name;

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
	
		global $text;
		$text = "\n- RETENCION MODIFICADO ".$ActionTime.".\n\t ID: ".$_SESSION['idx'].".\n\t % TIPO RETENCION: ".$tiva.".\n\t NOMBRE: ".$name.".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaRetencion;	$rutaRetencion = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
	} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>