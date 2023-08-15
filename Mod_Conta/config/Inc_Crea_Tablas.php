<?php

	global $db;			global $db_name;
	global $db_host; 	global $db_user;
	global $db_pass; 	global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/

	global $tableAdmin;
	$tableAdmin = "`".$_SESSION['clave']."admin`";	

	$admin = "CREATE TABLE `$db_name`.$tableAdmin (
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
  `Tlf2`varchar(9) NULL default 000000000,
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
	} else { global $table1;
			 $table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db)." \n";
				}
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	global $tableVisitasAdmin;
	$tableVisitasAdmin = "`".$_SESSION['clave']."visitasadmin`";	

	$visitas = "CREATE TABLE `$db_name`.$tableVisitasAdmin (
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
	} else { global $table2;
			 $table2 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db)." \n";
				}
					
	$vd = "INSERT INTO `$db_name`.$tableVisitasAdmin (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
(69, 0, 0, 0, 0)";
		
	if(mysqli_query($db, $vd)){
			global $table3;
			$table3 = "\t* OK INIT VALUES EN VISITAS ADMIN. \n";
	} else { global $table3;
			 $table3 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db)." \n";
				}

	/************** CREAMOS LA TABLA GASTOS PENDIENTES  ***************/

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

	global $vname3b;
	$vname3b = "`".$_SESSION['clave']."ingresos_pendientes`";
	
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

	global $vname5;
	$vname5 = "`".$_SESSION['clave']."proveedores`";
	
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
  `Tlf2`varchar(9) NULL default 000000000,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provee)){
			global $table6;
			$table6 = "\t* OK TABLA ".$vname5."\n";
		} else { print("* NO OK TABLA ".$vname5.". ".mysqli_error($db)."</br>");
				 global $table6;
				 $table6 = "\t* NO OK TABLA ".$vname5.". ".mysqli_error($db)."\n";
			}

	$vp = "INSERT INTO `$db_name`.$vname5 (`id`, `ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES
(1, 'ANONIMO', 'ANONIMO', 'untitled.png', 'ANONIMO', 'ANONIMO', 'X', 'ANONIMO', 'ANONIMO', '000000000', '000000000')";
		
	if(mysqli_query($db, $vp)){
			global $table7;
			$table7 = "\t* OK INIT VALUES EN ".$vname5."\n";
		} else { print("* NO OK INIT VALUES EN ".$vname5.". ".mysqli_error($db)."</br>");
				 global $table7;
				 $table7 = "\t* NO OK INIT VALUES EN ".$vname5.". ".mysqli_error($db)."\n";
			}

	/************** CREAMOS LA TABLA clientes ***************/

	global $vname6;
	$vname6 = "`".$_SESSION['clave']."clientes`";
	
	$provei = "CREATE TABLE `$db_name`.$vname6 (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `rsocial` varchar(30) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NULL default,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $provei)){
			global $table8;
			$table8 = "\t* OK TABLA ".$vname6."\n";
		} else { print("* NO OK TABLA ".$vname6.". ".mysqli_error($db)."</br>");
				 global $table8;
				 $table8 = "\t* NO OK TABLA ".$vname6.". ".mysqli_error($db)." \n";
			}
					
	$vpi = "INSERT INTO `$db_name`.$vname6 (`id`, `ref`, `rsocial`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Direccion`, `Tlf1`, `Tlf2`) VALUES
(1, 'ANONIMO', 'ANONIMO', 'untitled.png', 'ANONIMO', 'ANONIMO', 'X', 'anonimo@anonimo.es', 'Not Adress', '000000000', '000000000')";
		
	if(mysqli_query($db, $vpi)){
			global $table9;
			$table9 = "\t* OK INIT VALUES EN ".$vname6."\n";
		} else { print("* NO OK INIT VALUES EN ".$vname6.". ".mysqli_error($db)."</br>");
				 global $table9;
				 $table9 = "\t* NO OK INIT VALUES EN ".$vname6.". ".mysqli_error($db)."\n";
			}

	/************* CREAMOS LAS TABLAS BALANCES ****************/

	/************** CREAMOS LA TABLA BALANCE GAST ***************/

	global $vname7;
	$vname7 = "`".$_SESSION['clave']."balanceg`";

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
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
		
	if(mysqli_query($db, $balanceg2)){
			global $table11;
			$table11 = "\t* OK INIT VALUES EN ".$vname7.". \n";
		} else { print("* NO OK INIT VALUES EN ".$vname7.". ".mysqli_error($db)."</br>");
				 global $table11;
				 $table11 = "\t* NO OK INIT VALUES EN ".$vname7.". ".mysqli_error($db)." \n";
			}
					
	/************** CREAMOS LA TABLA BALANCE ING ***************/

	global $vname8;
	$vname8 = "`".$_SESSION['clave']."balancei`";

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
		} else { print("* NO OK TABLE ".$vname8.". ".mysqli_error($db)."</br>");
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
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
		
	if(mysqli_query($db, $balancei2)){
			global $table13;
			$table13 = "\t* OK INIT VALUES EN ".$vname8.".  \n";
		} else { print("* NO OK INIT VALUES EN ".$vname8.". ".mysqli_error($db)."</br>");
				 global $table13;
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
				  `ret` decimal(10,2) unsigned NOT NULL,
				  `tot` decimal(10,2) NOT NULL,
				  PRIMARY KEY  (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ";
		
	$dy = date('Y');
	$dy_1 = (date('Y')-1);
	
	if(mysqli_query($db, $balanced)){
			global $table14;
			$table14 = "\t* OK TABLA BALANCE ".$vname9.". \n";
		} else { print("* NO OK TABLE ".$vname9.". ".mysqli_error($db)."</br>");
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
(34, $dy, 'ANU', '0.00', '0.00', '0.00', '0.00')";
		
	if(mysqli_query($db, $balanced2)){
			global $table15;
			$table15 = "\t* OK INIT VALUES BALANCE ".$vname9.". \n";
		} else { print("* NO OK INIT VALUES EN ".$vname9.". ".mysqli_error($db)."</br>");
				 global $table15;
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
		
	if(mysqli_query($db, $impuestos)){
			global $table16;
			$table16 = "\t* OK TABLA ".$vname10.". \n";
		} else { print("* NO OK TABLE ".$vname10.". ".mysqli_error($db)."</br>");
				 global $table16;
				 $table16 = "\t* NO OK TABLA ".$vname10.". ".mysqli_error($db)." \n";
			}
					
$vname10 = strtolower($vname10);					
$impuestos2 = "INSERT INTO `$db_name`.$vname10 (`id`, `iva`, `name`) VALUES
(1, '0.00', '% IMPUESTOS'), 
(2, '0.00', '0.00 %'), 
(3, '4.00', '4.00 %'), 
(4, '10.00', '10.00 %'),  
(5, '21.00', '21.00 %')";
		
	if(mysqli_query($db, $impuestos2)){
			global $table17;
			$table17 = "\t* OK INIT VALUES EN ".$vname10.". \n";
		} else { print("* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
				 global $table17;
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
		
	if(mysqli_query($db, $status)){
			global $table18;
			$table18 = "\t* OK TABLA ".$vname11.". \n";
		} else { print("* NO OK TABLE ".$vname11.". ".mysqli_error($db)."</br>");
				 global $table18;
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

	if(mysqli_query($db, $status2)){
			global $table19;
			$table19 = "\t* OK INIT VALUES EN ".$vname11.". \n";
		} else { print("* NO OK INIT VALUES EN ".$vname11.". ".mysqli_error($db)."</br>");
				 global $table19;
				 $table19 = "\t* NO OK INIT VALUES EN ".$vname11.". ".mysqli_error($db)." \n";
			}

	/************** CREAMOS LA TABLA STATUSFEEDBACK ***************/

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
		
	if(mysqli_query($db, $statusfeedback)){
			global $table20;
			$table20 = "\t* OK TABLA ".$vname12.". \n";
		} else { print("* NO OK TABLE ".$vname12.". ".mysqli_error($db)."</br>");
				 global $table20;
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
		
	if(mysqli_query($db, $retencion)){
			global $table21;
			$table21 = "\t* OK TABLA ".$vname13.". \n";
		} else { print("* NO OK TABLE ".$vname13.". ".mysqli_error($db)."</br>");
				 global $table21;
				 $table21 = "\t* NO OK TABLA ".$vname13.". ".mysqli_error($db)." \n";
			}
					
$vname13 = strtolower($vname13);					
$retencion2 = "INSERT INTO `$db_name`.$vname13 (`id`, `ret`, `name`) VALUES
(1, '0.00', '% RETENCION'), 
(2, '0.00', '0.00 %'), 
(3, '15.00', '15.00 %')";
		
	if(mysqli_query($db, $retencion2)){
			global $table22;
			$table22 = "\t* OK INIT VALUES EN ".$vname10.". \n";
		} else { print("* NO OK INIT VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
				 global $table22;
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
		$text = $text.PHP_EOL.$data0.$table1.$table2.$table3.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.$table15.$table16.$table17.$table18.$table19.$table20.$table21.$table22."\n";

		ini_log();
		
?>