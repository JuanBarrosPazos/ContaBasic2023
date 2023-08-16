<?php

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ini_log_cbj(){

		$ActionTime = date('H:i:s');

		global $text;

		$logdate = date('Y-m-d');

		$logtext = "** ".$ActionTime.PHP_EOL."\t** ".$text.PHP_EOL;
		$filename = "../Mod_Conta/config/logs/ini_log_".$logdate.".log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one_cbj(){
	
	global $data1;
	if(file_exists('../Mod_Conta/config/year.txt')){unlink("../Mod_Conta/config/year.txt");
					$data1 = PHP_EOL."\tUNLINK ../Mod_Conta/config/year.txt";}
			else {print("DON`T UNLINK ../Mod_Conta/config/year.txt </br>");
					$data1 = PHP_EOL."\tDON'T UNLINK ../Mod_Conta/config/year.txt";}

	/*
	if(file_exists('../Mod_Conta/config/ayear.php')){unlink("../Mod_Conta/config/ayear.php");
					global $data2;
					$data2 = PHP_EOL."\tUNLINK ../Mod_Conta/config/ayear.php";}
			else {print("DON'T UNLINK config/ayear.php </br>");
					global $data2;
					$data2 = PHP_EOL."\tDON'T UNLINK ../Mod_Conta/config/ayear.php";}
	*/

	global $data3;
	if(!file_exists('../Mod_Conta/config/year.txt')){
			if(file_exists('../Mod_Conta/config/year_Init_System.txt')){
				copy("../Mod_Conta/config/year_Init_System.txt", "../Mod_Conta/config/year.txt");
		$data3 = PHP_EOL."\tRENAME ../Mod_Conta/config/year_Init_System.txt TO ../Mod_Conta/config/year.txt";
			} else {
		//print("DON'T RENAME ../Mod_Conta/config/year_Init_System.txt TO ../Mod_Conta/config/year.txt </br>");
		$data3 = PHP_EOL."\tDON'T RENAME ../Mod_Conta/config/year_Init_System.txt TO ../Mod_Conta/config/year.txt";}
			}else{ $data3 = "";}

	/*
	global $data4;
	if(!file_exists('../Mod_Conta/config/ayear.php')){
			if(file_exists('../Mod_Conta/config/ayear_Init_System.php')){
				copy("../Mod_Conta/config/ayear_Init_System.php", "../Mod_Conta/config/ayear.php");
		$data4 = PHP_EOL."\tRENAME ../Mod_Conta/config/ayear_Init_System.php TO ../Mod_Conta/config/ayear.php";
			} else {
		//print("DON'T RENAME ../Mod_Conta/config/ayear_Init_System.php TO ../Mod_Conta/config/ayear.php </br>");
		$data4 = PHP_EOL."\tDON'T RENAME ../Mod_Conta/config/ayear_Init_System.php TO ../Mod_Conta/config/ayear.php";}
			}else{ $data4 = "";}
	*/

				/*		****	*/

	global $data5;
	if(!file_exists('../Mod_Conta/cbj_Docs/year.txt')){
			if(file_exists('../Mod_Conta/config/year_Init_System.txt')){
				copy("../Mod_Conta/config/year_Init_System.txt", "../Mod_Conta/cbj_Docs/year.txt");
		$data5 = "\n \t RENAME ../Mod_Conta/config/year_Init_System.txt TO "."../Mod_Conta/cbj_Docs/year.txt";
			} else {
		//print("DON'T RENAME ../Mod_Conta/config/year_Init_System.txt TO ../Mod_Conta/config/year.txt </br>");
		$data5 = "\n \t RENAME ../Mod_Conta/config/year_Init_System.txt TO ../Mod_Conta/cbj_Docs/year.txt";
				}
			}else{ $data5 = "";}

	/*
	global $data6;
	if(!file_exists('../Mod_Conta/cbj_Docs/ayear.php')){
			if(file_exists('../Mod_Conta/config/ayear_Init_System.php')){
				copy("../Mod_Conta/config/ayear_Init_System.php", "../Mod_Conta/cbj_Docs/ayear.php");
		$data6 = "\n \t RENAME ../Mod_Conta/config/ayear_Init_System.php TO ../Mod_Conta/cbj_Docs/ayear.php";
			} else {
	//print("DON'T RENAME ../Mod_Conta/config/ayear_Init_System.php TO ../Mod_Conta/cbj_Docs/ayear.php </br>");
		$data6 = "\n \t RENAME ../Mod_Conta/config/ayear_Init_System.php TO ../Mod_Conta/cbj_Docs/ayear.php";
				}
			}else{ $data6 = "";}
	*/
  
	// PASAMOS LOS PARAMETROS A LOS LOG.
	global $text; 
	$text = "MOD_CONTA SUSTITUCION DE ARCHIVOS:".$data1/*.$data2*/.$data3/*.$data4*/.$data5/*.$data6*/;

	ini_log_cbj();

	} // FIN function config_one_cbj()
	
	config_one_cbj();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	global $db;			global $db_name;
	global $db_host; 	global $db_user;
	global $db_pass; 	global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/
	// SE CONSTRUYE DESDE MOD_ADMIN
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/
	// SE CONSTRUYE DESDE MOD_ADMIN

	/************** CREAMOS LA TABLA PROVEEDORES ***************/

	global $vname5;
	$vname5 = "`".$_SESSION['clave']."proveedores`";
	
	$provee = "CREATE TABLE `$db_name`.$vname5 (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL default 000000000,
  `Tlf2` int(9) NOT NULL default 000000000,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  PRIMARY KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $table6;
	if(mysqli_query($db, $provee)){
			$table6 = "\t* OK TABLA ".$vname5."\n";
	}else{ print("* NO OK TABLA ".$vname5.". ".mysqli_error($db)."</br>");
			$table6 = "\t* NO OK TABLA ".$vname5.". ".mysqli_error($db)."\n";
			}

	$vp = "INSERT INTO `$db_name`.$vname5 (`id`, `ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES
(1, 'ANONIMO', 'ANONIMO', 'untitled.png', 'ANONIMO', 'ANONIMO', 'X', 'anonimo@anonimo.es', 'Not Adress', 000000000, 000000000)";
		
	global $table7;
	if(mysqli_query($db, $vp)){
			$table7 = "\t* OK INIT VALUES EN ".$vname5."\n";
	}else{ print("* NO OK INIT VALUES EN ".$vname5.". ".mysqli_error($db)."</br>");
			$table7 = "\t* NO OK INIT VALUES EN ".$vname5.". ".mysqli_error($db)."\n";
			}

	/************** CREAMOS LA TABLA PROVEEDORES FEED ***************/

	global $vname5f;
	$vname5f = "`".$_SESSION['clave']."proveedoresfeed`";
	
	$provee = "CREATE TABLE `$db_name`.$vname5f (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NULL,
  `Tlf2` int(9) NULL,
  `borrado` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
 UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provee)){
			$table6 = $table6."\t* OK TABLA ".$vname5f."\n";
	}else{ print("* NO OK TABLA ".$vname5f.". ".mysqli_error($db)."</br>");
			$table6 = $table6."\t* NO OK TABLA ".$vname5f.". ".mysqli_error($db)."\n";
			}

			/************** CREAMOS LA TABLA GASTOS PENDIENTES  ***************/

	global $tablProveedores;
	$tablProveedores = "`".$_SESSION['clave']."proveedores`";
		
	global $vname1b;
	$vname1b = "`".$_SESSION['clave']."gastos_pendientes`";
	
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
  `factret` int(2) unsigned NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)/*,
  INDEX `refprovee` (`refprovee`),
  FOREIGN KEY (`refprovee`) REFERENCES $tablProveedores (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
  */
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $table4;
	if(mysqli_query($db, $tgb)){
			$table4 = "\t* OK TABLA ".$vname1b."\n";
	}else{ print( "* NO OK TABLA ".$vname1b.". ".mysqli_error($db)."\n");
			$table4 = "\t* NO OK TABLA ".$vname1b.". ".mysqli_error($db)."\n";
			}
			

		/************** CREAMOS LA TABLA CLIENTES ***************/

	global $vname6;
	$vname6 = "`".$_SESSION['clave']."clientes`";
	
	$provei = "CREATE TABLE `$db_name`.$vname6 (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NOT NULL default 000000000,
  `Tlf2`int(9) NOT NULL default 000000000,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  PRIMARY KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $table8;
	if(mysqli_query($db, $provei)){
			$table8 = "\t* OK TABLA ".$vname6."\n";
	}else{ print("* NO OK TABLA ".$vname6.". ".mysqli_error($db)."</br>");
			$table8 = "\t* NO OK TABLA ".$vname6.". ".mysqli_error($db)." \n";
			}
					
	$vpi = "INSERT INTO `$db_name`.$vname6 (`id`, `ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES (1, 'ANONIMO', 'ANONIMO', 'untitled.png', 'ANONIMO', 'ANONIMO', 'X', 'anonimo@anonimo.es', 'Not Adress', 000000000, 000000000)";
		
	global $table9;
	if(mysqli_query($db, $vpi)){
			$table9 = "\t* OK INIT VALUES EN ".$vname6."\n";
	}else{ print("* NO OK INIT VALUES EN ".$vname6.". ".mysqli_error($db)."</br>");
			$table9 = "\t* NO OK INIT VALUES EN ".$vname6.". ".mysqli_error($db)."\n";
			}

	/************** CREAMOS LA TABLA CLIENTES FEED ***************/

	global $vname6f;
	$vname6f = "`".$_SESSION['clave']."clientesfeed`";
	
	$provee = "CREATE TABLE `$db_name`.$vname6f (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1` int(9) NULL,
  `Tlf2` int(9) NULL,
  `borrado` datetime collate utf8_spanish2_ci NOT NULL default CURRENT_TIMESTAMP,
 UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provee)){
			$table8 = $table8."\t* OK TABLA ".$vname6f."\n";
	}else{ print("* NO OK TABLA ".$vname6f.". ".mysqli_error($db)."</br>");
			$table8 = $table8."\t* NO OK TABLA ".$vname6f.". ".mysqli_error($db)."\n";
			}

				/************** CREAMOS LA TABLA INGRESOS PENDIENTES ***************/

	global $tblClientes;
	$tblClientes = "`".$_SESSION['clave']."clientes`";

	global $vname3b;
	$vname3b = "`".$_SESSION['clave']."ingresos_pendientes`";
	
	$tib = "CREATE TABLE `$db_name`.$vname3b (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refcliente` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) unsigned NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)/*,
  INDEX `refcliente` (`refcliente`),
  FOREIGN KEY (`refcliente`) REFERENCES $tblClientes (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
  */
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $table5;
	if(mysqli_query($db, $tib)){
			$table5 = "\t* OK TABLA ".$vname3b."\n";
	}else{print( "* NO OK TABLA ".$vname3b.". ".mysqli_error($db)."\n");
		  $table5 = "\t* NO OK TABLA ".$vname3b.". ".mysqli_error($db)."\n";
			}

	/************* CREAMOS LAS TABLAS BALANCES ****************/

	/************** CREAMOS LA TABLA BALANCE GAST ***************/

	global $vname7;
	$vname7 = "`".$_SESSION['clave']."balanceg`";

	$balanceg = "CREATE TABLE `$db_name`.$vname7 (
				  `id` int(2) NOT NULL auto_increment,
				  `year` int(4) NOT NULL,
				  `mes` varchar(4) NOT NULL,
				  `iva` decimal(10,2) NOT NULL,
				  `sub` decimal(10,2) NOT NULL,
				  `ret` decimal(10,2) NOT NULL,
				  `tot` decimal(10,2) NOT NULL,
				  PRIMARY KEY  (`id`)
				)  ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	global $table10;
	if(mysqli_query($db, $balanceg)){
					$table10 = "\t* OK TABLA ".$vname7.". \n";
	} else { print("* NO OK TABLE ".$vname7.". ".mysqli_error($db)."</br>");
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
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
		
	global $table11;
	if(mysqli_query($db, $balanceg2)){
			$table11 = "\t* OK INIT VALUES EN ".$vname7.". \n";
	}else{ print("* NO OK INIT VALUES EN ".$vname7.". ".mysqli_error($db)."</br>");
			$table11 = "\t* NO OK INIT VALUES EN ".$vname7.". ".mysqli_error($db)." \n";
			}
					
	/************** CREAMOS LA TABLA BALANCE ING ***************/

	global $vname8;
	$vname8 = "`".$_SESSION['clave']."balancei`";

	$balancei = "CREATE TABLE `$db_name`.$vname8 (
				  `id` int(2) NOT NULL auto_increment,
				  `year` int(4) NOT NULL,
				  `mes` varchar(4) NOT NULL,
				  `iva` decimal(10,2) NOT NULL,
				  `sub` decimal(10,2) NOT NULL,
				  `ret` decimal(10,2) NOT NULL,
				  `tot` decimal(10,2) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	global $table12;
	if(mysqli_query($db, $balancei)){
			$table12 = "\t* OK TABLA BALANCE ".$vname8.". \n";
	}else{ print("* NO OK TABLE ".$vname8.". ".mysqli_error($db)."</br>");
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
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
		
	global $table13;
	if(mysqli_query($db, $balancei2)){
			$table13 = "\t* OK INIT VALUES EN ".$vname8.".  \n";
	}else{ print("* NO OK INIT VALUES EN ".$vname8.". ".mysqli_error($db)."</br>");
			$table13 = "\t* NO OK INIT VALUES EN ".$vname8.". ".mysqli_error($db)." \n";
			}

	/************** CREAMOS LA TABLA BALANCE DIF ***************/

	global $vname9;
	$vname9 = "`".$_SESSION['clave']."balanced`";

	$balanced = "CREATE TABLE `$db_name`.$vname9 (
				  `id` int(2) NOT NULL auto_increment,
				  `year` int(4) NOT NULL,
				  `mes` varchar(4) NOT NULL,
				  `iva` decimal(10,2) NOT NULL,
				  `sub` decimal(10,2) NOT NULL,
				  `ret` decimal(10,2) NOT NULL,
				  `tot` decimal(10,2) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	global $table14;
	if(mysqli_query($db, $balanced)){
			$table14 = "\t* OK TABLA BALANCE ".$vname9.". \n";
	}else{ print("* NO OK TABLE ".$vname9.". ".mysqli_error($db)."</br>");
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
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
		
	global $table15;
	if(mysqli_query($db, $balanced2)){
			$table15 = "\t* OK INIT VALUES BALANCE ".$vname9.". \n";
	}else{ print("* NO OK INIT VALUES EN ".$vname9.". ".mysqli_error($db)."</br>");
			$table15 = "\t* NO OK INIT VALUES ".$vname9.". ".mysqli_error($db)." \n";
			}

	/************** CREAMOS LA TABLA IMPUESTOS ***************/

	global $vname10;
	$vname10 = "`".$_SESSION['clave']."impuestos`";

	$impuestos = "CREATE TABLE `$db_name`.$vname10 (
				  `id` int(2) NOT NULL auto_increment,
  				  `iva` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  				  `name` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NAME %',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=6 ";
		
	global $table16;
	if(mysqli_query($db, $impuestos)){
			$table16 = "\t* OK TABLA ".$vname10.". \n";
	}else{ print("* NO OK TABLE ".$vname10.". ".mysqli_error($db)."</br>");
			$table16 = "\t* NO OK TABLA ".$vname10.". ".mysqli_error($db)." \n";
			}
					
$vname10 = strtolower($vname10);					
$impuestos2 = "INSERT INTO `$db_name`.$vname10 (`id`, `iva`, `name`) VALUES
(1, '0.00', '% IMPUESTOS'), 
(2, '0.00', '0.00 %'), 
(3, '4.00', '4.00 %'), 
(4, '10.00', '10.00 %'),  
(5, '21.00', '21.00 %')";
		
	global $table17;
	if(mysqli_query($db, $impuestos2)){
			$table17 = "\t* OK INIT VALUES EN ".$vname10.". \n";
	}else{ print("* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
			$table17 = "\t* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)." \n";
			}

	/************** CREAMOS LA TABLA STATUS ***************/

	global $vname11;
	$vname11 = "`".$_SESSION['clave']."status`";

	$status = "CREATE TABLE `$db_name`.$vname11 (
				  `id` int(2) NOT NULL auto_increment,
  				  `year` int(4) NOT NULL,
   				  `ycod` int(2) NOT NULL,
 				  `stat` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'open',
 				  `hidden` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'no',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ";
		
	global $table18;
	if(mysqli_query($db, $status)){
			$table18 = "\t* OK TABLA ".$vname11.". \n";
	}else{ print("* NO OK TABLE ".$vname11.". ".mysqli_error($db)."</br>");
			$table18 = "\t* NO OK TABLA ".$vname11.". ".mysqli_error($db)." \n";
			}
global $y1;		$y1 = date('Y')-1;
global $y1b;	$y1b = date('y')-1;
global $y2;		$y2 = date('Y');
global $y2b;	$y2b = date('y'); 

$vname11 = strtolower($vname11);					
$status2 = "INSERT INTO `$db_name`.$vname11 (`id`, `year`, `ycod`, `stat`, `hidden`) VALUES
(1, '$y1', '$y1b', 'open', 'no'), 
(2, '$y2', '$y2b', 'open', 'no') ";

	global $table19;
	if(mysqli_query($db, $status2)){
			$table19 = "\t* OK INIT VALUES EN ".$vname11.". \n";
	}else{ print("* NO OK INIT VALUES EN ".$vname11.". ".mysqli_error($db)."</br>");
			$table19 = "\t* NO OK INIT VALUES EN ".$vname11.". ".mysqli_error($db)." \n";
			}

	/************** CREAMOS LA TABLA STATUSFEEDBACK ***************/
	// OJO A ESTA TABLA, HAY QUE CAMBIAR EL NOMBRE feedback POR statusfeedback ....
	global $vname12;
	$vname12 = "`".$_SESSION['clave']."statusfeedback`";

	$statusfeedback = "CREATE TABLE `$db_name`.$vname12 (
				  `id` int(2) NOT NULL auto_increment,
  				  `year` int(4) NOT NULL,
   				  `ycod` int(2) NOT NULL,
 				  `stat` varchar(5) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'open',
 				  `hidden` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'no',
				  `date` varchar(19) collate utf8_spanish2_ci NOT NULL default '00-00-00/00:00:00',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $table20;
	if(mysqli_query($db, $statusfeedback)){
			$table20 = "\t* OK TABLA ".$vname12.". \n";
	}else{ print("* NO OK TABLE ".$vname12.". ".mysqli_error($db)."</br>");
			$table20 = "\t* NO OK TABLA ".$vname12.". ".mysqli_error($db)." \n";
			}

	/************** CREAMOS LA TABLA RETENCION ***************/

	global $vname13;
	$vname13 = "`".$_SESSION['clave']."retencion`";

	$retencion = "CREATE TABLE `$db_name`.$vname13 (
				  `id` int(2) NOT NULL auto_increment,
  				  `ret` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  				  `name` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NAME %',
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=6 ";
		
	global $table21;
	if(mysqli_query($db, $retencion)){
			$table21 = "\t* OK TABLA ".$vname13.". \n";
	}else{ print("* NO OK TABLE ".$vname13.". ".mysqli_error($db)."</br>");
			$table21 = "\t* NO OK TABLA ".$vname13.". ".mysqli_error($db)." \n";
			}
					
$vname13 = strtolower($vname13);					
$retencion2 = "INSERT INTO `$db_name`.$vname13 (`id`, `ret`, `name`) VALUES
(1, '0.00', '% RETENCION'), 
(2, '0.00', '0.00 %'), 
(3, '15.00', '15.00 %')";
		
	global $table22;
	if(mysqli_query($db, $retencion2)){
			$table22 = "\t* OK INIT VALUES EN ".$vname10.". \n";
	}else{ print("* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
			$table22 = "\t* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)." \n";
			}

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		global $data0;
		$datein = date('Y-m-d H:i:s');
		global $text;
		$logdate = date('Y-m-d');
		$text = $text.PHP_EOL."** CONFIG INIT ".$datein;
		$text = $text.PHP_EOL."** index.php function crear_tablas()";
		$text = $text.PHP_EOL." * ".$db_name;
		$text = $text.PHP_EOL." * ".$db_host;
		$text = $text.PHP_EOL." * ".$db_user;
		$text = $text.PHP_EOL." * ".$db_pass;
		$text = $text.PHP_EOL.$dbconecterror;
		$text = $text.PHP_EOL.$data0.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.$table15.$table16.$table17.$table18.$table19.$table20.$table21.$table22."\n";

		ini_log_cbj();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/************		SE CREAN TABLAS Y DIRECTORIOS ADICIONALES DESDE CONFIG2		*****************/

	global $data1;
	$carpeta = "../Mod_Conta/cbj_Docs";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data1 = "\t* OK DIRECTORIO ../Mod_Conta/cbj_Docs. \n";
	}else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
			$data1 = "\t* YA EXISTE EL DIRECTORIO ../Mod_Conta/cbj_Docs. \n";
			}

	/************** CREAMOS LA TABLA GASTOS  ***************/

	global $tablProveedores;
	$tablProveedores = "`".$_SESSION['clave']."proveedores`";

	global $vname1;
	$vname1 = "`".$_SESSION['clave']."gastos_".date('Y')."`";
	
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
  `factret` int(2) unsigned NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)/*,
  INDEX `refprovee` (`refprovee`),
  FOREIGN KEY (`refprovee`) REFERENCES $tablProveedores (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
  */
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";

	global $data1;
	if(mysqli_query($db, $tg)){
			$data1 = $data1."\t* OK TABLA ".$vname1."\n";
	} else { print( "* NO OK TABLA ".$vname1.". ".mysqli_error($db)."\n");
			 $data1 = $data1."\t* NO OK TABLA ".$vname1.". ".mysqli_error($db)."\n";
			}

// CREA EL DIRECTORIO DE DOC GASTOS.

	$vn1 = "docgastos_".date('Y');
	$carpeta1 = "../Mod_Conta/cbj_Docs/".$vn1;
	global $data2;
	if (!file_exists($carpeta1)) {
		mkdir($carpeta1, 0777, true);
		copy("../Mod_Conta/cbj_Images/untitled.png", $carpeta1."/untitled.png");
		copy("../Mod_Conta/cbj_Images/pdf.png", $carpeta1."/pdf.png");
		$data2 = "\t* OK DIRECTORIO ".$carpeta1."\n";
	}else{ //print("* NO OK EL DIRECTORIO ".$carpeta1."\n");
			$data2 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta1."\n";
			}

	/************** CREAMOS LA TABLA GASTOS del año anterior  ***************/

	global $vname2;
	$vname2 = "`".$_SESSION['clave']."gastos_".(date('Y')-1)."`";
	
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
  `factret` int(2) unsigned NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)/*,
  INDEX `refprovee` (`refprovee`),
  FOREIGN KEY (`refprovee`) REFERENCES $tablProveedores (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
	*/
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $data3;
	if(mysqli_query($db, $tg2)){
			$data3 = "\t* OK TABLA ".$vname2." \n";
	}else{ print( "* NO OK TABLA ".$vname2.". ".mysqli_error($db)."\n");
				 $data3 = "\t* NO OK TABLA ".$vname2.". ".mysqli_error($db)."\n";
			}
				
// CREA EL DIRECTORIO DE GASTOS DE AÑO ANTERIOR.

	$vn2 = "docgastos_".(date('Y')-1);
	$carpeta2 = "../Mod_Conta/cbj_Docs/".$vn2;
	global $data4;
	if (!file_exists($carpeta2)) {
			mkdir($carpeta2, 0777, true);
			copy("../Mod_Conta/cbj_Images/untitled.png", $carpeta2."/untitled.png");
			copy("../Mod_Conta/cbj_Images/pdf.png", $carpeta2."/pdf.png");
			$data4 = "\t* OK DIRECTORIO ".$carpeta2."\n";
	}else{//print("* YA EXISTE EL DIRECTORIO DIRECTORIO ".$carpeta2."\n");
			$data4 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta2."\n";
				}
	
	/************** CREAMOS LA TABLA INGRESOS  ***************/

	global $tblClientes;
	$tblClientes = "`".$_SESSION['clave']."clientes`";

	global $vname3;
	$vname3 = "`".$_SESSION['clave']."ingresos_".date('Y')."`";
	
	$ti = "CREATE TABLE `$db_name`.$vname3 (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refcliente` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) unsigned NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)/*,
  INDEX `refcliente` (`refcliente`),
  FOREIGN KEY (`refcliente`) REFERENCES $tblClientes (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
  */
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $data5;
	if(mysqli_query($db, $ti)){
			$data5 = "\t* OK TABLA ".$vname3."\n";
	}else{ print( "* NO OK TABLA ".$vname3.". ".mysqli_error($db)."\n");
			$data5 = "\t* NO OK TABLA ".$vname3.". ".mysqli_error($db)."\n";
				}
				
// CREA EL DIRECTORIO DE INGRESOS DEL AÑO.

	$vn3 = "docingresos_".date('Y');
	$carpeta3 = "../Mod_Conta/cbj_Docs/".$vn3;
	global $data6;
	if (!file_exists($carpeta3)) {
			mkdir($carpeta3, 0777, true);
			copy("../Mod_Conta/cbj_Images/untitled.png", $carpeta3."/untitled.png");
			copy("../Mod_Conta/cbj_Images/pdf.png", $carpeta3."/pdf.png");
			$data6 = "\t* OK DIRECTORIO ".$carpeta3."\n";
	}else{ //print("* NO OK EL DIRECTORIO ".$carpeta3."\n");
			$data6 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta3."\n";
				}
	
	/************** CREAMOS LA TABLA INGRESOS del año anterior  ***************/

	global $vname4;
	$vname4 = "`".$_SESSION['clave']."ingresos_".(date('Y')-1)."`";
	
	$ti2 = "CREATE TABLE `$db_name`.$vname4 (
  `id` int(4) NOT NULL auto_increment,
  `factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `refcliente` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
  `factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `factiva` int(2) NOT NULL,
  `factivae` decimal(9,2) unsigned NOT NULL,
  `factpvp` decimal(9,2) unsigned NOT NULL,
  `factret` int(2) unsigned NOT NULL,
  `factrete` decimal(9,2) unsigned NOT NULL,
  `factpvptot` decimal(9,2) unsigned NOT NULL,
  `coment` text collate utf8_spanish2_ci NOT NULL,
  `myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)/*,
  INDEX `refcliente` (`refcliente`),
  FOREIGN KEY (`refcliente`) REFERENCES $tblClientes (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
  */
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	global $data7;
	if(mysqli_query($db, $ti2)){
			$data7 = "\t* OK TABLA ".$vname4."\n";
	}else{  print( "* NO OK TABLA ".$vname4.". ".mysqli_error($db)."\n");
			$data7 = "\t* NO OK TABLA ".$vname4.". ".mysqli_error($db)."\n";
			}
				
// CREA EL DIRECTORIO DE INGRESOS DEL AÑO ANTERIOR.

	$vn4 = "docingresos_".(date('Y')-1);
	$carpeta4 = "../Mod_Conta/cbj_Docs/".$vn4;
	global $data8;
	if (!file_exists($carpeta4)) {
			mkdir($carpeta4, 0777, true);
			copy("../Mod_Conta/cbj_Images/untitled.png", $carpeta4."/untitled.png");
			copy("../Mod_Conta/cbj_Images/pdf.png", $carpeta4."/pdf.png");
			$data8 = "\t* OK DIRECTORIO ".$carpeta4."\n";
	} else { //print("* NO OK EL DIRECTORIO ".$carpeta4."\n");
			 $data8 = "\t* YA EXISTE EL DIRECTORIO ".$carpeta4."\n";
				}
	
		/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		$datein = date('Y-m-d H:i:s');
		global $text;
		$logdate = date('Y-m-d');
		$text = $text.PHP_EOL."** CONFIG INIT ".$datein;
		$text = $text.PHP_EOL."** config/config2.php function crear_tablas()";
		$text = $text.PHP_EOL." * ".$db_name;
		$text = $text.PHP_EOL." * ".$db_host;
		$text = $text.PHP_EOL." * ".$db_user;
		$text = $text.PHP_EOL." * ".$db_pass;
		$text = $text.PHP_EOL.$dbconecterror;
		$text = $text.PHP_EOL.$data1.$data2.$data3.$data4.$data5.$data6.$data7.$data8."\n";

		ini_log_cbj();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		/************	FUNCIONES ADICIONALES PARA MOD_CONTA	*****************/

		/************	CONFIGURACIÓN ANUAL PARA MOD_CONTA	*****************/

function modif2a(){
	$filename = "../Mod_Conta/cbj_Docs/ayear.php";
	
	$contenido = "<?php\n \$dy = array ('' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',\n);\n?>";
	
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

function modif2b(){
	$filename = "../Mod_Conta/cbj_Docs/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat2;
	$dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.".\n";
}

function modif3a(){
	$filename = "../Mod_Conta/config/ayear.php";
	
	$contenido = "<?php\n \$dy = array ('' => 'YEAR',\n'".date('y')."' => '".date('Y')."',\n'".(date('y')-1)."' => '".(date('Y')-1)."',\n);\n?>";
	
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

function modif3b(){
	$filename = "../Mod_Conta/config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function ayear_cbj(){
	$filename = "../Mod_Conta/config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){ }
	elseif($fget != date('Y')){
			modif2a();
			modif2b();
			modif3a(); 
			modif3b();
		}

} // FIN function ayear_cbj()

	ayear_cbj();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		/************	COMPROBACIÓN Y CREACIÓN DE DIRECTORIOS PARA MOD_CONTA	*****************/
				 
	function crear_dir(){

	// ESTA FUNCIÓN LA TENGO INTEGRADA EN MOD_ADMIN DENTRO DE function crear_tablas()
		global $data0; 		$carpeta = "../Mod_Conta/cbj_Docs/temp";
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$data0 = $data0."\t* OK DIRECTORIO ../Mod_Conta/cbj_Docs/temp. \n";
			}
			else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
					$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ../Mod_Conta/cbj_Docs/temp. \n";
				}
	
		$carpeta = "../Mod_Conta/cbj_Docs/log";
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$data0 = $data0."\t* OK DIRECTORIO ../Mod_Conta/cbj_Docs/log. \n";
			}
			else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
					$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ../Mod_Conta/cbj_Docs/log. \n";
				}
	
		$carpeta = "../Mod_Conta/cbj_Docs/grafics";
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
			$data0 = $data0."\t* OK DIRECTORIO ../Mod_Conta/cbj_Docs/grafics. \n";
			}
			else{	//print("* NO HA CREADO EL DIRECTORIO ".$carpeta."\n");
					$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ../Mod_Conta/cbj_Docs/grafics. \n";
				}

/*	DEPECRATED...
	// CREA EL DIRECTORIO DE IMAGEN DE USUARIO.
	
		$vn1 = "img_admin";
		$carpetaimg = "../Mod_Conta/cbj_Docs/".$vn1;
		if (!file_exists($carpetaimg)) {
			mkdir($carpetaimg, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpetaimg."/untitled.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg."\n";
			}
			else{//print("* NO OK EL DIRECTORIO ".$carpetaimg."\n");
				$data0  = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpetaimg."\n";
			}
*/	
	
	// CREA EL DIRECTORIO DE IMAGEN DE PROVEEDOR GASTOS.
	
		$vn1 = "img_proveedores";
		$carpetaimg1 = "../Mod_Conta/cbj_Docs/".$vn1;
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
		$carpetaimg2 = "../Mod_Conta/cbj_Docs/".$vn1;
		if (!file_exists($carpetaimg2)) {
			mkdir($carpetaimg2, 0777, true);
			copy("config/cbj_Images/untitled.png", $carpetaimg2."/untitled.png");
			$data0 = $data0."\t* OK DIRECTORIO ".$carpetaimg2."\n";
			}
			else{//print("* NO OK EL DIRECTORIO ".$carpetaimg2."\n");
				$data0 = $data0."\t* YA EXISTE EL DIRECTORIO ".$carpetaimg2."\n";
			}
		
	// CREA EL DIRECTORIO GRAFICS.
	
		$vn1 = "grafics";
		$carpetaimg2 = "../Mod_Conta/cbj_Docs/".$vn1;
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
		$carpeta1b = "../Mod_Conta/cbj_Docs/".$vn1b;
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
		$carpeta3b = "../Mod_Conta/cbj_Docs/".$vn3b;
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

	ini_log_cbj();
		
	} // FIN function crear_dir()

	crear_dir();

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>