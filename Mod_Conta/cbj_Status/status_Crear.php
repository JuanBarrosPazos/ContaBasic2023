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

		if(isset($_POST['oculto'])){
					if($form_errors = validate_form()){
							show_form($form_errors);
					} else { process_form();
							 info();
								}
		} else { show_form(); }
	
	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

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
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>
			<br>EL NUEVO AÑO SE CREARÁ AUTOMATICAMENTE.</font>";
			}
		
		elseif($_POST['year'] < (date('Y')-5)){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>
			<br>NO SE PERMITEN EJERCICIOS < ".(date('Y')-5).".</font>";
			}
		
		elseif($_POST['year'] > date('Y')){
			$errors [] = "EJERCICIO YEAR:  <font color='#FF0000'>AÑO NO ADMITIDO</font>";
			}
		
////////////////

	elseif(isset($_POST['oculto'])){
		
		global $db; 		global $db_name;
			
		$a = $_POST['year'];
		$a = trim($a);
				
		global $vname; 		$vname = "`".$_SESSION['clave']."status`";
			
		$sqlx =  "SELECT * FROM `$db_name`.$vname WHERE `year` = '$a' ";
		$qx = mysqli_query($db, $sqlx);
		$countx = mysqli_num_rows($qx);
		$rowsx = mysqli_fetch_assoc($qx);
			
		$sqly =  "SELECT * FROM `$db_name`.$vname ORDER BY `year` ASC ";
		$qy = mysqli_query($db, $sqly);		
		$ry = mysqli_fetch_assoc($qy);		
		$yval = $ry['year'];			

		global $vname2; 		$vname2 = "`".$_SESSION['clave']."statusfeedback`";
		$sqlf =  "SELECT * FROM `$db_name`.$vname2 WHERE `year` = '$a'";
		$qf = mysqli_query($db, $sqlf);	
		$countf = mysqli_num_rows($qf);	
				
		if($countf > 0){ $errors [] = "<font color='#FF0000'>T. FEEDBACK YA EXISTE ESTE EJERCICIO ".$a.".</font>"; 
		} elseif($countx > 0){$errors [] = "<font color='#FF0000'>YA EXISTE ESTE EJERCICIO</font>";
		} elseif($_POST['year'] < ($yval - 1)){$errors [] = "<font color='#FF0000'>AÑO PERMITIDO <b>* ".($yval-1)." *</b></font>"; }
						
		}
				
	return $errors;

	} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
	
		global $db; 		global $db_name;	
		global $vname; 		$vname = "`".$_SESSION['clave']."status`";

		global $year; 		$year = $_POST['year'];
		global $ycod; 		$ycod = substr(trim($_POST['year']),-2,2);
		$stat = 'open';
		$hidden = 'no';
		
		$tabla = "<table align='center' style='margin-top:10px'>
					<tr>
						<th colspan=2 class='BorderInf'>
							NUEVO EJERCICIO<br/>GRABADO EN ".strtoupper($vname)."
						</th>
					</tr>
				<tr>
					<td style='text-align:left;'>EJERCICIO</td><td>".$year."</td>
				</tr>
				<tr>
					<td style='text-align:left;'>CODE</td><td>".$ycod."</td>
				</tr>
				<tr>
					<td style='text-align:left;'>STATE</td><td>".$stat."</td>
				</tr>
				<tr>
					<td style='text-align:left;'>HIDDEN</td><td>".$hidden."</td>
				</tr>
				<tr>
					<td colspan='2' style='text-align:center;'' class='BorderSup'>
						<a href='status_Ver.php' class='botonverde'>INICIO EJERCICOS STATUS</a>
					</td>
				</tr>
			</table>";	
		
		/////////////
	
	$sqla = "INSERT INTO `$db_name`.$vname (`year`, `ycod`, `stat`, `hidden`) VALUES ('$year', '$ycod', '$stat', '$hidden')";
		
	if(mysqli_query($db, $sqla)){ print($tabla); 
								  crear_tablas();
	} else { print("* MODIFIQUE LA ENTRADA 207: ".mysqli_error($db));
			 show_form ();
			 global $texerror; 		$texerror = "\n\t ".mysqli_error($db);
		}
					
	} // FIN function process_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* GENERA LAS TABLAS Y DIRECTORIOS PARA EL NUEVO YEAR / STATUS */
	function crear_tablas(){
				tingresos();
				tgastos();
				inserbalg();
				inserbali();
				inserbald();
				insert_log();
	}

	function tingresos(){

		global $db; 		global $db_name;
		global $year;
			
		global $vname1;		 $vname1 = "`".$_SESSION['clave']."ingresos_".$year."`";
			
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
				
		global $dat1;
		if(mysqli_query($db, $tv)){
			$dat1 = "\tCREADA TABLA ".$vname1.".\n";
		} else {print( "* NO OK TABLA VENTAS. ".mysqli_error($db).".\n");
				$dat1 = "\tNO CREADA TABLA ".$vname1.". ".mysqli_error($db).".\n";
					}
					
		// CREA EL DIRECTORIO DE INGRESOS.

		$vn1 = "docingresos_".$year;
		$carpeta1 = "../cbj_Docs/".$vn1;
		global $dat1b;
		if (!file_exists($carpeta1)) {
			mkdir($carpeta1, 0777, true);
			copy("../cbj_Images/untitled.png", $carpeta1."/untitled.png");
			copy("../cbj_Images/pdf.png", $carpeta1."/pdf.png");
			$dat1b = "\tCREADO EL DIRECTORIO ".$carpeta1.".\n";
		}else{print("* NO HA CREADO EL DIRECTORIO ".$carpeta1."\n");
			$dat1b = "\tNO CREADO EL DIRECTORIO ".$carpeta1.".\n";
				}
		}
			
		function tgastos(){
			
			global $db; 		global $db_name;
			global $year;

			global $vname2; 		$vname2 = "`".$_SESSION['clave']."gastos_".$year."`";
			
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
				
			global $dat2;
			if(mysqli_query($db, $tg)){
					$dat2 = "\tCREADA TABLA ".$vname2.".\n";
			}else{print( "* NO OK TABLA GASTOS. ".mysqli_error($db)."\n");
					$dat2 = "\tNO CREADA TABLA ".$vname2.". ".mysqli_error($db).".\n";
						}
			
		// CREA EL DIRECTORIO DE DOC GASTOS.

			$vn2 = "docgastos_".$year;
			$carpeta2 = "../cbj_Docs/".$vn2;
			global $dat2b;
			if (!file_exists($carpeta2)) {
				mkdir($carpeta2, 0777, true);
				copy("../cbj_Images/untitled.png", $carpeta2."/untitled.png");
				copy("../cbj_Images/pdf.png", $carpeta2."/pdf.png");
				$dat2b = "\tCREADO EL DIRECTORIO ".$carpeta2.".\n";
			}else{die("* NO HA CREADO EL DIRECTORIO ".$carpeta2."\n");
				$dat2b = "\tNO CREADO EL DIRECTORIO ".$carpeta2.".\n";
				}
			}
			
		function inserbalg(){
			
			global $db;	 		global $db_name;
			global $year; 		$dy = $year;
			global $vname3;		$vname3 = "`".$_SESSION['clave']."balanceg`";
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
			($dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
					
			global $dat3;
			if(mysqli_query($db, $balanceg)){
					$dat3 = "\tACTUALIZADA TABLA ".$vname3.".\n";
			}else{print("* NO OK VALUES EN ".$vname3.". ".mysqli_error($db)."</br>");
					$dat3 = "\tNO OK VALUES EN ".$vname3.". ".mysqli_error($db).".\n";
						}
			
		}

		function inserbali(){
			
			global $db;	 		global $db_name;
			global $year; 		$dy = $year;
			global $vname4;		$vname4 = "`".$_SESSION['clave']."balancei`";
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
			($dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";

			global $dat4;
			if(mysqli_query($db, $balancei)){
					$dat4 = "\tACTUALIZADA TABLA ".$vname4.".\n";
			}else{ print("* NO OK VALUES EN ".$vname4.". ".mysqli_error($db)."</br>");
					$dat4 = "\tNO OK VALUES EN ".$vname4.". ".mysqli_error($db).".\n";
						}
		}
							
		function inserbald(){
			
			global $db;	 		global $db_name;
			global $year; 		$dy =  $year;

			global $vname5; 		$vname5 = "`".$_SESSION['clave']."balanced`";
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
			($dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";

			global $dat5;
			if(mysqli_query($db, $balanced)){
					$dat5 = "\tACTUALIZADA TABLA ".$vname5.".\n";
			}else{ print("* NO OK VALUES EN ".$vname5.". ".mysqli_error($db)."</br>");
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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form($errors=[]){
	
		if(isset($_POST['oculto'])){
							$defaults = $_POST;
		} else {$defaults = array (	'year' => @$_POST['year']);
							}

		if ($errors){
			print("<table style='border:none; margin: 0.4em auto 0.4em auto;'>
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

		print("<table style='margin-top:10px;'>
				<tr>
					<th colspan=2 class='BorderInf'>CREAR NUEVO AÑO / EJERCICIO</th>
				</tr>
			<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td style='text-align:right;' >EJERCICIO YEAR</td>
					<td>
			<input type='text' name='year' size=4 maxlength=4 value='".$defaults['year']."' />
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center' valign='middle' >
						<input type='submit' value='CREAR NUEVO EJERCICIO' class='botonverde' />
						<input type='hidden' name='oculto' value=1 />
			</form>														
					</td>
				</tr>
				<tr>
					<td colspan='2' align='center' class='BorderSup'>
						<a href='status_Ver.php' class='botonverde'>INICIO EJERCICOS STATUS</a>
					</td>
				</tr>
			</table>"); 
	
	}  // FIN function show_form($errors=[])

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

		global $db; 	global $year;

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

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaStatus;	$rutaStatus = "";
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