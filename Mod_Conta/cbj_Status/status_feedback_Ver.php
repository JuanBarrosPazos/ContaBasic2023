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
					ver_todo();
					info();
									
	} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function ver_todo(){
		
		global $db; 		global $db_name;
		
		global $vname; 		$vname = "`".$_SESSION['clave']."statusfeedback`";

		$sqlb =  "SELECT * FROM $vname ORDER BY `year` ASC ";
		$qb = mysqli_query($db, $sqlb);

		if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		} else {
			if(mysqli_num_rows($qb) == 0){

				require 'status_NoData.php';

			}else{ print ("<table align='center'>
							<tr>
								<th colspan=8 class='BorderInf'>
							RECUPERAR FEEDBACK EJERCCIOS ".mysqli_num_rows($qb)." RESULTADOS
								</th>
							</tr>
							<tr>
								<th class='BorderInfDch'>ID</th>
								<th class='BorderInfDch'>YEAR</th>
								<th class='BorderInfDch'>ICOD</th>
								<th class='BorderInfDch'>STATE</th>
								<th class='BorderInfDch'>HIDDEN</th>
								<th class='BorderInfDch'>DATE</th>
								<th colspan=2 class='BorderInf'>
				<a href='status_Ver.php' class='botonverde' style='color:#343434;'>INICIO EJERCICOS STATUS</a>
								</th>
							</tr>");
			
		while($rowb = mysqli_fetch_assoc($qb)){

			print (	"<tr align='center'>
				<form name='modifica' action='status_feedback_recuperar_02.php' method='POST'>
						<td class='BorderInfDch' align='center'>
					<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
						</td>
						<td class='BorderInfDch' align='center'>
					<input name='year' type='hidden' value='".$rowb['year']."' />".$rowb['year']."
						</td>
						<td class='BorderInfDch' align='center'>
					<input name='ycod' type='hidden' value='".$rowb['ycod']."' />".$rowb['ycod']."
						</td>
						<td class='BorderInfDch' align='center'>
					<input name='stat' type='hidden' value='".$rowb['stat']."' />".$rowb['stat']."
						</td>
						<td class='BorderInfDch' align='center'>
					<input name='hidden' type='hidden' value='".$rowb['hidden']."' />".$rowb['hidden']."
						</td>
						<td class='BorderInfDch' align='center'>
					<input name='date' type='hidden' value='".$rowb['date']."' />".$rowb['date']."
						</td>
						<td class='BorderInf' align='right'>
					<input type='submit' value='RECUPERAR FEEDBACK EJERCICIO' class='botonverde' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
						</td>
						<td class='BorderInf' >
				<form name='modifica' action='status_feedback_borrar_02.php' method='POST'>
					<input name='id' type='hidden' value='".$rowb['id']."' />
					<input name='year' type='hidden' value='".$rowb['year']."' />
					<input name='ycod' type='hidden' value='".$rowb['ycod']."' />
					<input name='stat' type='hidden' value='".$rowb['stat']."' />
					<input name='hidden' type='hidden' value='".$rowb['hidden']."' />
					<!--
					<input type='submit' value='BORRAR FEEDBACK EJERCICIO' />
					-->
				<button type='submit' title='BORRAR' class='botonrojo imgButIco DeleteWhite'></button>
						<input type='hidden' name='oculto2' value=1 />
				</form>
						</td>
					</tr>");
				} /* Fin del while.*/ 

				print("</table>");
			
			} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */

	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaStatus;	$rutaStatus = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info(){

		global $db;
		global $nombre;		$nombre = "STATUS TODOS LOS EJERCICIOS";
		
		global $orden;
		if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
			$orden = $_POST['Orden'];
		}else{ $orden = '`id` ASC'; }

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
		global $text;
		$text = "\n- FEEDBACK EJERCICIO RECUPERA 1: ".$ActionTime.".\n\t Filtro => ".$nombre.".";
		
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

	require '../Inclu/Conta_Footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

?>