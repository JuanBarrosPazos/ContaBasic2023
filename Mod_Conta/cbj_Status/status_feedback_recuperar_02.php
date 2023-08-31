<?php
session_start();

	require '../../Mod_Admin/Inclu/error_hidden.php';
	require '../Inclu/Conta_Head.php';
	require '../../Mod_Admin/Inclu/my_bbdd_clave.php';
	require '../../Mod_Admin/Conections/conection.php';
	require '../../Mod_Admin/Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if (isset($_POST['oculto2'])){	show_form();
										info_01();
		} elseif(isset($_POST['oculto'])){ 	process_form();
											info_02();
		} else { show_form(); }
	
	} else { require '../Inclu/table_permisos.php'; } 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function process_form(){
	
		global $DeleteGreyTit;		$DeleteGreyTit = "PAPELERA STATUS EJERCICIOS";
		global $InicioBlackTit;		$InicioBlackTit = "INICIO STATUS EJERCICIOS";
		require '../Inclu/BotoneraVar.php';
		global $closeButton;

		global $db; 		global $db_name;	
			
		global $vname; 		$vname = "`".$_SESSION['clave']."status`";

		global $date;		$date = $_POST['date'];
		global $id; 		$id = $_POST['id'];
		global $year; 		$year = $_POST['year'];
		$ycod = substr(trim($_POST['year']),-2,2);
		global $stat; 		$stat = $_POST['stat'];
		global $hidden; 	$hidden = $_POST['hidden'];
		
		$tabla = "<table class='tableForm' >
					<tr>
						<th colspan=5 >RECUPERADO Y BORRADO EN ".strtoupper($vname)."</th>
					</tr>
					<tr align='center'>
						<td>YEAR</td>
						<td>CODE</td>
						<td>STATUS</td>
						<td>HIDDEN</td>
						<td>DATE</td>
					</tr>
					<tr align='center'>
						<td>".$year."</td>
						<td>".$ycod."</td>
						<td>".$stat."</td>
						<td>".$hidden."</td>
						<td>".$date."</td>
					</tr>
					<tr>
						<td colspan='5' style='text-align:right;' >
							".$InicioBlack."
								<a href='status_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
							".$closeButton.$DeleteGrey."
								<a href='status_feedback_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
							".$closeButton."
						</td>
					</tr>
				</table>";	
		
		$sqla = "INSERT INTO `$db_name`.$vname (`year`, `ycod`, `stat`, `hidden`) VALUES ('$year', '$ycod', '$stat', '$hidden')";
	
		if(mysqli_query($db, $sqla)){ 
				global $vname; 		$vname2 = "`".$_SESSION['clave']."statusfeedback`";
				$sqld = "DELETE FROM `$db_name`.$vname2 WHERE `year` = '$year'";
				if(mysqli_query($db, $sqld)){ /*print("DELETE OK...");*/
				}else{print("* MODIFIQUE LA ENTRADA 125: ".mysqli_error($db));
					global $texerror; 	$texerror = "\n\t ".mysqli_error($db);}
				print($tabla);
				ver_todo();
		}else{
				print("* MODIFIQUE LA ENTRADA 117: ".mysqli_error($db));
				show_form ();
				global $texerror; 	$texerror = "\n\t ".mysqli_error($db);
			}

		global $redir;
		$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='status_feedback_Ver.php';
					}
					setTimeout('redir()',8000);
					</script>";
		print ($redir);
		
	} // FIN function process_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ver_todo(){
		
		global $db; 		global $db_name;
		
		global $vname; 		$vname = "`".$_SESSION['clave']."status`";

		$sqlb =  "SELECT * FROM $vname ORDER BY `year` DESC ";
		$qb = mysqli_query($db, $sqlb);

		if(!$qb){
				print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qb) == 0){

				global $titNoData;	$titNoData = "TABLA ".strtoupper($vname)."<br><br>";
				require 'status_NoData.php';

			}else{ print ("<table class='tableForm' >
							<tr>
								<th colspan=6 >EJERCICIOS STATUS ".mysqli_num_rows($qb)."</th>
							</tr>
							<tr align='center'>
								<th>ID</th><th>YEAR</th><th>ICOD</th>
								<th>STATE</th><th>HIDDEN</th>
							</tr>");
			
				global $styleBgc; global $i; $i = 1;

			while($rowb = mysqli_fetch_assoc($qb)){

				if(($i%2) == 0){ $styleBgc = "bgctdb"; }else{ $styleBgc = "bgctd"; }
				$i++;
	
			print (	"<tr class='".$styleBgc."'>
						<td align='center'>".$rowb['id']."</td>
						<td align='center'>".$rowb['year']."</td>
						<td align='center'>".$rowb['ycod']."</td>
						<td align='center'>".$rowb['stat']."</td>
						<td align='center'>".$rowb['hidden']."</td>
					</tr>");
				} /* Fin del while.*/ 

				print("</table> ");
			
			} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */

	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function show_form(){
	
		global $RestoreBlackTit;	$RestoreBlackTit = "RECUPERAR FEEDBACK EJERCICIO";
		global $DeleteGreyTit;		$DeleteGreyTit = "PAPELERA STATUS EJERCICIOS";
		global $InicioBlackTit;		$InicioBlackTit = "INICIO STATUS EJERCICIOS";
		require '../Inclu/BotoneraVar.php';
		global $closeButton;

		global $db; 		global $db_name;
		
		if(isset($_POST['oculto2'])){	
					$defaults = array (	'id' => $_POST['id'],
										'year' => $_POST['year'],	
										'ycod' => $_POST['ycod'],	
										'stat' => $_POST['stat'],
										'hidden' => $_POST['hidden'],
										'date' => $_POST['date']);
		} elseif(isset($_POST['oculto'])){
					$defaults = $_POST;
		} else { $defaults = array ( 'id' => $_POST['id'],
									'year' => $_POST['year'],	
									'ycod' => $_POST['ycod'],	
									'stat' => $_POST['stat'],
									'hidden' => $_POST['hidden'],	
									'date' => $_POST['date']);
								}

		print("<table class='tableForm' >
					<tr>
						<th colspan=5 >RECUPERAR STATUS EJERCICIO</th>
					</tr>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td align='center'>YEAR</td>
					<td align='center'>CODE</td>
					<td align='center'>STATUS</td>
					<td align='center'>HIDDEN</td>
					<tdalign='center'>DATE</tdalign=>
				</tr>
				<tr>
					<td>
		<input name='year' type='hidden' value='".$defaults['year']."' />".$defaults['year']."
		<input name='id' type='hidden' value='".$defaults['id']."' />
					</td>
					<td align='center'>
		<input name='ycod' type='hidden' value='".$defaults['ycod']."' />".$defaults['ycod']."
						</td>
						<td align='center'>
		<input name='stat' type='hidden' value='".$defaults['stat']."' />".$defaults['stat']."
						</td>
						<td align='center'>
		<input name='hidden' type='hidden' value='".$defaults['hidden']."' />".$defaults['hidden']."
						</td>
						<td align='center'>
		<input name='date' type='hidden' value='".$defaults['date']."' />".$defaults['date']."
						</td>
					</tr>
					<tr>
						<td colspan='5' style='text-align:right;' >
							".$RestoreBlack.$closeButton."
								<input type='hidden' name='oculto' value=1 />
			</form>														
							".$InicioBlack."
								<a href='status_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
							".$closeButton.$DeleteGrey."
								<a href='status_feedback_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
							".$closeButton."
						</td>
					</tr>
				</table>"); 
	
	}  // FIN function show_form()

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info_01(){

		global $db;
		
		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
		global $text;
		$text = "\n- RECUPERAR FEEDBACK SELECCIONADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t YEAR: ".$_POST['year'].".\n\t STATUS: ".$_POST['stat'].".\n\t HIDDEN: ".$_POST['hidden'].".";

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
		
		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
		global $text;
		$text = "\n- FEEDBACK RECUPERADO ".$ActionTime.".\n\t ID: ".$_POST['id'].".\n\t YEAR: ".$_POST['year'].".\n\t STATUS: ".$_POST['stat'].".\n\t HIDDEN: ".$_POST['hidden'].".";

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