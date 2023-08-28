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
	$orden = '`ret` ASC';
	
	global $vname; 		$vname = "`".$_SESSION['clave']."retencion`";

	$sqlb =  "SELECT * FROM $vname ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);

	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else {
			if(mysqli_num_rows($qb) == 0){

				require 'retencion_NoData.php';
				
			} else { 
				print ("<table align='center'>
						<tr>
							<th colspan=5 class='BorderInf'>
								TIPOS % RETENCION ".mysqli_num_rows($qb)." RESULTADOS.
							</th>
						</tr>
						<tr>
							<th class='BorderInfDch'>ID</th>
							<th class='BorderInfDch'>VALUE %</th>
							<th class='BorderInfDch'>NAME</th>
							<th colspan=2 >
				<a href='retencion_Crear.php' class='botonverde' style='color:#343434;'>CREAR RETENCION</a>
							</th>
						</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

				if($rowb['ret'] != 0.00){

					print (	"<tr align='center'>
						<form name='modifica' action='retencion_Modificar_02.php' method='POST'>
								<td class='BorderInfDch' align='center'>
							<input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
								</td>
								<td class='BorderInfDch' align='center'>
							<input name='ret' type='hidden' value='".$rowb['ret']."' />".$rowb['ret']."
								</td>
								<td class='BorderInfDch' align='center'>
							<input name='name' type='hidden' value='".$rowb['name']."' />".$rowb['name']."
								</td>
								<td class='BorderInf' align='center'>
							<input type='submit' class='botonnaranja' value='MODIFICAR % RETENCION' />
							<input type='hidden' name='oculto2' value=1 />
						</form>
								</td>
								<td class='BorderInf' align='center'>
				<form name='modifica' action='retencion_Borrar_02.php' method='POST'>
						<input name='id' type='hidden' value='".$rowb['id']."' />
						<input name='ret' type='hidden' value='".$rowb['ret']."' />
						<input name='name' type='hidden' value='".$rowb['name']."' />
					<!--
						<input type='submit' class='botonrojo'  value='BORRAR % RETENCION' />
					-->
					<button type='submit' title='BORRAR' class='botonrojo imgDelete DeleteWhite'></button>
					<input type='hidden' name='oculto2' value=1 />
						</form>
								</td>
							</tr>");
						} // FIN IF
					} /* Fin del while.*/ 
			print("	</table> ");
			
			} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */

	}	/* FINAL ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		global $rutaIndex;		$rutaIndex = "../";
		require '../Inclu_MInd/MasterIndexVar.php';
		global $rutaRetencion;	$rutaRetencion = "";
		require '../Inclu_MInd/MasterIndex.php'; 
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function info(){

		global $db; 		global $rowout;
		global $nombre; 	global $apellido;
		
		global $orden;
		if((isset($_POST['Orden']))&&($_POST['Orden']!= '')){
			$orden = $_POST['Orden'];
		}else{ $orden = '`id` ASC'; }

		if(isset($_POST['todo'])){$nombre = "TODAS LAS RETENCIONES ".$orden;};	

		$ActionTime = date('H:i:s');

		global $dir;
		if ($_SESSION['Nivel'] == 'admin'){ 
					$dir = "../cbj_Docs/log";
					}
		
		global $text;
		$text = "\n- RETENCION MODIFICAR BUSCAR: ".$ActionTime.".\n\t Filtro => ".$nombre.".";
		
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