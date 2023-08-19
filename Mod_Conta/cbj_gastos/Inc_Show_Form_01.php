<?php

	if(isset($_POST['show_formcl'])){
				$defaults = $_POST;
	} elseif(isset($_POST['todo'])){
			$defaults = $_POST;
	} else { $defaults = array ('factnom' => '',
								 'factnif' => '',
								 'factnum' => '',
								 'Orden' => isset($ordenar));
							}

	$dm = array ( '' => 'MONTH', '01' => 'ENERO', '02' => 'FEBRERO',
				  '03' => 'MARZO', '04' => 'ABRIL', '05' => 'MAYO',
				  '06' => 'JUNIO', '07' => 'JULIO', '08' => 'AGOSTO',
				  '09' => 'SEPTIEMBRE', '10' => 'OCTUBRE', '11' => 'NOVIEMBRE',
				  '12' => 'OCTUBRE');
	
	$dd = array ( '' => 'DAY', '01' => '01', '02' => '02', '03' => '03',
				  '04' => '04', '05' => '05', '06' => '06', '07' => '07',
				  '08' => '08', '09' => '09', '10' => '10', '11' => '11',
				  '12' => '12', '13' => '13', '14' => '14', '15' => '15',
				  '16' => '16', '17' => '17', '18' => '18', '19' => '19',
				  '20' => '20', '21' => '21', '22' => '22', '23' => '23',
				  '24' => '24', '25' => '25', '26' => '26', '27' => '27',
				  '28' => '28', '29' => '29', '30' => '30', '31' => '31');
										
	global $cnt; 		$cnt = 0;
	
	if ($errors){
		global $cnt; 		$cnt = 1;
		print("	<table style='border:none; text-align: center; margin: 0.4em auto 0.4em auto;'>
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
			</table>
				<div style='clear:both'></div>");
		} // FIN ERRORS
	
	$ordenar = array (	'`factdate` ASC' => 'Fecha Asc',
						'`factdate` DESC' => 'Fecha Desc',
						'`factnum` ASC' => 'Nº Factura Asc',
						'`factnum` DESC' => 'Nº Factura Desc',
						'`factnif` ASC' => 'NIF Asc',
						'`factnif` DESC' => 'NIF Desc',
						'`factnom` ASC' => 'Razon Social Asc',
						'`factnom` DESC' => 'Razon Social Desc',
																);
	
	print("<table align='center' style=\"border:0px;margin-top:4px\">
				<tr>
					<th colspan=2>CONSULTAR GASTOS</th>
				</tr>
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
				<tr>
					<td align='right' class='BorderSup'>
				<input type='submit' value='FILTRO GASTOS' title='FILTRO DE GASTOS' class='botonazul' />
				<input type='hidden' name='show_formcl' value=1 />
					</td>
					<td class='BorderSup'>
			<div style='float:left'>
		<select name='Orden' title='ORDENAR POR...' class='botonverde' >");
				foreach($ordenar as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['Orden']){
									print ("selected = 'selected'");
										}
								print ("> $label </option>");
					}	
						
	print ("</select>
				</div> 
				<div style='float:left'>");
								
		require '../Inclu/year_select_bbdd.php';

	print ("</select>
				</div>
				<div style='float:left'>
						<select name='dm' title='SELECCIONAR MES...' class='botonverde' >");
				foreach($dm as $optiondm => $labeldm){
					print ("<option value='".$optiondm."' ");
					if($optiondm == @$defaults['dm']){
								print ("selected = 'selected'");
									}
								print ("> $labeldm </option>");
						}	
																
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dd' title='SELECCIONAR DIA...' class='botonverde'>");
				foreach($dd as $optiondd => $labeldd){
					print ("<option value='".$optiondd."' ");
					if($optiondd == @$defaults['dd']){
										print ("selected = 'selected'");
											}
									print ("> $labeldd </option>");
							}	
																
	print ("</select>
				</div>
				</td>
			</tr>
			<tr>					
				<td colspan='2' class='BorderInf'>	
				<div style='float:left; margin-right:12px'>
			Nº FACTURA: &nbsp;
			<input type='text' name='factnum' size=22 maxlength=20 value='".@$defaults['factnum']."' />
				</div>
				<div style='float:left; margin-right:12px'>
			NIF: &nbsp;
			<!--
			<input type='text' name='factnif' size=22 maxlength=10 value='".@$defaults['factnif']."' />
			-->
			<select name='factnif' title='NUMERO NIF FACTURA' class='botonverde'>
			<option value=''>Nº NIF</option>");
			global $db; 
			global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."proveedores`";

			$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
			$qb = mysqli_query($db, $sqlb);
			if(!$qb){
					print("* ".mysqli_error($db)."<br/>");
			} else {
					while($rows = mysqli_fetch_assoc($qb)){
						print ("<option value='".$rows['dni'].$rows['ldni']."' ");
						if($rows['dni'].$rows['ldni'] == @$defaults['factnif']){
													print ("selected = 'selected'");
															}
								print ("> ".$rows['dni'].$rows['ldni']." </option>");
							}
					}  

	print ("</select>
				</div>
				<div style='float:left; margin-right:12px'>
					RAZON SOCIAL: &nbsp;
					<!--
					<input type='text' name='factnom' size=22 maxlength=22 value='".@$defaults['factnom']."' />
					-->
			<select name='factnom' title='RAZON SOCIAL' class='botonverde'>
			<option value=''>RAZON SOCIAL</option>");
		global $db;
		global $tabla1; 		$tabla1 = "`".$_SESSION['clave']."proveedores`";
		$sqlb =  "SELECT * FROM $tabla1 ORDER BY `rsocial` ASC ";
		$qb = mysqli_query($db, $sqlb);
		if(!$qb){
				print("* ".mysqli_error($db)."<br/>");
		} else {
		while($rows = mysqli_fetch_assoc($qb)){
					print ("<option value='".$rows['ref']."' ");
					if($rows['ref'] == @$defaults['factnom']){
										print ("selected = 'selected'");
												}
								print ("> ".$rows['rsocial']." </option>");
						}
			}

	print ("</select>
				</div>
					</td>
				</tr>
			</form>");
						
	////////

	if(isset($_POST['show_formcl'])){	global $cnt;
										gt2();
											}
	////////

	print ("<form name='todo' method='post' action='$_SERVER[PHP_SELF]' >
				<tr>
					<td align='center' class='BorderSup'>
			<input type='submit' value='TODOS LOS GASTOS' title='VER TODOS LOS GASTOS' class='botonazul' />
			<input type='hidden' name='todo' value=1 />
					</td>
					<td class='BorderSup'>	
			<div style='float:left'>
			<select name='Orden' title='ORDENAR POR...' class='botonverde'>");
						
				foreach($ordenar as $option => $label){
					
					print ("<option value='".$option."' ");
					
					if($option == $defaults['Orden']){
															print ("selected = 'selected'");
																								}
													print ("> $label </option>");
												}	
						
	print ("</select>
				</div>
				<div style='float:left'>");
								
		require '../Inclu/year_select_bbdd.php';
									
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dm'  title='SELECCIONAR MES...' class='botonverde'>");
					foreach($dm as $optiondm => $labeldm){
								print ("<option value='".$optiondm."' ");
						if($optiondm == @$defaults['dm']){
											print ("selected = 'selected'");
													}
										print ("> $labeldm </option>");
							}	
																
	print ("</select>
				</div>
				<div style='float:left'>
					<select name='dd' title='SELECCIONAR DIA...' class='botonverde'>");
						foreach($dd as $optiondd => $labeldd){
							print ("<option value='".$optiondd."' ");
							if($optiondd == @$defaults['dd']){
												print ("selected = 'selected'");
															}
											print ("> $labeldd </option>");
									}	
																
	print ("</select>
					</div>
				</form>														
					</td></tr>");

	////////
	
		if(isset($_POST['todo'])){ gt1(); }

	////////
			
		print("	</table>
							
				"); /* Fin del print */


?>