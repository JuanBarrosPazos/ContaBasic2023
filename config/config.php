<?php

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	//require '../Inclu/Admin_0b.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

 if($_POST['config']){
							
	if($form_errors = validate_form()){
										show_form($form_errors);
																	} 
	else {	process_form();
			require '../Conections/conection.php';
			@$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
	if (!$db){ 	global $dbconecterror;
				$dbconecterror = $db_name." * ".mysqli_connect_error()."\n"; 
				print ("NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
				show_form();
		} elseif($db) { config_one();
						crear_tablas();
						crear_dir();
						ayear();
						global $tablepf;
						print($tablepf);
					}
		}
						
	} else { show_form(); }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){
	
	if(file_exists('year.txt')){unlink("year.txt");
					global $data1;
					$data1 = PHP_EOL."\tUNLINK year.txt";}
			else {print("DON`T UNLINK year.txt </br>");
					global $data1;
					$data1 = PHP_EOL."\tDON'T UNLINK year.txt";}

	/*
	if(file_exists('ayear.php')){unlink("ayear.php");
					global $data2;
					$data2 = PHP_EOL."\tUNLINK ayear.php";}
			else {print("DON'T UNLINK ayear.php </br>");
					global $data2;
					$data2 = PHP_EOL."\tDON'T UNLINK ayear.php";}
	*/

	if(!file_exists('year.txt')){
			if(file_exists('year_Init_System.txt')){
				copy("year_Init_System.txt", "year.txt");
				global $data3;
				$data3 = PHP_EOL."\tRENAME year_Init_System.txt TO year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO year.txt </br>");
				global $data3;
				$data3 = PHP_EOL."\tDON'T RENAME year_Init_System.txt TO year.txt";}
			}else{	global $data3;
					$data3 = "";}

	/*
	if(!file_exists('ayear.php')){
			if(file_exists('ayear_Init_System.php')){
				copy("ayear_Init_System.php", "ayear.php");
				global $data4;
				$data4 = PHP_EOL."\tRENAME ayear_Init_System.php TO ayear.php";
			} else {print("DON'T RENAME ayear_Init_System.php TO ayear.php </br>");
				global $data4;
				$data4 = PHP_EOL."\tDON'T RENAME config/ayear_Init_System.php TO config/ayear.php";}
			}else{	global $data4;
					$data4 = "";}
	*/

				/*		****	*/

	if(!file_exists('../cbj_Docs/year.txt')){
			if(file_exists('year_Init_System.txt')){
				copy("year_Init_System.txt", "../cbj_Docs/year.txt");
				global $data5;
				$data5 = "\n \t RENAME year_Init_System.txt TO ../cbj_Docs/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				global $data5;
				$data5 = "\n \t RENAME year_Init_System.txt TO ../cbj_Docs/year.txt";
				}
			}else{	global $data5;
					$data5 = "";}

	/*
	if(!file_exists('../cbj_Docs/ayear.php')){
			if(file_exists('ayear_Init_System.php')){
				copy("ayear_Init_System.php", "../cbj_Docs/ayear.php");
				global $data6;
				$data6 = "\n \t RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php";
			} else {print("DON'T RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php </br>");
				global $data6;
				$data6 = "\n \t RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php";
				}
			}else{	global $data6;
					$data6 = "";}
	*/

	global $cfone;
	$cfone = PHP_EOL."SUSTITUCION DE ARCHIVOS:".$data1/*.$data2*/.$data3/*.$data4*/.$data5/*.$data6*/;

	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();
	
	if(strlen(trim($_POST['host'])) == 0){
		$errors [] = "HOST: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['host'])) < 4){
		$errors [] = "HOST: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['host'])){
		$errors [] = "HOST: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['user'])) == 0){
		$errors [] = "USER: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['user'])) < 4){
		$errors [] = "USER: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['user'])){
		$errors [] = "USER: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['pass'])) == 0){
		$errors [] = "PASS: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['pass'])) < 4){
		$errors [] = "PASS: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['pass'])){
		$errors [] = "PASS: <font color='#FF0000'>NO VALIDOS</font>";
		}

	
	if(strlen(trim($_POST['name'])) == 0){
		$errors [] = "NAME: <font color='#FF0000'> es obligatorio.</font>";
		}
	
	elseif (strlen(trim($_POST['name'])) < 4){
		$errors [] = "NAME: <font color='#FF0000'>Más de 3 carácteres.</font>";
		}
		
	elseif (!preg_match('/^[^@´`\'áéíóú#$&%<>:"·\(\)=\[\]\{\};,:\*\s]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>caracteres no validos.</font>";
		}
		
	elseif (!preg_match('/^[a-z A-Z 0-9 !¡?¿\._]+$/',$_POST['name'])){
		$errors [] = "NAME: <font color='#FF0000'>NO VALIDOS</font>";
		}

	return $errors;

	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";

	$bddata = '<?php
				$db_host = '.$host.'; 
				$db_user = '.$user.'; 
				$db_pass = '.$pass.'; 
				$db_name = '.$name.'; 
				?>';
	
	if(file_exists('../Conections/conection.php')){unlink("../Conections/conection.php");}

	$filename = "../Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	
	global $tablepf;
	$tablepf = "<table align='center'>
					<tr>
						<td colspan='2' align='center'>
								SE HA CREADO EL ARCHIVO DE CONEXIONES.
							</br>
								CON LAS SIGUIENTES VARIABLES.
						</td>
					</tr>
					<tr>
						<td>
								VARIABLE HOST ADRESS
						</td>
						<td>
								\$db_host = ".$host."; \n
						</td>		
					</tr>								

					<tr>
						<td>
								VARIABLE USER NAME
						</td>
						<td>
								\$db_user = ".$user."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE PASSWORD
						</td>
						<td>
								\$db_pass = ".$pass."; \n
						</td>		
					</tr>	
												
					<tr>
						<td>
								VARIABLE BBDD NAME
						</td>
						<td>
								\$db_name = ".$name."; \n
						</td>		
					</tr>
					<tr>
					<td colspan='2' align='center'>
						<a href='config2.php'>
									CREE EL WEB MASTER
						</a>
					</td>
				</tr>
			</table>";
							
		}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function crear_dir(){

	global $data0;
	$carpeta = "../cbj_Docs/temp";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = $data0."\t* OK DIRECTORIO cbj_Docs/temp. \n";
		}
		else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
				$data0 = $data0."\t* NO OK DIRECTORIO cbj_Docs/temp. \n";
			}

	$carpeta = "../cbj_Docs/log";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = $data0."\t* OK DIRECTORIO cbj_Docs/log. \n";
		}
		else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
				$data0 = $data0."\t* NO OK DIRECTORIO cbj_Docs/log. \n";
			}

	$carpeta = "../cbj_Docs/grafics";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = $data0."\t* OK DIRECTORIO cbj_Docs/grafics. \n";
		}
		else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
				$data0 = $data0."\t* NO OK DIRECTORIO cbj_Docs/grafics. \n";
			}

// CREA EL DIRECTORIO DE IMAGEN DE USUARIO.

	$vn1 = "img_admin";
	$carpetaimg = "../cbj_Docs/".$vn1;
	if (!file_exists($carpetaimg)) {
		mkdir($carpetaimg, 0777, true);
		copy("cbj_Images/untitled.png", $carpetaimg."/untitled.png");
		$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg."\n";
		}
		else{//print("* NO OK EL DIRECTORIO ".$carpetaimg."\n");
			$data0  = $data0."\t* NO OK DIRECTORIO ".$carpetaimg."\n";
		}
	
// CREA EL DIRECTORIO DE IMAGEN DE PROVEEDOR GASTOS.

	$vn1 = "img_proveedores";
	$carpetaimg1 = "../cbj_Docs/".$vn1;
	if (!file_exists($carpetaimg1)) {
		mkdir($carpetaimg1, 0777, true);
		copy("cbj_Images/untitled.png", $carpetaimg1."/untitled.png");
		$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg1."\n";
		}
		else{//print("* NO OK EL DIRECTORIO ".$carpetaimg1."\n");
			$data0 = $data0."\t* NO OK DIRECTORIO ".$carpetaimg1."\n";
		}
	
// CREA EL DIRECTORIO DE IMAGEN DE PROVEEDOR INGRESOS.

	$vn1 = "img_clientes";
	$carpetaimg2 = "../cbj_Docs/".$vn1;
	if (!file_exists($carpetaimg2)) {
		mkdir($carpetaimg2, 0777, true);
		copy("cbj_Images/untitled.png", $carpetaimg2."/untitled.png");
		$$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg2."\n";
		}
		else{//print("* NO OK EL DIRECTORIO ".$carpetaimg2."\n");
			$data0 = $data0."\t* NO OK DIRECTORIO ".$carpetaimg2."\n";
		}
	
// CREA EL DIRECTORIO GRAFICS.

	$vn1 = "grafics";
	$carpetaimg2 = "../cbj_Docs/".$vn1;
	if (!file_exists($carpetaimg2)) {
		mkdir($carpetaimg2, 0777, true);
		copy("cbj_Images/untitled.png", $carpetaimg2."/untitled.png");
		$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg2."\n";
		}
		else{//print("* NO OK DIRECTORIO ".$carpetaimg2."\n");
			$data0 = $data0."\t* NO OK DIRECTORIO ".$carpetaimg2."\n";
		}

// CREA EL DIRECTORIO DE DOC GASTOS PENDIENTES.

	$vn1b = "docgastos_pendientes";
	$carpeta1b = "../cbj_Docs/".$vn1b;
	if (!file_exists($carpeta1b)) {
		mkdir($carpeta1b, 0777, true);
		copy("cbj_Images/untitled.png", $carpeta1b."/untitled.png");
		copy("cbj_Images/pdf.png", $carpeta1b."/pdf.png");
		$data0 = $data0."\t* OK DIRECTORIO ".$carpeta1b."\n";
		}
		else{//print("* NO OK DIRECTORIO ".$carpeta1b."\n");
			$data0 = $data0."\t* NO OK DIRECTORIO ".$carpeta1b."\n";
		}

// CREA EL DIRECTORIO DE IMAGENES.

	$vn3b = "docingresos_pendientes";
	$carpeta3b = "../cbj_Docs/".$vn3b;
	if (!file_exists($carpeta3b)) {
		mkdir($carpeta3b, 0777, true);
		copy("cbj_Images/untitled.png", $carpeta3b."/untitled.png");
		copy("cbj_Images/pdf.png", $carpeta3b."/pdf.png");
		$data0 = $data0."\t* OK DIRECTORIO ".$carpeta3b."\n";
		}
		else{//print("* NO OK EL DIRECTORIO ".$carpeta3b."\n");
			$data0 = $data0."\t* NO OK DIRECTORIO ".$carpeta3b."\n";
		}

/************	PASAMOS LOS PARAMETROS A .LOG	*****************/

$datein = date('Y-m-d H:i:s');
$logdate = date('Y-m-d');
$logtext = "\n - CONFIG INIT ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$data0.$table1.$table5.$table6."\n";
$filename = "logs/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);
	
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
function crear_tablas(){
	
	// CREA EL DIRECTORIO DE SYS DOCS.

	global $data0;
	$carpeta = "../cbj_Docs";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = "\t* OK DIRECTORIO cbj_Docs. \n";
		}
		else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
				$data0 = "\t* YA EXISTE EL DIRECTORIO cbj_Docs. \n";
			}

	global $db;				global $db_name;
	global $db_host; 		global $db_user;
	global $db_pass; 		global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/
					
	$admin = "CREATE TABLE `$db_name`.`admin` (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
		
					global $table1;
					$table1 = "\t* OK TABLA ADMIN. \n";
			
				} else {
					
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db)." \n";
					
					}
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	$visitas = "CREATE TABLE `$db_name`.`visitasadmin` (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
					global $table2;
					$table2 = "\t* OK TABLA VISITAS ADMIN. \n";
			
				} else {
					
					global $table2;
					$table2 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db)." \n";
				
					}
					
	$vd = "INSERT INTO `$db_name`.`visitasadmin` (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
(69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
						
					global $table3;
					$table3 = "\t* OK INIT VALUES EN VISITAS ADMIN. \n";

				} else {
					
					global $table3;
					$table3 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db)." \n";
				
					}

	/************** CREAMOS LA TABLA GASTOS PENDIENTES  ***************/

	$vname1b = "cbj_gastos_pendientes";
	$vname1b = "`".$vname1b."`";
	
	$tgb = "CREATE TABLE `$db_name`.$vname1b (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tgb)){
					global $table4;
					$table4 = "\t* OK TABLA ".$vname1b."\n";
				} else {print( "* NO OK TABLA ".$vname1b.". ".mysqli_error($db)."\n");
					global $table4;
					$table4 = "\t* NO OK TABLA ".$vname1b.". ".mysqli_error($db)."\n";
				}

	/************** CREAMOS LA TABLA INGRESOS PENDIENTES ***************/

	$vname3b = "cbj_ingresos_pendientes";
	$vname3b = "`".$vname3b."`";
	
	$tib = "CREATE TABLE `$db_name`.$vname3b (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $tib)){
					global $table5;
					$table5 = "\t* OK TABLA ".$vname3b."\n";
				} else {print( "* NO OK TABLA ".$vname3b.". ".mysqli_error($db)."\n");
					global $table5;
					$table5 = "\t* NO OK TABLA ".$vname3b.". ".mysqli_error($db)."\n";
				}

	/************** CREAMOS LA TABLA PROVEEDORES ***************/
					
	$vname5 = "cbj_proveedores";
	$vname5 = "`".$vname5."`";
	
	$provee = "CREATE TABLE `$db_name`.$vname5 (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provee)){
		
					global $table6;
					$table6 = "\t* OK TABLA ".$vname5."\n";
			
				} else {
					print("* NO OK TABLA ".$vname5.". ".mysqli_error($db)."</br>");
					global $table6;
					$table6 = "\t* NO OK TABLA ".$vname5.". ".mysqli_error($db)."\n";
					
					}

	$vp = "INSERT INTO `$db_name`.$vname5 (`id`, `ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES
(1, 'ANONIMO', 'ANONIMO', 'untitled.png', 'ANONIMO', 'ANONIMO', 'X', 'ANONIMO', 'ANONIMO', '000000000', '000000000')";
		
	if(mysqli_query($db, $vp)){
										
					global $table7;
					$table7 = "\t* OK INIT VALUES EN ".$vname5."\n";

				} else {
					print("* NO OK INIT VALUES EN ".$vname5.". ".mysqli_error($db)."</br>");
					global $table7;
					$table7 = "\t* NO OK INIT VALUES EN ".$vname5.". ".mysqli_error($db)."\n";
				
					}

	/************** CREAMOS LA TABLA clientes ***************/
					
	$vname6 = "cbj_clientes";
	$vname6 = "`".$vname6."`";
	
	$provei = "CREATE TABLE `$db_name`.$vname6 (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provei)){
		
					global $table8;
					$table8 = "\t* OK TABLA ".$vname6."\n";
			
				} else {
					print("* NO OK TABLA ".$vname6.". ".mysqli_error($db)."</br>");
					global $table8;
					$table8 = "\t* NO OK TABLA ".$vname6.". ".mysqli_error($db)." \n";
					}
					
	$vpi = "INSERT INTO `$db_name`.$vname6 (`id`, `ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES
(1, 'ANONIMO', 'ANONIMO', 'untitled.png', 'ANONIMO', 'ANONIMO', 'X', 'ANONIMO', 'ANONIMO', '000000000', '000000000')";
		
	if(mysqli_query($db, $vpi)){
										
					global $table9;
					$table9 = "\t* OK INIT VALUES EN ".$vname6."\n";

				} else {
			print("* NO OK INIT VALUES EN ".$vname6.". ".mysqli_error($db)."</br>");
			global $table9;
			$table9 = "\t* NO OK INIT VALUES EN ".$vname6.". ".mysqli_error($db)."\n";
				
					}

	/************* CREAMOS LAS TABLAS BALANCES ****************/

	/************** CREAMOS LA TABLA BALANCE GAST ***************/

	$vname7 = "cbj_balanceg";
	$vname7 = "`".$vname7."`";

	$balanceg = "CREATE TABLE `$db_name`.$vname7 (
				  `id` int(2) NOT NULL auto_increment,
				  `year` int(4) NOT NULL,
				  `mes` varchar(4) NOT NULL,
				  `iva` decimal(10,2) unsigned NOT NULL,
				  `sub` decimal(10,2) unsigned NOT NULL,
				  `ret` decimal(10,2) unsigned NOT NULL,
				  `tot` decimal(10,2) unsigned NOT NULL,
				  PRIMARY KEY  (`id`)
				)  ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	if(mysqli_query($db, $balanceg)){
					global $table10;
					$table10 = "\t* OK TABLA ".$vname7.". \n";
				} else {
					print("* NO OK TABLE ".$vname7.". ".mysqli_error($db)."</br>");
					global $table10;
					$table10 = "\t* NO OK TABLA ".$vname7.". ".mysqli_error($db)." \n";
					}
$vname7 = strtolower($vname7);					
$balanceg2 = "INSERT INTO `$db_name`.$vname7 (`id`, `year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
(1, $dy_1, 'M01', '0.00', '0.00', '0.00', '0.00'), 
(2, $dy_1, 'M02', '0.00', '0.00', '0.00', '0.00'), 
(3, $dy_1, 'M03', '0.00', '0.00', '0.00', '0.00'),  
(4, $dy_1, 'M04', '0.00', '0.00', '0.00', '0.00'), 
(5, $dy_1, 'M05', '0.00', '0.00', '0.00', '0.00'), 
(6, $dy_1, 'M06', '0.00', '0.00', '0.00', '0.00'), 
(7, $dy_1, 'M07', '0.00', '0.00', '0.00', '0.00'), 
(8, $dy_1, 'M08', '0.00', '0.00', '0.00', '0.00'), 
(9, $dy_1, 'M09', '0.00', '0.00', '0.00', '0.00'), 
(10, $dy_1, 'M10', '0.00', '0.00', '0.00', '0.00'), 
(11, $dy_1, 'M11', '0.00', '0.00', '0.00', '0.00'), 
(12, $dy_1, 'M12', '0.00', '0.00', '0.00', '0.00'), 
(13, $dy_1, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
(14, $dy_1, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
(15, $dy_1, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
(16, $dy_1, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
(17, $dy_1, 'ANU', '0.00', '0.00', '0.00', '0.00'),
(18, $dy, 'M01', '0.00', '0.00', '0.00', '0.00'), 
(19, $dy, 'M02', '0.00', '0.00', '0.00', '0.00'), 
(20, $dy, 'M03', '0.00', '0.00', '0.00', '0.00'),  
(21, $dy, 'M04', '0.00', '0.00', '0.00', '0.00'), 
(22, $dy, 'M05', '0.00', '0.00', '0.00', '0.00'), 
(23, $dy, 'M06', '0.00', '0.00', '0.00', '0.00'), 
(24, $dy, 'M07', '0.00', '0.00', '0.00', '0.00'), 
(25, $dy, 'M08', '0.00', '0.00', '0.00', '0.00'), 
(26, $dy, 'M09', '0.00', '0.00', '0.00', '0.00'), 
(27, $dy, 'M10', '0.00', '0.00', '0.00', '0.00'), 
(28, $dy, 'M11', '0.00', '0.00', '0.00', '0.00'), 
(29, $dy, 'M12', '0.00', '0.00', '0.00', '0.00'), 
(30, $dy, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
(31, $dy, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
(32, $dy, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
(33, $dy, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')
 ";
		
	if(mysqli_query($db, $balanceg2)){
					global $table11;
					$table11 = "\t* OK INIT VALUES EN ".$vname7.". \n";
				} else {
					print("* NO OK INIT VALUES EN ".$vname7.". ".mysqli_error($db)."</br>");
					global $table11;
					$table11 = "\t* NO OK INIT VALUES EN ".$vname7.". ".mysqli_error($db)." \n";
					}
					
	/************** CREAMOS LA TABLA BALANCE ING ***************/

	$vname8 = "cbj_balancei";
	$vname8 = "`".$vname8."`";

	$balancei = "CREATE TABLE `$db_name`.$vname8 (
				  `id` int(2) NOT NULL auto_increment,
				  `year` int(4) NOT NULL,
				  `mes` varchar(4) NOT NULL,
				  `iva` decimal(10,2) unsigned NOT NULL,
				  `sub` decimal(10,2) unsigned NOT NULL,
				  `ret` decimal(10,2) unsigned NOT NULL,
				  `tot` decimal(10,2) unsigned NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	if(mysqli_query($db, $balancei)){
					global $table12;
					$table12 = "\t* OK TABLA BALANCE ".$vname8.". \n";
				} else {
					print("* NO OK TABLE ".$vname8.". ".mysqli_error($db)."</br>");
					global $table12;
					$table12 = "\t* NO OK TABLA ".$vname8.". ".mysqli_error($db)." \n";
					}
					
$vname8 = strtolower($vname8);					
$balancei2 = "INSERT INTO `$db_name`.$vname8 (`id`, `year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
(1, $dy_1, 'M01', '0.00', '0.00', '0.00', '0.00'), 
(2, $dy_1, 'M02', '0.00', '0.00', '0.00', '0.00'), 
(3, $dy_1, 'M03', '0.00', '0.00', '0.00', '0.00'),  
(4, $dy_1, 'M04', '0.00', '0.00', '0.00', '0.00'), 
(5, $dy_1, 'M05', '0.00', '0.00', '0.00', '0.00'), 
(6, $dy_1, 'M06', '0.00', '0.00', '0.00', '0.00'), 
(7, $dy_1, 'M07', '0.00', '0.00', '0.00', '0.00'), 
(8, $dy_1, 'M08', '0.00', '0.00', '0.00', '0.00'), 
(9, $dy_1, 'M09', '0.00', '0.00', '0.00', '0.00'), 
(10, $dy_1, 'M10', '0.00', '0.00', '0.00', '0.00'), 
(11, $dy_1, 'M11', '0.00', '0.00', '0.00', '0.00'), 
(12, $dy_1, 'M12', '0.00', '0.00', '0.00', '0.00'), 
(13, $dy_1, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
(14, $dy_1, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
(15, $dy_1, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
(16, $dy_1, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
(17, $dy_1, 'ANU', '0.00', '0.00', '0.00', '0.00'),
(18, $dy, 'M01', '0.00', '0.00', '0.00', '0.00'), 
(19, $dy, 'M02', '0.00', '0.00', '0.00', '0.00'), 
(20, $dy, 'M03', '0.00', '0.00', '0.00', '0.00'),  
(21, $dy, 'M04', '0.00', '0.00', '0.00', '0.00'), 
(22, $dy, 'M05', '0.00', '0.00', '0.00', '0.00'), 
(23, $dy, 'M06', '0.00', '0.00', '0.00', '0.00'), 
(24, $dy, 'M07', '0.00', '0.00', '0.00', '0.00'), 
(25, $dy, 'M08', '0.00', '0.00', '0.00', '0.00'), 
(26, $dy, 'M09', '0.00', '0.00', '0.00', '0.00'), 
(27, $dy, 'M10', '0.00', '0.00', '0.00', '0.00'), 
(28, $dy, 'M11', '0.00', '0.00', '0.00', '0.00'), 
(29, $dy, 'M12', '0.00', '0.00', '0.00', '0.00'), 
(30, $dy, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
(31, $dy, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
(32, $dy, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
(33, $dy, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')
 ";
		
	if(mysqli_query($db, $balancei2)){
					global $table13;
					$table13 = "\t* OK INIT VALUES EN ".$vname8.".  \n";
				} else {
					print("* NO OK INIT VALUES EN ".$vname8.". ".mysqli_error($db)."</br>");
					global $table13;
					$table13 = "\t* NO OK INIT VALUES EN ".$vname8.". ".mysqli_error($db)." \n";
					}

	/************** CREAMOS LA TABLA BALANCE DIF ***************/

	$vname9 = "cbj_balanced";
	$vname9 = "`".$vname9."`";

	$balanced = "CREATE TABLE `$db_name`.$vname9 (
				  `id` int(2) NOT NULL auto_increment,
				  `year` int(4) NOT NULL,
				  `mes` varchar(4) NOT NULL,
				  `iva` decimal(10,2) NOT NULL,
				  `sub` decimal(10,2) NOT NULL,
				  `ret` decimal(10,2) unsigned NOT NULL,
				  `tot` decimal(10,2) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	if(mysqli_query($db, $balanced)){
					global $table14;
					$table14 = "\t* OK TABLA BALANCE ".$vname9.". \n";
				} else {
					print("* NO OK TABLE ".$vname9.". ".mysqli_error($db)."</br>");
					global $table14;
					$table14 = "\t* NO OK TABLA ".$vname9.". ".mysqli_error($db)." \n";
					}
					
$vname9 = strtolower($vname9);					
$balanced2 = "INSERT INTO `$db_name`.$vname9 (`id`, `year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
(1, $dy_1, 'M01', '0.00', '0.00', '0.00', '0.00'), 
(2, $dy_1, 'M02', '0.00', '0.00', '0.00', '0.00'), 
(3, $dy_1, 'M03', '0.00', '0.00', '0.00', '0.00'),  
(4, $dy_1, 'M04', '0.00', '0.00', '0.00', '0.00'), 
(5, $dy_1, 'M05', '0.00', '0.00', '0.00', '0.00'), 
(6, $dy_1, 'M06', '0.00', '0.00', '0.00', '0.00'), 
(7, $dy_1, 'M07', '0.00', '0.00', '0.00', '0.00'), 
(8, $dy_1, 'M08', '0.00', '0.00', '0.00', '0.00'), 
(9, $dy_1, 'M09', '0.00', '0.00', '0.00', '0.00'), 
(10, $dy_1, 'M10', '0.00', '0.00', '0.00', '0.00'), 
(11, $dy_1, 'M11', '0.00', '0.00', '0.00', '0.00'), 
(12, $dy_1, 'M12', '0.00', '0.00', '0.00', '0.00'), 
(13, $dy_1, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
(14, $dy_1, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
(15, $dy_1, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
(16, $dy_1, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
(17, $dy_1, 'ANU', '0.00', '0.00', '0.00', '0.00'),
(18, $dy, 'M01', '0.00', '0.00', '0.00', '0.00'), 
(19, $dy, 'M02', '0.00', '0.00', '0.00', '0.00'), 
(20, $dy, 'M03', '0.00', '0.00', '0.00', '0.00'),  
(21, $dy, 'M04', '0.00', '0.00', '0.00', '0.00'), 
(22, $dy, 'M05', '0.00', '0.00', '0.00', '0.00'), 
(23, $dy, 'M06', '0.00', '0.00', '0.00', '0.00'), 
(24, $dy, 'M07', '0.00', '0.00', '0.00', '0.00'), 
(25, $dy, 'M08', '0.00', '0.00', '0.00', '0.00'), 
(26, $dy, 'M09', '0.00', '0.00', '0.00', '0.00'), 
(27, $dy, 'M10', '0.00', '0.00', '0.00', '0.00'), 
(28, $dy, 'M11', '0.00', '0.00', '0.00', '0.00'), 
(29, $dy, 'M12', '0.00', '0.00', '0.00', '0.00'), 
(30, $dy, 'TRI1', '0.00', '0.00', '0.00', '0.00'),
(31, $dy, 'TRI2', '0.00', '0.00', '0.00', '0.00'),
(32, $dy, 'TRI3', '0.00', '0.00', '0.00', '0.00'),
(33, $dy, 'TRI4', '0.00', '0.00', '0.00', '0.00'),
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')
 ";
		
	if(mysqli_query($db, $balanced2)){
					global $table15;
					$table15 = "\t* OK INIT VALUES BALANCE ".$vname9.". \n";
				} else {
					print("* NO OK INIT VALUES EN ".$vname9.". ".mysqli_error($db)."</br>");
					global $table15;
					$table15 = "\t* NO OK INIT VALUES ".$vname9.". ".mysqli_error($db)." \n";
					}

	/************** CREAMOS LA TABLA IMPUESTOS ***************/

	$vname10 = "cbj_impuestos";
	$vname10 = "`".$vname10."`";

	$impuestos = "CREATE TABLE `$db_name`.$vname10 (
				  `id` int(2) NOT NULL auto_increment,
  				  `iva` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  				  `name` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NAME %',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=6 ";
		
	if(mysqli_query($db, $impuestos)){
					global $table16;
					$table16 = "\t* OK TABLA ".$vname10.". \n";
				} else {
					print("* NO OK TABLE ".$vname10.". ".mysqli_error($db)."</br>");
					global $table16;
					$table16 = "\t* NO OK TABLA ".$vname10.". ".mysqli_error($db)." \n";
					}
					
$vname10 = strtolower($vname10);					
$impuestos2 = "INSERT INTO `$db_name`.$vname10 (`id`, `iva`, `name`) VALUES
(1, '0.00', '% IMPUESTOS'), 
(2, '0.00', '0.00 %'), 
(3, '4.00', '4.00 %'), 
(4, '10.00', '10.00 %'),  
(5, '21.00', '21.00 %') 
";
		
	if(mysqli_query($db, $impuestos2)){
					global $table17;
					$table17 = "\t* OK INIT VALUES EN ".$vname10.". \n";
				} else {
					print("* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
					global $table17;
					$table17 = "\t* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)." \n";
					}

	/************** CREAMOS LA TABLA STATUS ***************/

	$vname11 = "cbj_status";
	$vname11 = "`".$vname11."`";

	$status = "CREATE TABLE `$db_name`.$vname11 (
				  `id` int(2) NOT NULL auto_increment,
  				  `year` int(4) NOT NULL,
   				  `ycod` int(2) NOT NULL,
 				  `stat` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'open',
 				  `hidden` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'no',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ";
		
	if(mysqli_query($db, $status)){
					global $table18;
					$table18 = "\t* OK TABLA ".$vname11.". \n";
				} else {
					print("* NO OK TABLE ".$vname11.". ".mysqli_error($db)."</br>");
					global $table18;
					$table18 = "\t* NO OK TABLA ".$vname11.". ".mysqli_error($db)." \n";
					}
global $y1;
global $y1b;
$y1 = date('Y')-1;
$y1b = date('y')-1;					
global $y2;
global $y2b;
$y2 = date('Y');
$y2b = date('y');
$vname11 = strtolower($vname11);					
$status2 = "INSERT INTO `$db_name`.$vname11 (`id`, `year`, `ycod`, `stat`, `hidden`) VALUES
(1, '$y1', '$y1b', 'open', 'no'), 
(2, '$y2', '$y2b', 'open', 'no') ";

	if(mysqli_query($db, $status2)){
					global $table19;
					$table19 = "\t* OK INIT VALUES EN ".$vname11.". \n";
				} else {
					print("* NO OK INIT VALUES EN ".$vname11.". ".mysqli_error($db)."</br>");
					global $table19;
					$table19 = "\t* NO OK INIT VALUES EN ".$vname11.". ".mysqli_error($db)." \n";
					}

	/************** CREAMOS LA TABLA FEEDBACK ***************/

	$vname12 = "cbj_feedback";
	$vname12 = "`".$vname12."`";

	$feedback = "CREATE TABLE `$db_name`.$vname12 (
				  `id` int(2) NOT NULL auto_increment,
  				  `year` int(4) NOT NULL,
   				  `ycod` int(2) NOT NULL,
 				  `stat` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'open',
 				  `hidden` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'no',
				  `date` varchar(19) collate utf8_spanish2_ci NOT NULL default '00-00-00/00:00:00',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $feedback)){
					global $table20;
					$table20 = "\t* OK TABLA ".$vname12.". \n";
				} else {
					print("* NO OK TABLE ".$vname12.". ".mysqli_error($db)."</br>");
					global $table20;
					$table20 = "\t* NO OK TABLA ".$vname12.". ".mysqli_error($db)." \n";
					}

	/************** CREAMOS LA TABLA RETENCION ***************/

	$vname13 = "cbj_retencion";
	$vname13 = "`".$vname13."`";

	$retencion = "CREATE TABLE `$db_name`.$vname13 (
				  `id` int(2) NOT NULL auto_increment,
  				  `ret` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  				  `name` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NAME %',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=6 ";
		
	if(mysqli_query($db, $retencion)){
					global $table21;
					$table21 = "\t* OK TABLA ".$vname13.". \n";
				} else {
					print("* NO OK TABLE ".$vname13.". ".mysqli_error($db)."</br>");
					global $table21;
					$table21 = "\t* NO OK TABLA ".$vname13.". ".mysqli_error($db)." \n";
					}
					
$vname13 = strtolower($vname13);					
$retencion2 = "INSERT INTO `$db_name`.$vname13 (`id`, `ret`, `name`) VALUES
(1, '0.00', '% RETENCION'), 
(2, '0.00', '0.00 %'), 
(3, '15.00', '15.00 %') 
 ";
		
	if(mysqli_query($db, $retencion2)){
					global $table22;
					$table22 = "\t* OK INIT VALUES EN ".$vname10.". \n";
				} else {
					print("* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
					global $table22;
					$table22 = "\t* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)." \n";
					}

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
global $data0;
global $cfone;
$datein = date('Y-m-d H:i:s');
$logdate = date('Y-m-d');
$logtext = $cfone."\n - CONFIG INIT ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$data0.$table1.$table2.$table3.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.$table15.$table16.$table17.$table18.$table19.$table20.$table21.$table22."\n";
$filename = "logs/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/*
function modifcbj(){
									   							
	$filename = "../cbj_Docs/ayear.php";

	$contenido = "<?php\n \$dy = array ('' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',\n);\n?>";
	
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}
*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modifcbj2(){

	$filename = "../cbj_Docs/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat2;
	$dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/*
function modif(){
									   							
	$filename = "ayear.php";
	
	$contenido = "<?php\n \$dy = array ('' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',\n);\n?>";
	
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}
*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif2(){

	$filename = "year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ayear(){
	$filename = "year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget != date('Y')){ 
			//modifcbj();
			modifcbj2();
			//modif(); 
			modif2();
		}

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if($_POST['config']){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '');
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
		
	print("<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
				SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px\">

				<tr>
					<th colspan=2 class='BorderInf'>

							INIT CONFIG DATA
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=200px>
		<input type='text' name='host' size=25 maxlength=22 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td width=200px>
		<input type='text' name='user' size=25 maxlength=22 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td width=200px>
		<input type='text' name='pass' size=25 maxlength=22 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td width=200px>
		<input type='text' name='name' size=25 maxlength=22 value='".$defaults['name']."' />
					</td>
				</tr>
					
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' />
						<input type='hidden' name='config' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>