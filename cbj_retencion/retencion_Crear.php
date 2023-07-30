<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
		
	require '../Inclu/sqld_query_fetch_assoc.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

						if($_POST['oculto']){
							
								if($form_errors = validate_form()){
									show_form($form_errors);
										} else {
											process_form();
											info();
											}
							
							} else {
										show_form();
								}
				}
					else { require '../Inclu/table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;

	$errors = array();
	
	/* VALIDAMOS EL CAMPO factrete */
	
		if(strlen(trim($_POST['ret1'])) == ''){
			$errors [] = "RETENCION % <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['ret1'])){
			$errors [] = "RETENCION % <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['ret1'])){
			$errors [] = "RETENCION % <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		elseif(strlen(trim($_POST['ret2'])) == ''){
			$errors [] = "RETENCION % <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['ret2'])){
			$errors [] = "RETENCION % <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['ret2'])){
			$errors [] = "RETENCION % <font color='#FF0000'>SOLO NUMEROS</font>";
			}

////////////////

	elseif($_POST['oculto']){
		global $db;
		global $db_name;
		global $vname;
	
		$a = $_POST['ret1'].".".$_POST['ret2'];
		$a = trim($a);
																	
		$vname = "cbj_retencion";
		$vname = "`".$vname."`";
		
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
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	global $db;
	global $db_name;	
	global $dyt1;
	global $dm1;
	

	$ret1 = $_POST['ret1'];
	$ret2 = $_POST['ret2'];
	global $tret;
	$tret = $ret1.".".$ret2;
	$tret = trim($tret);
	global $name;
	$name = $tret." %";

	global $vname;
	$vname = "cbj_retencion";
	$vname = "`".$vname."`";

	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=4 class='BorderInf'>
						GRABADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						RETENCION %
					</td>
					<td>"
						.$tret.
					"</td>
					<td>	
						NAME
					</td>
					<td>"
						.$name.
					"</td>
				</tr>
				
			</table>
				
		";	
		
		/////////////

		global $db;
		global $db_name;

	$sqla = "INSERT INTO `$db_name`.$vname (`ret`, `name`) VALUES ('$tret', '$name')";
		
		if(mysqli_query($db, $sqla)){ print($tabla); 
					} else {
							print("* MODIFIQUE LA ENTRADA 174: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
					
}	

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	global $db;
	global $db_name;
	
	
	if($_POST['oculto']){
		$defaults = $_POST;
		} else {
				$defaults = array (	'ret1' => $_POST['ret1'],	
									'ret2' => '00',	
													);
							   		}

	if ($errors){
		print("	<div width='90%' style='float:left'>
					<table align='left' style='border:none'>
					<th style='text-align:left'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					</th>
					<tr>
					<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>
				</div>
				<div style='clear:both'></div>");
		}
		
////////////////////

	print("
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
								CREAR % RETENCION					
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

				<tr>
					<td>						
						RETENCION % TIPO
					</td>
					<td>
<input style='text-align:right' type='text' name='ret1' size=4 maxlength=2 value='".$defaults['ret1']."' />
,
<input type='text' name='ret2' size=4 maxlength=2 value='".$defaults['ret2']."' />
%
					</td>
				</tr>
					
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR % RETENCION' />
						<input type='hidden' name='oculto' value=1 />
					</td>
				</tr>
				
		</form>														
			
			</table>				
						"); 
	
	}	

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;

	global $tret;
	global $name;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
global $text;
$text = "\n- TIPO IMPUESTO CREADO ".$ActionTime.".\n\t TIPO % IMPUESTO: ".$tret.".\n\t NOMBRE: ".$name.".";

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y-m-d');
		$logtext = $text."\n";
		$filename = $dir."/".$logdate."_".$logdocu.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_retencion.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>