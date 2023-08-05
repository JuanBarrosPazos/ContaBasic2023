<?php
session_start();
	
	global $index;		$index = 1;
	require '../Mod_Admin/Inclu/error_hidden.php';
	require 'Inclu/Conta_Head.php';
	require '../Mod_Admin/Conections/conection.php';
	require '../Mod_Admin/Conections/conect.php';
	require '../Mod_Admin/Inclu/my_bbdd_clave.php';
 
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){
							status_close();
							process_form();
							ayear();
	} else { require 'Inclu/table_permisos.php'; }	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/*		*/
	function modif(){
																	
		$filename = "cbj_Docs/ayear.php";
		$fw1 = fopen($filename, 'r+');
		$contenido = fread($fw1,filesize($filename));
		fclose($fw1);
		
		$contenido = explode("\n",$contenido);
		$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
		$contenido = implode("\n",$contenido);
		
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

	function tingresos(){

		global $db;
		
		global $tblClientes; 	
		$tblClientes = "`".$_SESSION['clave']."clientes`";

		global $db_name; 		
		$vname = "`".$_SESSION['clave']."ingresos_".date('Y')."`";
		
		$tv = "CREATE TABLE `$db_name`.$vname (
	`id` int(4) NOT NULL auto_increment,
	`factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`refcliente` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
	`factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`factiva` int(2) NOT NULL,
	`factivae` decimal(9,2) unsigned NOT NULL,
	`factpvp` decimal(9,2) unsigned NOT NULL,
	`factpvptot` decimal(9,2) unsigned NOT NULL,
	`coment` text collate utf8_spanish2_ci NOT NULL,
	`myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	`myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	`myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	`myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `id` (`id`),
	INDEX `refcliente` (`refcliente`),
	FOREIGN KEY (`refcliente`) REFERENCES $tblClientes (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
			
		if(mysqli_query($db, $tv)){
				global $dat4;
				$dat4 = "\tCREADA TABLA ".$vname.".\n";

					} else {print( "* NO OK TABLA VENTAS. ".mysqli_error($db).".\n");
							global $dat4;
							$dat4 = "\tNO CREADA TABLA ".$vname.". ".mysqli_error($db).".\n";
					}
					
	// CREA EL DIRECTORIO DE INGRESOS DE ESTE AÑO

		$vn3 = "docingresos_".date('Y');
		$carpeta3 = "cbj_Docs/".$vn3;
		if (!file_exists($carpeta3)) {
				mkdir($carpeta3, 0777, true);
				copy("cbj_Images/untitled.png", $carpeta3."/untitled.png");
				copy("cbj_Images/pdf.png", $carpeta3."/pdf.png");
				global $dat4b;
				$dat4b = "\tCREADO EL DIRECTORIO ".$carpeta3.".\n";
			} else{ 
				print("* NO HA CREADO EL DIRECTORIO ".$carpeta3."\n");
				global $dat4b;
				$dat4b = "\tNO CREADO EL DIRECTORIO ".$carpeta3.".\n";
			}
		
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function tgastos(){
		
		global $db; 		global $db_name;
		
		global $tablProveedores;
		$tablProveedores = "`".$_SESSION['clave']."proveedores`";

		global $vname;		
		$vname = "`".$_SESSION['clave']."gastos_".date('Y')."`";
		
		$tg = "CREATE TABLE `$db_name`.$vname (
	`id` int(4) NOT NULL auto_increment,
	`factnum` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`factdate` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`refprovee` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`factnom` varchar(22) collate utf8_spanish2_ci NOT NULL,
	`factnif` varchar(20) collate utf8_spanish2_ci NOT NULL,
	`factiva` int(2) NOT NULL,
	`factivae` decimal(9,2) unsigned NOT NULL,
	`factpvp` decimal(9,2) unsigned NOT NULL,
	`factpvptot` decimal(9,2) unsigned NOT NULL,
	`coment` text collate utf8_spanish2_ci NOT NULL,
	`myimg1` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	`myimg2` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	`myimg3` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	`myimg4` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
	PRIMARY KEY  (`id`),
	UNIQUE KEY `id` (`id`),
	INDEX `refprovee` (`refprovee`),
	FOREIGN KEY (`refprovee`) REFERENCES $tablProveedores (`ref`) ON DELETE NO ACTION ON UPDATE CASCADE
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ";
			
		if(mysqli_query($db, $tg)){
				global $dat5; 		$dat5 = "\tCREADA TABLA ".$vname.".\n";

			// CREA EL DIRECTORIO DE DOC GASTOS.
				$vn1 = "docgastos_".date('Y');
				$carpeta1 = "cbj_Docs/".$vn1;
				if (!file_exists($carpeta1)) {
					mkdir($carpeta1, 0777, true);
					copy("cbj_Images/untitled.png", $carpeta1."/untitled.png");
					copy("cbj_Images/pdf.png", $carpeta1."/pdf.png");
					global $dat5b;
					$dat5b = "\tCREADO EL DIRECTORIO ".$carpeta1.".\n";
				} else{print("* NO HA CREADO EL DIRECTORIO ".$carpeta1."\n");
					global $dat5b;
					$dat5b = "\tNO CREADO EL DIRECTORIO ".$carpeta1.".\n";
					}

			} else {print( "* NO OK TABLA GASTOS. ".mysqli_error($db)."\n");
							global $dat5;
							$dat5 = "\tNO CREADA TABLA ".$vname.". ".mysqli_error($db).".\n";
					}
	} // FIN FUNCTION tgastos()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function inserbalg(){
		
		global $db;		global $db_name;

		$dy = date('Y');

		$vname7 = "`".$_SESSION['clave']."abalanceg`";
		$vname7 = strtolower($vname7);	
						
	$balanceg2 = "INSERT INTO `$db_name`.$vname7 (`year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
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
		if(mysqli_query($db, $balanceg2)){
				global $dat6;
				$dat6 = "\tACTUALIZADA TABLA ".$vname7.".\n";
					} else {
						print("* NO OK VALUES EN ".$vname7.". ".mysqli_error($db)."</br>");
				global $dat6;
				$dat6 = "\tNO CREADA TABLA ".$vname7.". ".mysqli_error($db).".\n";
						}

	} // FIN FUNCTION inserbalg()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function inserbali(){
		
		global $db; 	global $db_name;

		$dy = date('Y');

		$vname8 = "`".$_SESSION['clave']."balancei`";
		$vname8 = strtolower($vname8);	
						
	$balancei2 = "INSERT INTO `$db_name`.$vname8 (`year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
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
		if(mysqli_query($db, $balancei2)){
				global $dat7;
				$dat7 = "\tACTUALIZADA TABLA ".$vname8.".\n";
					} else {
						print("* NO OK VALUES EN ".$vname8.". ".mysqli_error($db)."</br>");
						global $dat7;
						$dat7 = "\tNO CREADA TABLA ".$vname8.". ".mysqli_error($db).".\n";
						}
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function inserbald(){
		
		global $db;	 	global $db_name;

		$dy = date('Y');

		$vname9 = "`".$_SESSION['clave']."balanced`";
		$vname9 = strtolower($vname9);	
						
	$balanced2 = "INSERT INTO `$db_name`.$vname9 (`year`, `mes`, `iva`, `sub`, `ret`, `tot`) VALUES
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
		if(mysqli_query($db, $balanced2)){
				global $dat8;
				$dat8 = "\tACTUALIZADA TABLA ".$vname9.".\n";
					} else {
						print("* NO OK VALUES EN ".$vname9.". ".mysqli_error($db)."</br>");
						global $dat8;
						$dat8 = "\tNO CREADA TABLA ".$vname9.". ".mysqli_error($db).".\n";
						}
		
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function newstatus(){
		global $db;	 		global $db_name;
		
		global $vname10; 	$vname10 = "`".$_SESSION['clave']."status`";
		global $year; 		$year = date('Y')/*+1*/;
		global $ycod;		$ycod = date('y');
		//$ycod = substr(trim($year),-2,2);
				
		global $stat; 		$stat = 'open';
		global $hidden; 	$hidden = 'no';
				
		$sqla9 = "INSERT INTO `$db_name`.$vname10 (`year`, `ycod`, `stat`, `hidden`) VALUES ('$year', '$ycod', '$stat', '$hidden')";
					
			if(mysqli_query($db, $sqla9)){ 			
				global $dat9;
				$dat9 = "\tACTUALIZADA TABLA ".$vname10.".\n";
			} else { print("* NO OK VALUES EN ".$vname10.". ".mysqli_error($db)."</br>");
					global $dat9;
					$dat9 = "\tNO CREADA TABLA ".$vname10.". ".mysqli_error($db).".\n";
				}
		
	} // FIN function newstatus()
					
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ayear(){

		$filename = "cbj_Docs/year.txt";
		$fw2 = fopen($filename, 'r+');
		$fget = fgets($fw2);
		fclose($fw2);
		
		$carpeta1 = "cbj_Docs/docgastos_".date('Y');
		$carpeta2 = "cbj_Docs/docingresos_".date('Y');

		if($fget == date('Y')){
			/*print("<div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO ES EL MISMO </div>".date('Y')." == ".$fget );*/
				
		} elseif(($fget != date('Y')) && (!file_exists($carpeta1)) && (!file_exists($carpeta2))){ 
			print(" <div style='clear:both'></div>
					<div style='width:200px'>* EL AÑO HA CAMBIADO </div>"/*.date('Y')." != ".$fget */);
			modif();
			modif2(); 		tingresos(); 		tgastos();
			inserbalg(); 	inserbali(); 		inserbald();
			newstatus();
			global $dat2;	global $dat3;	global $dat4;	global $dat4b;	global $dat5;
			global $dat5b;	global $dat6;	global $dat7;	global $dat8;	global $dat9;
			global $text;
			$text = $dat2.$dat3.$dat4.$dat4b.$dat5.$dat5b.$dat6.$dat7.$dat8.$dat9."\n";
		} elseif($fget != date('Y')){ modif();
									modif2();
									global $dat2;
									global $text; 	$text = $dat2."\n";
									}
		ini_log_cbj();

	} // FIN FUNCTION ayear()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function status_close(){
		
		global $db; 	global $db_name;
				
		global $ystatus; 	$ystatus = date('Y')-1; 	$ystatus = trim($ystatus);
		global $stdate; 	$stdate = date('Y'); 		$stdate = trim($stdate);
				
		global $t1; 		$t1 = "`".$_SESSION['clave']."status`";

		$sqls =  "SELECT * FROM $t1  WHERE $t1.`year` < '$stdate' AND $t1.`stat` = 'open' ORDER BY `year` DESC ";
		$qs = mysqli_query($db, $sqls);				
		$qsn = mysqli_num_rows($qs);
		$qsr = mysqli_fetch_assoc($qs);
		//print("* Valor año: ".$qsr['year'].". ");
				
		global $stmes; 		$stmes = trim(date('m'));
				
		if(!$qs){ print("* ".mysqli_error($db)."<br/>");
		} elseif($qsn > 0){ 
			//print("* ENTRADAS: ".$qsn.". "); 
		}

		/* PASA EL ESTADO DEL EJERCICIO AUTOMATICAMENTE A CLOSE */
		if((@$qsr['year'] == $ystatus) && ($qsn > 0) && ($ystatus < $stdate) && ($stmes > 1)){
			$sg1st = "UPDATE `$db_name`.$t1 SET `stat` = 'close' WHERE `year` = $ystatus AND `stat` = 'open' ";
			if(mysqli_query($db, $sg1st)){ 
				// print("* OK CLOSE EJERCICIO: ".$ystatus.".<br/>");
			} else {
				print("<font color='#FF0000'>* ".mysqli_error($db))."</br>";}
		}

		/* PASA EL ESTADO DEL EJERCICIO AUTOMATICAMENTE A OPEN */
		if((($qsn > 1)||($qsn == 1)) && (($qsr['year']-1) < $ystatus)){
			$sqls3 =  "SELECT $t1.`year` FROM $t1  WHERE `stat` = 'open' AND `year` < '$ystatus' ORDER BY `year` DESC";
			$qs3 = mysqli_query($db, $sqls3);				
			$qsn3 = mysqli_num_rows($qs3);
					
			$sg1st2 = "UPDATE `$db_name`.$t1 SET `stat` = 'close' WHERE `year` < $ystatus AND `stat` = 'open' ";
			if(mysqli_query($db, $sg1st2)){ 
				if($qsn3>0){print("* OK CLOSE ".$qsn3." YEAR: ");}
					while($rowi = mysqli_fetch_assoc($qs3)){
							print($rowi['year'].". ");
								}
							print("<br/>");
						} else {print("<font color='#FF0000'>* ".mysqli_error($db))."</br>";}
				}
						
	} // FIN function status_close()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
		
		global $db;
						
		if ($_SESSION['Nivel'] == 'admin'){	

		//print("Wellcome: ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".");
		
			master_index();
			show_balance();
				
			}	else { require 'Inclu/table_permisos.php'; }
					
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_balance($errors=[]){
	
	global $ordenar;
	if(isset($_POST['show_formcl'])){
		$defaults = $_POST;
	} elseif(isset($_POST['todo'])){
		$defaults = $_POST;
	} else { 
			$defaults = array ('id' => '',
								'year' => '',
								'mes' => '',
								'tot' => '',
								'Orden' => $ordenar);
							}

			$dm = array ( '' => 'MES TODOS',
						'M01' => 'ENERO', 'M02' => 'FEBRERO', 'M03' => 'MARZO',
						'M04' => 'ABRIL', 'M05' => 'MAYO', 'M06' => 'JUNIO',
						'M07' => 'JULIO', 'M08' => 'AGOSTO', 'M09' => 'SEPTIEMBRE',
						'M10' => 'OCTUBRE', 'M11' => 'NOVIEMBRE', 'M12' => 'DICIEMBRE',
						'TRI0' => 'TRIMESTRAL', 'TRI1' => 'TRIMESTRE 1', 'TRI2' => 'TRIMESTRE 2',
						'TRI3' => 'TRIMESTRE 3', 'TRI4' => 'TRIMESTRE 4', 'ANU' => 'ANUAL');

			$ordenar = array ('`id` ASC' => 'id Asc',
							'`id` DESC' => 'id Desc',
							'`year` ASC' => 'YEAR Asc',
							'`year` DESC' => 'YEAR Desc',
							'`mes` ASC' => 'MES Asc',
							'`mes` DESC' => 'MES Desc',
							'`tot` ASC' => 'TOTAL Asc',
							'`tot` DESC' => 'TOTAL Desc');
	
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
				</table>>");
		}
		
print("<table align='center' width='auto' style=\"border: none;\"><tr><td>");
	
	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=2>BALANCE CONTABLE TRIMESTRAL</th>
				</tr>
		<form name='todo' method='post' action='cbj_Balances/Balances.php' >
				<tr>
					<td align='center' class='BorderSup'>
						<input type='submit' value='FILTRO BALANCES' />
						<input type='hidden' name='todo' value=1 />
					</td>
					<td class='BorderSup'>	
					<div style='float:left'>
						<select name='Orden'>");
						
	foreach($ordenar as $option => $label){
			print ("<option value='".$option."' ");
				if($option == $defaults['Orden']){print ("selected = 'selected'");}
												  print ("> $label </option>");
											}	
	print ("</select>
				</div><div style='float:left'>");
								
		require 'Inclu/year_select_bbdd.php';
									
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dm'>");

	foreach($dm as $optiondm => $labeldm){
				print ("<option value='".$optiondm."' ");
					if($optiondm == @$defaults['dm']){
									print ("selected = 'selected'");}
									print ("> $labeldm </option>");
					}	
																
	print ("</select>
				</div>
				</form>											
			</td>
		</tr>
	</table>"); /* Fin del print */
	
			////////////////////		**********  		////////////////////

	global $db; 	global $db_name;
	global $dyt1;	$dyt1 = date('Y');
	global $dm1; 	$dm1 = 'TRI';
	global $sent; 	$sent = "LIKE '%".$dm1."%'";
	
	global $vname; 	$vname = "`".$_SESSION['clave']."balancei`";

	$sqli =  "SELECT * FROM $vname WHERE `year` = '$dyt1' AND `mes` $sent ORDER BY `id` ASC ";
	$qbi = mysqli_query($db, $sqli);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

	if(!$qbi){print(mysqli_error($db).".</br>");
	} else {
		$qpvptot = mysqli_query($db, $sqli);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptoti = 0;
			for($i=0; $i<$rowpvptot; $i++) {
								$veri = mysqli_fetch_array($qpvptot);
								$sumapvptoti = $sumapvptoti + $veri['tot'];
							}
	}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

	if(!$qbi){print(mysqli_error($db).".</br>");
	} else {
		$qrete = mysqli_query($db, $sqli);
		$rowrete = mysqli_num_rows($qrete);
		$sumaretei = 0;
			for($i=0; $i<$rowrete; $i++){
							$verrt = mysqli_fetch_array($qrete);
							$sumaretei = $sumaretei + $verrt['ret'];
						}
		}
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

	if(!$qbi){print(mysqli_error($db).".</br>");
	} else {
		$qivae = mysqli_query($db, $sqli);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivaei = 0;
			for($i=0; $i<$rowivae; $i++) {
						$veri = mysqli_fetch_array($qivae);
						$sumaivaei = $sumaivaei + $veri['iva'];
					}
		}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qbi){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else {
		if(mysqli_num_rows($qbi) == 0){
				print ("<table align='center'>
							<tr>
								<td>
									<font color='#FF0000'>NO HAY DATOS</font>
								</td>
							</tr>
						</table>");

		} else { print ("<div style='clear:both'></div>
			<div style='float:left; margin-left:0%; margin-right:auto'>
			<table align='center'>
			<tr>
				<th colspan=6 class='BorderInf'>
					BALANCE INGRESOS ".mysqli_num_rows($qbi)."R.
				</th>
			</tr>
			<tr>
				<th class='BorderInfDch'>AÑO</th>		
				<th class='BorderInfDch'>MES</th>		
				<th class='BorderInfDch'>IVA REPER</th>
				<th class='BorderInfDch'>SUB TOT</th>
				<th class='BorderInfDch'>RET REPER</th>
				<th class='BorderInf'>TOTAL €</th>			
			</tr>");

		while($rowi = mysqli_fetch_assoc($qbi)){

		global $vname; 	global $dyt1;
		//if($rowi['tot']!= 0.00){
		print (	"<tr align='center'>
								
		<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

		<input name='dyt1' type='hidden' value='".$dyt1."' />
		<input name='vname' type='hidden' value='".$vname."' />
		<input name='id' type='hidden' value='".$rowi['id']."' />

					<td class='BorderInfDch' align='right'>
		<input name='year' type='hidden' value='".$rowi['year']."' />".$rowi['year']."
					</td>

					<td class='BorderInfDch' align='right'>
		<input name='mes' type='hidden' value='".$rowi['mes']."' />".$rowi['mes']."
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='iva' type='hidden' value='".$rowi['iva']."' />".$rowi['iva']." €
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='sub' type='hidden' value='".$rowi['sub']."' />".$rowi['sub']." €
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='tot' type='hidden' value='".$rowi['ret']."' />".$rowi['ret']." €
					</td>
																		
					<td class='BorderInf' align='right'>
		<input name='tot' type='hidden' value='".$rowi['tot']."' />".$rowi['tot']." €
					</td>
		</form>
				</tr>");
				
						//}
			} /* Fin del while.*/ 

		print("<tr>
					<td colspan='6' class='BorderInf'>
					</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch' align='center'>IMP REPER</td>
					<td colspan='2' class='BorderInfDch' align='center'>RETEN REPER</td>
					<td colspan='2' class='BorderInf' align='center'>TOT INGRESOS</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch' align='right'>".$sumaivaei." €</td>
					<td colspan='2' class='BorderInfDch' align='right'>".$sumaretei." €</td>
					<td colspan='2' class='BorderInf' align='right'>".$sumapvptoti." €</td>
				</tr>
			</table>
				</div>");
		} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */

			////////////////////		***********  		////////////////////

	global $vname; 		$vname = "`".$_SESSION['clave']."balanceg`";

	$sqlb =  "SELECT * FROM $vname WHERE `year` = '$dyt1' AND `mes` $sent ORDER BY `id` ASC ";
	$qb = mysqli_query($db, $sqlb);

/////////////////////	
/* PARA SUMAR PVPTOT */

	if(!$qb){print(mysqli_error($db).".</br>");
	} else {
		$qpvptot = mysqli_query($db, $sqlb);
		$rowpvptot = mysqli_num_rows($qpvptot);
		$sumapvptotg = 0;
			for($i=0; $i<$rowpvptot; $i++) {
							$verg = mysqli_fetch_array($qpvptot);
							$sumapvptotg = $sumapvptotg + $verg['tot'];
						}
		}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

	if(!$qb){print(mysqli_error($db).".</br>");
	} else {
		$qreteg = mysqli_query($db, $sqlb);
		$rowreteg = mysqli_num_rows($qreteg);
		$sumareteg = 0;
			for($i=0; $i<$rowreteg; $i++) {
								$verrtg = mysqli_fetch_array($qreteg);
								$sumareteg = $sumareteg + $verrtg['ret'];
							}
		}
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

	if(!$qb){print(mysqli_error($db).".</br>");
	} else {
		$qivae = mysqli_query($db, $sqlb);
		$rowivae = mysqli_num_rows($qivae);
		$sumaivaeg = 0;
			for($i=0; $i<$rowivae; $i++) {
								$verg = mysqli_fetch_array($qivae);
								$sumaivaeg = $sumaivaeg + $verg['iva'];
							}
		}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else {
		if(mysqli_num_rows($qb) == 0){
				print ("<table align='center'>
							<tr>
								<td><font color='#FF0000'>NO HAY DATOS</font></td>
							</tr>
						</table>");

		} else { print ("<div style='float:left; margin-left:6px; margin-right:auto'>
							<table align='center'>
								<tr>
									<th colspan='6' class='BorderInf'>
							BALANCE GASTOS ".mysqli_num_rows($qb)."R.
									</th>
								</tr>
								<tr>
									<th class='BorderInfDch'>AÑO</th>
									<th class='BorderInfDch'>MES</th>
									<th class='BorderInfDch'>IVA REPER</th>
									<th class='BorderInfDch'>SUBTOT</th>
									<th class='BorderInfDch'>RET REPER</th>
									<th class='BorderInf'>TOTAL €</th>	
								</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

	global $vname; 		global $dyt1;
	//if($rowb['tot']!= 0.00){
			print (	"<tr align='center'>
									
<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">
	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$vname."' />
	<input name='id' type='hidden' value='".$rowb['id']."' />

						<td class='BorderInfDch' align='right'>
	<input name='year' type='hidden' value='".$rowb['year']."' />".$rowb['year']."
						</td>
	
						<td class='BorderInfDch' align='right'>
	<input name='mes' type='hidden' value='".$rowb['mes']."' />".$rowb['mes']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='iva' type='hidden' value='".$rowb['iva']."' />".$rowb['iva']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowb['sub']."' />".$rowb['sub']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowb['ret']."' />".$rowb['ret']." €
						</td>
						
						<td class='BorderInf' align='right'>
	<input name='tot' type='hidden' value='".$rowb['tot']."' />".$rowb['tot']." €
						</td>
		</form>
			</tr>");
					//}
		} /* Fin del while.*/ 

		print("<tr>
					<td colspan='6' class='BorderInf'>
					</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch' align='center'>IMP SOPOR</td>
					<td colspan='2' class='BorderInfDch' align='center'>RETEN SOPORT</td>
					<td colspan='2' class='BorderInf' align='center'>TOTAL GASTOS</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch' align='right'>".$sumaivaeg." €</td>
					<td colspan='2' class='BorderInfDch' align='right'>".$sumareteg." €</td>
					<td colspan='2' class='BorderInf' align='right'>".$sumapvptotg." €</td>
				</tr>
			</table>
		</div>");
			} /* Fin segundo else anidado en if */
		} /* Fin de primer else . */
		
			////////////////////		**********  		////////////////////
		
	global $vnamed; 		$vnamed = "`".$_SESSION['clave']."balanced`";

	$sqld =  "SELECT * FROM $vnamed WHERE `year` = '$dyt1' AND `mes` $sent ORDER BY `id` ASC ";
	$qbd = mysqli_query($db, $sqld);
	
/////////////////////	
/* PARA SUMAR PVPTOT */

	if(!$qbd){print(mysqli_error($db).".</br>");
	} else {
		$qpvptotd = mysqli_query($db, $sqld);
		$rowpvptotd = mysqli_num_rows($qpvptotd);
		$sumapvptotd = 0;
			for($i=0; $i<$rowpvptotd; $i++) {
								$verd = mysqli_fetch_array($qpvptotd);
								$sumapvptotd = $sumapvptotd + $verd['tot'];
							}
		}
			
/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

	if(!$qbd){print(mysqli_error($db).".</br>");
	} else {
		$qreted = mysqli_query($db, $sqld);
		$rowreted = mysqli_num_rows($qreted);
		$sumareted = 0;
			for($i=0; $i<$rowreted; $i++) {
								$verrtd = mysqli_fetch_array($qreted);
								$sumareted = $sumareted + $verrtd['ret'];
							}
		}
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

	if(!$qbd){print(mysqli_error($db).".</br>");
	} else {
		$qivaed = mysqli_query($db, $sqld);
		$rowivaed = mysqli_num_rows($qivaed);
		$sumaivaed = 0;
			for($i=0; $i<$rowivaed; $i++) {
								$verd = mysqli_fetch_array($qivaed);
								$sumaivaed = $sumaivaed + $verd['iva'];
							}
		}
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qbd){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else {
			if(mysqli_num_rows($qbd) == 0){
				print ("<table align='center'>
							<tr>
								<td><font color='#FF0000'>NO HAY DATOS</font></td>
							</tr>
						</table>");

			} else { print ("<div style='float:left; margin-left:6px; margin-right:auto'>
								<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
								BALANCE DIFERENCIAL ".mysqli_num_rows($qbd)."R.
										</th>
									</tr>
									<tr>
										<th class='BorderInfDch'>AÑO</th>	
										<th class='BorderInfDch'>MES</th>	
										<th class='BorderInfDch'>IVA DIFER</th>
										<th class='BorderInfDch'>SUBTOT</th>
										<th class='BorderInfDch'>RET DIFER</th>	
										<th class='BorderInf'>TOTAL €</th>	
									</tr>");
			
			while($rowd = mysqli_fetch_assoc($qbd)){

	global $vnamed; 		global $dyt1;
	//if($rowi['tot']!= 0.00){
			print (	"<tr align='center'>
									
<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">
	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='vname' type='hidden' value='".$vnamed."' />
	<input name='id' type='hidden' value='".$rowd['id']."' />
	
						<td class='BorderInfDch' align='right'>
	<input name='year' type='hidden' value='".$rowd['year']."' />".$rowd['year']."
						</td>
	
						<td class='BorderInfDch' align='right'>
	<input name='mes' type='hidden' value='".$rowd['mes']."' />".$rowd['mes']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='iva' type='hidden' value='".$rowd['iva']."' />".$rowd['iva']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowd['sub']."' />".$rowd['sub']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowd['ret']."' />".$rowd['ret']." €
						</td>

						<td class='BorderInf' align='right'>
	<input name='tot' type='hidden' value='".$rowd['tot']."' />".$rowd['tot']." €
						</td>
		</form>
			</tr>");
		//}
	} /* Fin del while.*/ 

		print("<tr>
					<td colspan='6' class='BorderInf'></td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch' align='center'>IMP DIFER</td>
					<td colspan='2' class='BorderInfDch' align='center'>RETEN DIFER</td>
					<td colspan='2' class='BorderInf' align='center'>TOT DIFER</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch' align='right'>".$sumaivaed." €</td>
					<td colspan='2' class='BorderInfDch' align='right'>".$sumareted." €</td>
					<td colspan='2' class='BorderInf' align='right'>".$sumapvptotd." €</td>
				</tr>
			</table>
			</div>");
		} /* Fin segundo else anidado en if */
	} /* Fin de primer else . */

			////////////////////		***********  		////////////////////

	print("</td></tr></table>");

	}	/* Fin show_balance(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){

		global $rutaIndex;		$rutaIndex = "";
		require 'Inclu_MInd/MasterIndexVar.php';
		
		require 'Inclu_MInd/MasterIndex.php'; 
		
				} 

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

	require 'Inclu/Conta_Footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>