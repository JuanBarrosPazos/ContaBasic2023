<?php

	require 'Inclu/error_hidden.php';
	global $index; 		$index = 1;

	require 'Inclu/Admin_Inclu_01b2.php';
	//require 'Inclu/Admin_0.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	// LÓGICA DE EJECUCIÓN DEL PROGRAMA DE INSTALACIÓN
				 
	if(isset($_POST['config'])){
			$_SESSION['inst'] = "noinst";						
		if($form_errors = validate_form()){
						  show_form($form_errors);
		} else { process_form();
				 require 'Inclu/my_bbdd_clave.php';
				 require 'Conections/conection.php';
				 mysqli_report(MYSQLI_REPORT_OFF);
				 global $db;
				 @$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
				if (!$db){	global $dbconecterror; // PARA LOG
							$dbconecterror = $db_name." * ".mysqli_connect_error();
							global $text; 	$text = $dbconecterror;
							ini_log();
							print ("** NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
							show_form();
					} elseif($db) { config_one();
									crear_tablas();
									crear_dir();
									ayear();
									global $tablepf;
									print($tablepf);
								}
			} // Fin else process_form()
		} else { inittot();
				 show_form(); }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function inittot(){

	require 'Conections/conection.php';
	if(isset($cero_conection)){
		// EL ARCHIVO DE CONEXIÓN ES EL ORIGINAL O SE HA SOBREESCRITO
			global $text;
			$text = "ARCHIVO DE CONEXIÓN ORIGINAL\n";
			ini_log();
			$_SESSION['inst'] = "noinst";
			global $inst;
			$inst = '';
	}else{
		// SE INTENTA LA CONEXION A LA BBDD
		// SI NO ES POSIBLE CONECTAR SE APLICAN LOS PARAMETROS "noinst"
		// SI CONSIGUE CONECTAR MUESTRA LAS OPCIONES DISPONIBLES AL USUARIO

	require 'Inclu/error_hidden.php';
	require 'Inclu/my_bbdd_clave.php';
	require 'Conections/conection.php';
	global $db;
	mysqli_report(MYSQLI_REPORT_OFF);
	$db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ //print ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				$_SESSION['inst'] = "noinst";
				global $inst;
				$inst = '';
	}else{
		//echo "HA CONECTADO CON LA BBDD<br>";
	global $inst;
	$inst = 1;

	/* VERIFICO LAS TABLAS CON LA CLAVE EN LA BBDD */
	require 'config/num_tab_clave_bd.php';
	/* VERIFICO SI EXISTEN TABLAS EN LA BBDD */
	require 'config/num_tab_bd.php';

	/* DETECTA LA CONEXIÓN SIN TABLAS CON CLAVE COINCIDENTE O SIN TABLA ADMIN */
	if(($inst == 1)&&(($countcl < 1)||($countcl < 4)||($countbamd < 1))){
		$_SESSION['inst'] = "inst";
		global $link;
		$link = "<tr>
					<th align='center' class='BorderInf'>
						<font color='#FF0000'>
							0 EXISTE UNA INSTALACION ERRONEA EN BBDD".$infoAdm.$infoTAdmin.$infoTClave.$infoTBbdd."
						</font>
					</th>
				</tr>
				<tr>
					<th align='center'>
						INICIAR UNA INSTALACIÓN LIMPIA
					</th>
				</tr>
				<tr>
			<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
				<td  align='center'>
			<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' class='botonrojo' />
			<input type='hidden' name='limpia' value=1 />
			</br></br>
				</td>
			</fomr>
				</tr>";
		global $text;
		$text ="FORMULARIO CONFIG: EXISTE UNA INSTALACION ERRONEA EN LA BBDD";
		ini_log();
	}
	/* DETECTA LA CONEXIÓN Y UNA INSTALACIÓN INCOMPLETA SIN ADMINISTRADOR */
	else if(($inst == 1)&&($countadm < 1)){
		$_SESSION['inst'] = "inst";
		global $link;
		$link = "<tr>
					<th align='center' class='BorderInf'>
						<font color='#FF0000'>
							1 EXISTE UNA INSTALACION INCOMPLETA
							<br>
							SIN ADMINISTRADOR
							".$infoAdm.$infoTClave.$infoTBbdd."
						</font>
					</th>
				</tr>
				<tr>
					<th align='center'>
						CONTINUAR CON ESTA INSTALACIÓN
					</th>
				</tr>
				<tr>
					<td align='center' class='BorderInf'>
						<a href='config/config2.php'>
							CREE EL USUARIO ADMINISTRADOR
			 			</a>
					</td>
				</tr>
				<tr>
					<th align='center'>
						INICIAR UNA INSTALACIÓN LIMPIA
					</th>
				</tr>
				<tr>
			<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
				<td  align='center'>
			<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' class='botonrojo' />
			<input type='hidden' name='limpia' value=1 />
				</td>
			</fomr>
				</tr>";
		global $text;
		$text ="FORMULARIO CONFIG: EXISTE UNA INSTALACION INCOMPLETA";
		ini_log();
	/* DETECTA LAS TABLAS CON CLAVE Y LAS DE LA BBDD */
	}elseif(($inst == 1)&&(($countcl >= 4)||($totTablas >= 4))){
			$_SESSION['inst'] = "inst";
			global $link;
			$link = "<tr>
						<th align='center' class='BorderInf'>
							<font color='#FF0000'>
							2 EXISTE UNA INSTALACION ANTERIOR
							".$infoAdm.$infoTAdmin.$infoTClave.$infoTBbdd."
							</font>
						</th>
					</tr>
					<tr>
						<th align='center'>
							MANTENER TABLAS Y DIRECTORIOS
						</th>
					</tr>
					<tr>
				<form name='inscancel' action='config/config2.php' method='post' >
						<td align='center' class='BorderInf'>
				<input type='submit' value='CONTINUE CON LA CONFIGURACIÓN ACTUAL' class='botonverde' />
				<input type='hidden' name='inscancel' value=1 />
				</br></br>
						</td>
				</form>
					</tr>
					<tr>
						<th align='center'>
							INICIAR UNA INSTALACIÓN LIMPIA
						</th>
					</tr>
					<tr>
				<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
					<td  align='center'>
				<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' class='botonrojo' />
				<input type='hidden' name='limpia' value=1 />
				</br></br>
					</td>
				</fomr>
					</tr>";
		global $text;
		$text ="FORMULARIO CONFIG: EXISTE UNA INSTALACION ANTERIOR";
		ini_log();

	}else{ 	$_SESSION['inst'] = "noinst";
			global $link;
		   	$link = "<tr>
		   				<td>
							<a href='config/config2.php'>
		   						CREE EL USUARIO ADMINISTRADOR
							</a>
						</td>
					</tr>";
				} // FIN NO HAY DATOS EN LA BBDD
			} // FIN CONDICIONAL SI CONECTO A LA BBDD

	} // FIN PRIMER ELSE

}	// FIN function inittot()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				 
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){
	
	if(file_exists('config/year.txt')){unlink("config/year.txt");
					global $data1;
					$data1 = PHP_EOL."\tUNLINK config/year.txt";}
			else {print("DON`T UNLINK config/year.txt </br>");
					global $data1;
					$data1 = PHP_EOL."\tDON'T UNLINK config/year.txt";}

	/*
	if(file_exists('config/ayear.php')){unlink("config/ayear.php");
					global $data2;
					$data2 = PHP_EOL."\tUNLINK config/ayear.php";}
			else {print("DON'T UNLINK config/ayear.php </br>");
					global $data2;
					$data2 = PHP_EOL."\tDON'T UNLINK config/ayear.php";}
	*/

	if(!file_exists('config/year.txt')){
			if(file_exists('config/year_Init_System.txt')){
				copy("config/year_Init_System.txt", "config/year.txt");
				global $data3;
				$data3 = PHP_EOL."\tRENAME config/year_Init_System.txt TO config/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				global $data3;
				$data3 = PHP_EOL."\tDON'T RENAME config/year_Init_System.txt TO config/year.txt";}
			}else{	global $data3;
					$data3 = "";}

	/*
	if(!file_exists('config/ayear.php')){
			if(file_exists('config/ayear_Init_System.php')){
				copy("config/ayear_Init_System.php", "config/ayear.php");
				global $data4;
				$data4 = PHP_EOL."\tRENAME config/ayear_Init_System.php TO config/ayear.php";
			} else {print("DON'T RENAME config/ayear_Init_System.php TO config/ayear.php </br>");
				global $data4;
				$data4 = PHP_EOL."\tDON'T RENAME config/ayear_Init_System.php TO config/ayear.php";}
			}else{	global $data4;
					$data4 = "";}
	*/

				/*		****	*/

	if(!file_exists('cbj_Docs/year.txt')){
			if(file_exists('config/year_Init_System.txt')){
				copy("config/year_Init_System.txt", "cbj_Docs/year.txt");
				global $data5;
				$data5 = "\n \t RENAME config/year_Init_System.txt TO "."cbj_Docs/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				global $data5;
				$data5 = "\n \t RENAME config/year_Init_System.txt TO cbj_Docs/year.txt";
				}
			}else{	global $data5;
					$data5 = "";}

	/*
	if(!file_exists('cbj_Docs/ayear.php')){
			if(file_exists('config/ayear_Init_System.php')){
				copy("config/ayear_Init_System.php", "cbj_Docs/ayear.php");
				global $data6;
				$data6 = "\n \t RENAME config/ayear_Init_System.php TO cbj_Docs/ayear.php";
			} else {print("DON'T RENAME config/ayear_Init_System.php TO cbj_Docs/ayear.php </br>");
				global $data6;
				$data6 = "\n \t RENAME config/ayear_Init_System.php TO cbj_Docs/ayear.php";
				}
			}else{	global $data6;
					$data6 = "";}
	*/

	global $text;
	$text = "SUSTITUCION DE ARCHIVOS:".$data1/*.$data2*/.$data3/*.$data4*/.$data5/*.$data6*/;

	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){

	require 'config/validate_Init_System.php';
	
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
	$clave = "'".$_POST['clave']."'";

	$bddata = '<?php
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = '.$host.'; 
	$db_user = '.$user.'; 
	$db_pass = '.$pass.'; 
	$db_name = '.$name.'; 
	?>';
	
	/* CREA EL ARCHIVO DE CONEXIONES */

	$filename = "Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);

	global $text;
	$text ="SE CREA EL ARCHIVO DE CONEXIONES ".$filename."\n\$db_host = ".$host."\n\$db_user = ".$user."\n\$db_pass = ".$pass."\n\$db_name = ".$name;
	ini_log();
	
	global $tablepf;
	$tablepf = "<table>
				<tr>
					<td colspan='2' align='center'>
							SE HA CREADO EL ARCHIVO DE CONEXIONES.
						</br>
							CON LAS SIGUIENTES VARIABLES.
					</td>
				</tr>

				<tr>
					<td style='text-align:right !important;'>VARIABLE HOST ADRESS</td>
					<td style='text-align:left !important;'>\$db_host = ".$host.";</td>		
				</tr>								

				<tr>
					<td style='text-align:right !important;'>VARIABLE USER NAME</td>
					<td style='text-align:left !important;'>\$db_user = ".$user.";</td>		
				</tr>	
												
				<tr>
					<td style='text-align:right !important;'>VARIABLE PASSWORD</td>
					<td style='text-align:left !important;'>\$db_pass = ".$pass.";</td>		
				</tr>	
												
				<tr>
					<td style='text-align:right !important;'>VARIABLE BBDD NAME</td>
					<td style='text-align:left !important;'>\$db_name = ".$name.";</td>		
				</tr>

				<tr>
					<td style='text-align:right !important;'>CLAVE TABLES BBDD</td>
					<td style='text-align:left !important;'>\$clave = ".$clave.";</td>		
				</tr>

				<tr>
		   			<td colspan=2 align='center' class='BorderSup'>
						<a href='config/config2.php'>
		   					CREE EL USUARIO ADMINISTRADOR
						</a>
					</td>
				</tr>
		</table>";
							
		$_SESSION["clave"] = strtolower($_POST['clave'])."_";
		// CREA EL ARCHIVO my_bbdd_clave.php $_SESSION['clave'].
		$filenameb = "Inclu/my_bbdd_clave.php";
		$fw2b = fopen($filenameb, 'w+');
		$myclave = '<?php $_SESSION[\'clave\'] = "'.$_SESSION["clave"].'"; ?>';
		fwrite($fw2b, $myclave);
		fclose($fw2b);
		// IMPRIMO LOG
		global $text;
		$text = "SE CREA EL ARCHIVO DE BBDD CLAVE ".$filenameb."\n\t** CON BBDD CLAVE: ".$_SESSION["clave"];
		ini_log();
	
	} // FIN function process_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function crear_dir(){

	// ESTA FUNCIÓN LA TENGO INTEGRADA EN MOD_ADMIN DENTRO DE function crear_tablas()
		global $data0; 		$carpeta = "cbj_Docs/temp";
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$data0 = $data0."\t* OK DIRECTORIO cbj_Docs/temp. \n";
			}
			else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
					$data0 = $data0."\t* YA EXISTE EL DIRECTORIO cbj_Docs/temp. \n";
				}
	
		$carpeta = "cbj_Docs/log";
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$data0 = $data0."\t* OK DIRECTORIO cbj_Docs/log. \n";
			}
			else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
					$data0 = $data0."\t* YA EXISTE EL DIRECTORIO cbj_Docs/log. \n";
				}
	
		$carpeta = "cbj_Docs/grafics";
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$data0 = $data0."\t* OK DIRECTORIO cbj_Docs/grafics. \n";
			}
			else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
					$data0 = $data0."\t* YA EXISTE EL DIRECTORIO cbj_Docs/grafics. \n";
				}
	
	// CREA EL DIRECTORIO DE IMAGEN DE USUARIO.
	
		$vn1 = "img_admin";
		$carpetaimg = "cbj_Docs/".$vn1;
		if (!file_exists($carpetaimg)) {
			mkdir($carpetaimg, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpetaimg."/untitled.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg."\n";
			}
			else{//print("* NO OK EL DIRECTORIO ".$carpetaimg."\n");
				$data0  = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpetaimg."\n";
			}
		
	// CREA EL DIRECTORIO DE IMAGEN DE PROVEEDOR GASTOS.
	
		$vn1 = "img_proveedores";
		$carpetaimg1 = "cbj_Docs/".$vn1;
		if (!file_exists($carpetaimg1)) {
			mkdir($carpetaimg1, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpetaimg1."/untitled.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg1."\n";
			}
			else{//print("* NO OK EL DIRECTORIO ".$carpetaimg1."\n");
				$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpetaimg1."\n";
			}
		
	// CREA EL DIRECTORIO DE IMAGEN DE PROVEEDOR INGRESOS.
	
		$vn1 = "img_clientes";
		$carpetaimg2 = "cbj_Docs/".$vn1;
		if (!file_exists($carpetaimg2)) {
			mkdir($carpetaimg2, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpetaimg2."/untitled.png");
			$$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg2."\n";
			}
			else{//print("* NO OK EL DIRECTORIO ".$carpetaimg2."\n");
				$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpetaimg2."\n";
			}
		
	// CREA EL DIRECTORIO GRAFICS.
	
		$vn1 = "grafics";
		$carpetaimg2 = "cbj_Docs/".$vn1;
		if (!file_exists($carpetaimg2)) {
			mkdir($carpetaimg2, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpetaimg2."/untitled.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg2."\n";
			}
			else{//print("* YA EXISTE EL DIRECTORIO ".$carpetaimg2."\n");
				$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpetaimg2."\n";
			}
	
	// CREA EL DIRECTORIO DE DOC GASTOS PENDIENTES.
	
		$vn1b = "docgastos_pendientes";
		$carpeta1b = "cbj_Docs/".$vn1b;
		if (!file_exists($carpeta1b)) {
			mkdir($carpeta1b, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpeta1b."/untitled.png");
			copy("config/cbj_Images/pdf.png", $carpeta1b."/pdf.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpeta1b."\n";
			}
			else{//print("* YA EXISTE EL DIRECTORIO ".$carpeta1b."\n");
				$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpeta1b."\n";
			}
	
	// CREA EL DIRECTORIO DE IMAGENES.
	
		$vn3b = "docingresos_pendientes";
		$carpeta3b = "cbj_Docs/".$vn3b;
		if (!file_exists($carpeta3b)) {
			mkdir($carpeta3b, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpeta3b."/untitled.png");
			copy("config/cbj_Images/pdf.png", $carpeta3b."/pdf.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpeta3b."\n";
			}
			else{//print("* NO OK EL DIRECTORIO ".$carpeta3b."\n");
				$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpeta3b."\n";
			}

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
	$datein = date('Y-m-d H:i:s');

	global $text;
	$text = " CONFIG INIT ".$datein.".\n** index.php function crear_dir() \n".$data0."\n";

	ini_log();
		
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function crear_tablas(){
	
	// CREA EL DIRECTORIO DE SYS DOCS.
	// LUEGO LLAMA A function crear_dir() 

	global $data0;
	$carpeta = "cbj_Docs";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = "\t* OK DIRECTORIO cbj_Docs. \n";
		}
		else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
				$data0 = "\t* YA EXISTE EL DIRECTORIO cbj_Docs. \n";
			}

	require 'Inclu/my_bbdd_clave.php';
	require 'config/Inc_Crea_Tablas.php';

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/*
function modifcbj(){
									   							
	$filename = "cbj_Docs/ayear.php";

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

	$filename = "cbj_Docs/year.txt";
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
									   							
	$filename = "config/ayear.php";
	
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

	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ayear(){
	$filename = "config/year.txt";
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
	
	if(isset($_POST['config'])){

		require 'config/num_tab_bd.php';

		$defaults = $_POST;
		} else {$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
									'clave' => '',);
								   }
	if ($errors){

		print("	<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left'>");
		global $text;
		$text = "show_form(); ERRORES VALIDACION FORMULARIO CONEXIONES BBDD";
		ini_log();

		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font> ".$errors [$a]."<br/>");

				// ESCRIBE ERRORES EN INI_LOG
				global $text;
				$text = $errors[$a];
				$logdate = date('Y-m-d');
				$logtext = "\t ** ".$text.PHP_EOL;
				$filename = "config/logs/ini_log_".$logdate.".log";
				$log = fopen($filename, 'ab+');
				fwrite($log, $logtext);
				fclose($log);
						}
		print("</td>
				</tr>
				</table>");

		} else { }
					
	global $link;
	if($_SESSION['inst'] == "inst"){ print ("<table align='center'>
														".$link."
											</table>");		
	}else{
	print("<table align='center' style=\"margin-top:10px;\">
					<tr>
					<td style='color:red' align='center'>
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
			SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px;\">
				<tr>
					<th colspan=2 class='BorderInf'>
							INIT CONFIG DATA
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td style='text-align:right !important;' width=140px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=180px>
		<input type='text' name='host' size=25 maxlength=25 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td>
		<input type='text' name='user' size=25 maxlength=25 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td>
		<input type='text' name='pass' size=25 maxlength=25 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td>
		<input type='text' name='name' size=25 maxlength=25 value='".$defaults['name']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'	
						<font color='#FF0000'>*</font>
						TABLES SYSTEM CLAVE
					</td>
					<td>
		<input type='text' name='clave' size=25 maxlength=3 value='".$defaults['clave']."' />
					</td>
				</tr>
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' class='botonverde' />
						<input type='hidden' name='config' value=1 />
					</td>
				</tr>
		</form>														
			</table>"); 
		} // FIN PRINT TABLE
	
	} // FIN FUNCTION SHOW_FORM	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ini_log(){

		$ActionTime = date('H:i:s');

		global $text;

		$logdate = date('Y-m-d');

		$logtext = "** ".$ActionTime.PHP_EOL."\t** ".$text.PHP_EOL;
		$filename = "config/logs/ini_log_".$logdate.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

			 
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>