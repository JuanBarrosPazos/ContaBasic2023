<?php

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01a.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
				show_form($form_errors);
						} else {process_form();
								modif();
								modif2();
										}
	} else {show_form();}
								
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){
	
	if(file_exists('../index.php')){unlink("../index.php");
					$data1 = "\n \t UNLINK ../index.php";}
			else {print("ERROR UNLINK ../index.php </br>");
					$data1 = "\n \t ERROR UNLINK ../index.php";}

	if(!file_exists('../index.php')){
			if(file_exists('index_Play_System.php')){
				copy("index_Play_System.php", "../index_Play_System.php");
				$data2 = "\n \t COPY ../index_Play_System.php";
				} else {print("ERROR COPY index_Play_System.php </br>");
						$data2 = "\n \t ERROR COPY index_Play_System.php";}
			} 

	if(file_exists('../index_Play_System.php')){
				rename("../index_Play_System.php", "../index.php");
				$data3 = "\n \t RENAME ../index_Play_System.php TO ../index.php";
			} else {print("ERROR RENAME ../index_Play_System.php TO ../index.php </br>");
				$data3 = "\n \t ERROR RENAME ../index_Play_System.php TO ../index.php";}

	/*		****	*/

	if(!file_exists('../cbj_Docs/year.txt')){
			if(file_exists('year_Init_System.txt')){
				copy("year_Init_System.txt", "../cbj_Docs/year.txt");
				$data4 = "\n \t RENAME year_Init_System.txt TO ../cbj_Docs/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				$data4 = "\n \t RENAME year_Init_System.txt TO ../cbj_Docs/year.txt";
				}
			}

	if(!file_exists('../cbj_Docs/ayear.php')){
			if(file_exists('ayear_Init_System.php')){
				copy("ayear_Init_System.php", "../cbj_Docs/ayear.php");
				$data5 = "\n \t RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php";
			} else {print("DON'T RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php </br>");
				$data5 = "\n \t RENAME ayear_Init_System.php TO ../cbj_Docs/ayear.php";
				}
			}

	global $cfone;
	$cfone ="\n SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4.$data5;
	
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "../cbj_Docs/ayear.php";
	
	$contenido = "<?php\n \$dy = array ('' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',\n);\n?>";
	
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif2(){

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

function validate_form(){
	
	global $sqld;
	global $qd;
	global $rowd;
	
		require 'validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
/*	REFERENCIA DE USUARIO	*/

if (preg_match('/^(\w{1})/',$_POST['Nombre'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
														/*print($ref1[1]."</br>");*/
														}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Nombre'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
														/*print($ref2[2]."</br>");*/
														}
if (preg_match('/^(\w{1})/',$_POST['Apellidos'],$ref3)){	$rf3 = $ref3[1];
															$rf3 = trim($rf3);
														/*print($ref3[1]."</br>");*/
														}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Apellidos'],$ref4)){	$rf4 = $ref4[2];
																	$rf4 = trim($rf4);
														/*print($ref4[2]."</br>");*/
														}

	global $rf;
	$rf = $rf1.@$rf2.$rf3.@$rf4.$_POST['dni'].$_POST['ldni'];
	$rf = trim($rf);
	$rf = strtolower($rf);

	$_SESSION['iniref'] = $rf;

			////////////////////		**********  		////////////////////
	
	crear_tablas();

			////////////////////		**********  		////////////////////

	global $vni;
	global $carpetaimg;
	
	$trf = $_SESSION['iniref'];
	
	$vn1 = "img_admin";
	$carpetaimg = "../cbj_Docs/".$vn1;

	if($_FILES['myimg']['size'] == 0){
			$nombre = $carpetaimg."/untitled.png";
			global $new_name;
			$new_name = $rf.".png";
			$rename_filename = $carpetaimg."/".$new_name;							
			copy("untitled.png", $rename_filename);
												}
												
	else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		 	$nombre = $_FILES['myimg']['name'];
		  	$nombre_tmp = $_FILES['myimg']['tmp_name'];
		  	$tipo = $_FILES['myimg']['type'];
		  	$tamano = $_FILES['myimg']['size'];
		  
			$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
			
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			global $new_name;
			$new_name = $rf.".".$extension;
			$rename_filename = $carpetaimg."/".$new_name;								
			rename($destination_file, $rename_filename);

			// print("El archivo se ha guardado en: ".$destination_file);
	
			}
			
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		
		}

	global $nombre;
	global $apellido;

	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $db_name;

	$sql = "INSERT INTO `$db_name`.`admin` (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$new_name', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
	if(mysqli_query($db, $sql)){
		
	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						SE HA REGISTRADO COMO WEB MASTER.
					</th>
				</tr>
								
				<tr>
					<td width=150px>
						Nombre:
					</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='4' align='center' width='100px'>
				<img src='".$carpetaimg."/".$new_name."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td colspan='2'>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tipo Usuario
					</td>
					<td colspan='2'>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Referencia Usuario
					</td>
					<td colspan='2'>"
						.$rf.
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan='2'>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan='2'>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				
				<tr>
				
					<td>
						Pais:
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 1:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 2:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<a href=\"../index.php\">
							
									ADMINISTRADOR ACCESO A INICIO DEL SISTEMA 
							
						</a>
					</td>
				</tr>
								
			</table>");

global $cfone;
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = $cfone."\n - CREADO USER ADMIN 1. ".$datein.". User Ref: ".$rf.".\n \t Name: ".$_POST['Nombre']." ".$_POST['Apellidos'].". \n \t User: ".$_POST['Usuario'].".\n \t Pass: ".$_POST['Password'].".\n";
$filename = "logs/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

	config_one();
				
	} else {
					
				print("</br>
				<font color='#FF0000'>
			* Estos datos no son validos, modifique esta entrada: </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
				
					}

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function crear_tablas(){
	
	global $db;	
	global $db_name;
	global $db_host;
	global $db_user;
	global $db_pass;
	global $dbconecterror;
	
	$trf = $_SESSION['iniref'];
	
	/************** CREAMOS LA TABLA GASTOS  ***************/

	$vname1 = "cbj_gastos_".date('Y');
	$vname1 = "`".$vname1."`";
	
	$tg = "CREATE TABLE `$db_name`.$vname1 (
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
		
	if(mysqli_query($db, $tg)){
					global $data1;
					$data1 = "\t* OK TABLA ".$vname1."\n";
				} else {
					print( "* NO OK TABLA ".$vname1.". ".mysqli_error($db)."\n");
					global $data1;
					$$data1 = "\t* NO OK TABLA ".$vname1.". ".mysqli_error($db)."\n";
				}

// CREA EL DIRECTORIO DE DOC GASTOS.

	$vn1 = "docgastos_".date('Y');
	$carpeta1 = "../cbj_Docs/".$vn1;
	if (!file_exists($carpeta1)) {
		mkdir($carpeta1, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta1."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta1."/pdf.png");
		$data2 = "\t* OK DIRECTORIO ".$carpeta1."\n";
		}
		else{//print("* NO OK EL DIRECTORIO ".$carpeta1."\n");
		$data2 = "\t* NO OK DIRECTORIO ".$carpeta1."\n";
		}

	/************** CREAMOS LA TABLA GASTOS del año anterior  ***************/

	$vname2 = "cbj_gastos_".(date('Y')-1);
	$vname2 = "`".$vname2."`";
	
	$tg2 = "CREATE TABLE `$db_name`.$vname2 (
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
		
	if(mysqli_query($db, $tg2)){
					global $data3;
					$data3 = "\t* OK TABLA ".$vname2." \n";
				} else {
					print( "* NO OK TABLA ".$vname2.". ".mysqli_error($db)."\n");
					global $data3;
					$data3 = "\t* NO OK TABLA ".$vname2.". ".mysqli_error($db)."\n";
				}
				
// CREA EL DIRECTORIO DE GASTOS DE AÑO ANTERIOR.

	$vn2 = "docgastos_".(date('Y')-1);
	$carpeta2 = "../cbj_Docs/".$vn2;
	if (!file_exists($carpeta2)) {
		mkdir($carpeta2, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta2."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta2."/pdf.png");
		$data4 = "\t* OK DIRECTORIO ".$carpeta2."\n";
		}
		else{print("* NO OK DIRECTORIO ".$carpeta2."\n");
		$data4 = "\t* NO OK DIRECTORIO ".$carpeta2."\n";
		}
	
	/************** CREAMOS LA TABLA INGRESOS  ***************/

	$vname3 = "cbj_ingresos_".date('Y');
	$vname3 = "`".$vname3."`";
	
	$ti = "CREATE TABLE `$db_name`.$vname3 (
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
		
	if(mysqli_query($db, $ti)){
					global $data5;
					$data5 = "\t* OK TABLA ".$vname3."\n";
				} else {
					print( "* NO OK TABLA ".$vname3.". ".mysqli_error($db)."\n");
					global $data5;
					$data5 = "\t* NO OK TABLA ".$vname3.". ".mysqli_error($db)."\n";
				}
				
// CREA EL DIRECTORIO DE INGRESOS DEL AÑO.

	$vn3 = "docingresos_".date('Y');
	$carpeta3 = "../cbj_Docs/".$vn3;
	if (!file_exists($carpeta3)) {
		mkdir($carpeta3, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta3."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta3."/pdf.png");
		$data6 = "\t* OK DIRECTORIO ".$carpeta3."\n";
		}
		else{print("* NO OK EL DIRECTORIO ".$carpeta3."\n");
		$data6 = "\t* NO OK DIRECTORIO ".$carpeta3."\n";
		}
	
	/************** CREAMOS LA TABLA INGRESOS del año anterior  ***************/

	$vname4 = "cbj_ingresos_".(date('Y')-1);
	$vname4 = "`".$vname4."`";
	
	$ti2 = "CREATE TABLE `$db_name`.$vname4 (
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
		
	if(mysqli_query($db, $ti2)){
					global $data7;
					$data7 = "\t* OK TABLA ".$vname4."\n";
				} else {
					print( "* NO OK TABLA ".$vname4.". ".mysqli_error($db)."\n");
					global $data7;
					$data7 = "\t* NO OK TABLA ".$vname4.". ".mysqli_error($db)."\n";
				}
				
// CREA EL DIRECTORIO DE INGRESOS DEL AÑO ANTERIOR.

	$vn4 = "docingresos_".(date('Y')-1);
	$carpeta4 = "../cbj_Docs/".$vn4;
	if (!file_exists($carpeta4)) {
		mkdir($carpeta4, 0777, true);
		copy("../cbj_Images/untitled.png", $carpeta4."/untitled.png");
		copy("../cbj_Images/pdf.png", $carpeta4."/pdf.png");
		$data8 = "\t* OK DIRECTORIO ".$carpeta4."\n";
		}
		else{print("* NO OK EL DIRECTORIO ".$carpeta4."\n");
		$data8 = "\t* NO OK DIRECTORIO ".$carpeta4."\n";
		}
	
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = "- CONFIG INIT ".$datein.".\n * ".$db_name.". \n * ".$db_host.". \n * ".$db_user.". \n * ".$db_pass."\n".$dbconecterror.$data1.$data2.$data3.$data4.$data5.$data6.$data7.$data8."\n";
$filename = "logs/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
	fclose($log);

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {
				$defaults = array ( 'Nombre' => '',
									'Apellidos' => '',
									'myimg' => isset($_POST['myimg']),	
									'Nivel' => '',
									'ref' => '',
									'doc' => '',
									'dni' => '',
									'ldni' => '',
									'Email' => 'Solo letras minúsculas',
									'Usuario' => '',
									'Usuario2' => '',
									'Password' => '',
									'Password2' => '',
									'Direccion' => '',
									'Tlf1' => '',
									'Tlf2' => '',
									'myimg' => '',
								);
								   }
	
	
	if ($errors){
		print("<table align='center'>
				<tr>
					<th style='text-center'>
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
		
	$Nivel = array (	'admin' => 'WEB MASTER',
															);														

	$doctype = array (	'DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
						'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
						'NIFsa' => 'NIF Sociedad An&oacute;nima',
						'NIFsrl' => 'NIF Sociedad Responsabilidad Limitada',
						'NIFscol' => 'NIF Sociedad Colectiva',
						'NIFscom' => 'NIF Sociedad Comanditaria',
						'NIFcbhy' => 'NIF Comunidad Bienes y Herencias Yacentes',
						'NIFscoop' => 'NIF Sociedades Cooperativas',
						'NIFasoc' => 'NIF Asociaciones',
						'NIFcpph' => 'NIF Comunidad Propietarios Propiedad Horizontal',
						'NIFsccspj' => 'NIF Sociedad Civil, con o sin Personalidad Juridica',
						'NIFee' => 'NIF Entidad Extranjera',
						'NIFcl' => 'NIF Corporaciones Locales',
						'NIFop' => 'NIF Organismo Publico',
						'NIFcir' => 'NIF Congragaciones Instituciones Religiosas',
						'NIFoaeca' => 'NIF Organos Admin Estado y Comunidades Autonomas',
						'NIFute' => 'NIF Uniones Temporales de Empresas',
						'NIFotnd' => 'NIF Otros Tipos no Definidos',
						'NIFepenr' => 'NIF Establecimientos Permanentes Entidades no Residentes',
										);
	
			////////////////////		**********  		////////////////////

	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>

							DATOS DEL WEB MASTER
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Ref User:
					</td>
					<td width=360px>
						SE GENERA LA CLAVE AUTOMÁTICAMENTE 
					</td>
				</tr>
					
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td width=360px>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
	<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Tipo Documento:
					</td>
					<td>

	<select name='doc'>");

						
				foreach($doctype as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['doc']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
					

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control:
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel Usuario:
					</td>
					<td>
	
	<select name='Nivel'>");

						
				foreach($Nivel as $optionnv => $labelnv){
					
					print ("<option value='".$optionnv."' ");
					
					if($optionnv == $defaults['Nivel']){
															print ("selected = 'selected'");
																								}
													print ("> $labelnv </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre de Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Usuario:
					</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Password:
					</td>
					<td>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
					</td>
				</tr>


				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td>
						&nbsp;&nbsp;&nbsp;Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Im&aacute;gen < 500 KB:
					</td>
					<td>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='REGISTRARME CON ESTOS DATOS' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
					
				</tr>
				
		</form>														
			
			</table>				
					"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../Inclu_MInd/Master_Index_Admin.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function desconexion(){

			print("<form name='cerrar' action='mcgexit.php' method='post'>
							<tr>
								<td valign='bottom' align='right' colspan='8'>
											<input type='submit' value='Cerrar Sesion' />
								</td>
							</tr>								
											<input type='hidden' name='cerrar' value=1 />
					</form>	
							");
	
			} 
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>