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
	
	$errors = array();
	
	/* VALIDAMOS EL CAMPO year */
	
		if(strlen(trim($_POST['year'])) == ''){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>CAMPO OBLIGATORIO</font>";
			}
		
		elseif(strlen(trim($_POST['year'])) < 4){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>MINIMO 4 NUMEROS</font>";
			}
		
		elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:´"·\(\)=¿?!¡\[\]\{\};,:\*\']+$/',$_POST['year'])){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>CARACTERES NO VALIDOS.</font>";
			}
			
		elseif (!preg_match('/^[0-9]+$/',$_POST['year'])){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>SOLO NUMEROS</font>";
			}

		elseif($_POST['year'] == (date('Y')+1)){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>EL NUEVO AÑO SE CREARÁ AUTOMATICAMENTE.</font>";
			}
		
		elseif($_POST['year'] < (date('Y')-5)){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>NO SE PERMITEN EJERCICIOS < ".(date('Y')-5).".</font>";
			}
		
		elseif($_POST['year'] > date('Y')){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>AÑO NO ADMITIDO</font>";
			}
		
////////////////

	elseif($_POST['oculto']){
		
			global $db;
			global $db_name;
		
			$a = $_POST['year'];
			$a = trim($a);
			
			global $vname;
			$vname = "cbj_status";
			$vname = "`".$vname."`";
		
			$sqlx =  "SELECT * FROM `$db_name`.$vname WHERE `year` = '$a' ";
			$qx = mysqli_query($db, $sqlx);
			$countx = mysqli_num_rows($qx);
			$rowsx = mysqli_fetch_assoc($qx);
		
			$sqly =  "SELECT * FROM `$db_name`.$vname ORDER BY `year` ASC ";
			$qy = mysqli_query($db, $sqly);		
			$ry = mysqli_fetch_assoc($qy);		
			$yval = $ry['year'];			

			global $vname2;
			$vname2 = "cbj_feedback";
			$vname2 = "`".$vname2."`";
			$sqlf =  "SELECT * FROM `$db_name`.$vname2 WHERE `year` = '$a'";
			$qf = mysqli_query($db, $sqlf);	
			$countf = mysqli_num_rows($qf);	
			
		if($countf > 0){$errors [] = "<font color='#FF0000'>T. FEEDBACK YA EXISTE ESTE EJERCICIO ".$a.".</font>";
						}
						
		elseif($countx > 0){$errors [] = "<font color='#FF0000'>YA EXISTE ESTE EJERCICIO</font>";
						}
			
		elseif($_POST['year'] < ($yval - 1)){$errors [] = "<font color='#FF0000'>AÑO PERMITIDO <b>* ".($yval-1)." *</b></font>";
						}
						
				}
				
////////////////////

	
	return $errors;

		} 
		
//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
		global $db;
		global $db_name;	
		global $vname;
		$vname = "cbj_status";
		$vname = "`".$vname."`";

		global $year;
		$year = $_POST['year'];
		global $ycod;
		$ycod = substr(trim($_POST['year']),-2,2);
		$stat = 'open';
		$hidden = 'no';
	
	$tabla = "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						NUEVO EJERCICIO.
						<br />
						GRABADO EN ".strtoupper($vname)."
					</th>
				</tr>
												
				<tr>
					<td>
						EJERCCIO
					</td>
					<td>"
						.$year.
					"</td>
				</tr>
				<tr>
					<td>	
						CODE
					</td>
					<td>"
						.$ycod.
					"</td>
				</tr>
				<tr>
					<td>	
						STATE
					</td>
					<td>"
						.$stat.
					"</td>
				</tr>
				<tr>
					<td>	
						HIDDEN
					</td>
					<td>"
						.$hidden.
					"</td>
				</tr>
			</table>
				
		";	
		
		/////////////
	
	$sqla = "INSERT INTO `$db_name`.$vname (`year`, `ycod`, `stat`, `hidden`) VALUES ('$year', '$ycod', '$stat', '$hidden')";
		
		if(mysqli_query($db, $sqla)){ 	print($tabla); 
										crear_tablas();
					} else {
							print("* MODIFIQUE LA ENTRADA 207: ".mysqli_error($db));
									show_form ();
									global $texerror;
									$texerror = "\n\t ".mysqli_error($db);
					}
					
}	

//////////////////////////////////////////////////////////////////////////////////////////////

function crear_tablas(){
				tingresos();
				tgastos();
				inserbalg();
				inserbali();
				inserbald();
				insert_log();
	}

function tingresos(){

	global $db;
	global $db_name;
	global $year;
	
	$vname1 = "cbj_ingresos_".$year;
	$vname1 = "`".$vname1."`";
	
	$tv = "CREATE TABLE `$db_name`.$vname1 (
	  `id` int(4) NOT NULL auto_increment,
	  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
	  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `factiva` int(2) NOT NULL,
	  `factivae` decimal(9,2) unsigned NOT NULL,
	  `factpvp` decimal(9,2) unsigned NOT NULL,
	  `factret` int(2) NOT NULL,
	  `factrete` decimal(9,2) unsigned NOT NULL,
	  `factpvptot` decimal(9,2) unsigned NOT NULL,
	  `coment` text collate utf8_spanish2_ci NOT NULL,
	  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  PRIMARY KEY  (`id`),
	  UNIQUE KEY `id` (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $tv)){
			global $dat1;
			$dat1 = "\tCREADA TABLA ".$vname1.".\n";

				} else {print( "* NO OK TABLA VENTAS. ".mysqli_error($db).".\n");
						global $dat1;
						$dat1 = "\tNO CREADA TABLA ".$vname1.". ".mysqli_error($db).".\n";
				}
				
// CREA EL DIRECTORIO DE INGRESOS.

	$vn1 = "docingresos_".$year;
	$carpeta1 = "../cbj_Docs/".$vn1;
	if (!file_exists($carpeta1)) {
		mkdir($carpeta1, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta1."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta1."/pdf.png");
		global $dat1b;
		$dat1b = "\tCREADO EL DIRECTORIO ".$carpeta1.".\n";
		}
		else{print("* NO HA CREADO EL DIRECTORIO ".$carpeta1."\n");
		global $dat1b;
		$dat1b = "\tNO CREADO EL DIRECTORIO ".$carpeta1.".\n";
		}
	
	}
	
function tgastos(){
	
	global $db;
	global $db_name;
	global $year;

	$vname2 = "cbj_gastos_".$year;
	$vname2 = "`".$vname2."`";
	
	$tg = "CREATE TABLE `$db_name`.$vname2 (
	  `id` int(4) NOT NULL auto_increment,
	  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
	  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
	  `factiva` int(2) NOT NULL,
	  `factivae` decimal(9,2) unsigned NOT NULL,
	  `factpvp` decimal(9,2) unsigned NOT NULL,
	  `factret` int(2) NOT NULL,
	  `factrete` decimal(9,2) unsigned NOT NULL,
	  `factpvptot` decimal(9,2) unsigned NOT NULL,
	  `coment` text collate utf8_spanish2_ci NOT NULL,
	  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	  PRIMARY KEY  (`id`),
	  UNIQUE KEY `id` (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
		
	if(mysqli_query($db, $tg)){
			global $dat2;
			$dat2 = "\tCREADA TABLA ".$vname2.".\n";
				} else {print( "* NO OK TABLA GASTOS. ".mysqli_error($db)."\n");
						global $dat2;
						$dat2 = "\tNO CREADA TABLA ".$vname2.". ".mysqli_error($db).".\n";
				}
	
// CREA EL DIRECTORIO DE DOC GASTOS.

	$vn2 = "docgastos_".$year;
	$carpeta2 = "../cbj_Docs/".$vn2;
	if (!file_exists($carpeta2)) {
		mkdir($carpeta2, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta2."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta2."/pdf.png");
		global $dat2b;
		$dat2b = "\tCREADO EL DIRECTORIO ".$carpeta2.".\n";
		}
		else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta2."\n");
		global $dat2b;
		$dat2b = "\tNO CREADO EL DIRECTORIO ".$carpeta2.".\n";
		}

	}
	
function inserbalg(){
	
	global $db;	
	global $db_name;
	global $year;

	$dy = $year;
	$vname3 = "cbj_balanceg";
	$vname3 = "`".$vname3."`";
	$vname3 = strtolower($vname3);	
					
	$balanceg = "INSERT INTO `$db_name`.$vname3 (`year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
	($dy, 'M01', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M02', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M03', '0.00', '0.00', '0.00', '0.00'),  
	($dy, 'M04', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M05', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M06', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M07', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M08', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M09', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M10', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M11', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M12', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'ANU', '0.00', '0.00', '0.00', '0.00')
	";
	if(mysqli_query($db, $balanceg)){
			global $dat3;
			$dat3 = "\tACTUALIZADA TABLA ".$vname3.".\n";
				} else {
					print("* NO OK VALUES EN ".$vname3.". ".mysqli_error($db)."</br>");
			global $dat3;
			$dat3 = "\tNO OK VALUES EN ".$vname3.". ".mysqli_error($db).".\n";
					}
	
	}

function inserbali(){
	
	global $db;	
	global $db_name;
	global $year;

	$dy = $year;
	$vname4 = "cbj_balancei";
	$vname4 = "`".$vname4."`";
	$vname4 = strtolower($vname4);	
					
	$balancei = "INSERT INTO `$db_name`.$vname4 (`year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
	($dy, 'M01', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M02', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M03', '0.00', '0.00', '0.00', '0.00'),  
	($dy, 'M04', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M05', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M06', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M07', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M08', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M09', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M10', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M11', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M12', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'ANU', '0.00', '0.00', '0.00', '0.00')
	";
	if(mysqli_query($db, $balancei)){
			global $dat4;
			$dat4 = "\tACTUALIZADA TABLA ".$vname4.".\n";
				} else {
					print("* NO OK VALUES EN ".$vname4.". ".mysqli_error($db)."</br>");
					global $dat4;
					$dat4 = "\tNO OK VALUES EN ".$vname4.". ".mysqli_error($db).".\n";
					}
}
					
function inserbald(){
	
	global $db;	
	global $db_name;

	global $year;
	$dy =  $year;

	$vname5 = "cbj_balanced";
	$vname5 = "`".$vname5."`";
	$vname5 = strtolower($vname5);	
					
	$balanced = "INSERT INTO `$db_name`.$vname5 (`year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
	($dy, 'M01', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M02', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M03', '0.00', '0.00', '0.00', '0.00'),  
	($dy, 'M04', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M05', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M06', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M07', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M08', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M09', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M10', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M11', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'M12', '0.00', '0.00', '0.00', '0.00'), 
	($dy, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
	($dy, 'ANU', '0.00', '0.00', '0.00', '0.00')
	";
	if(mysqli_query($db, $balanced)){
			global $dat5;
			$dat5 = "\tACTUALIZADA TABLA ".$vname5.".\n";
				} else {
					print("* NO OK VALUES EN ".$vname5.". ".mysqli_error($db)."</br>");
					global $dat5;
					$dat5 = "\tNO CREADA TABLA ".$vname5.". ".mysqli_error($db).".\n";
					}
	
	}

function insert_log(){
	
		global $dat1;	global $dat1b;	global $dat2;	global $dat2b;
		global $dat3;	global $dat4;	global $dat5;
		global $datos;
		$datos = $dat1.$dat1b.$dat2.$dat2b.$dat3.$dat4.$dat5."\n";

global $dir;
if ($_SESSION['Nivel'] == 'admin'){ 
			$dir = "../cbj_Docs/log";
		}

global $year;
$logdocu = $_SESSION['ref'];
$logdate = date('Y-m-d');
$logtext = "\n** CREADO NUEVO EJERCICIO => ".$year.".\n\t User Ref: ".$_SESSION['ref'].".\n\t User Name: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos']."\n \n".$datos;
$filename = $dir."/".$logdate."_".$logdocu.".log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

}
//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if($_POST['oculto']){
						$defaults = $_POST;
		} else {
				$defaults = array (	'year' => $_POST['year'],	
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
								CREAR NUEVO EJERCICIO					
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>

				<tr>
					<td>						
						EJERCICIO YEAR 
					</td>
					<td>
		<input type='text' name='year' size=4 maxlength=4 value='".$defaults['year']."' />
					</td>
				</tr>
					
				<tr>
					<td colspan='2' align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='CREAR NUEVO EJERCICIO' />
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
	global $year;

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
	$text = "\n- NUEVO EJERCICIO CREADO ".$ActionTime.".\n\t ".$year.".";

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
		
				require '../Inclu_MInd/Master_Index_Impuestos.php';
		
				} /* Fin funcion master_index.*/

/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_02.php';

?>