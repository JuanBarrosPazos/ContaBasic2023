<?php

	print("<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
                <input type='hidden' name='id' value='".@$defaults['id']."' />
                <input type='hidden' name='clienteingresos' value='".$defaults['clienteingresos']."' />
				<tr>
					<td style='text-align:right;'>NUMERO</td>
					<td>
		<input type='text' name='factnum' size=22 maxlength=20 value='".strtoupper(@$defaults['factnum'])."' />
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>FECHA</td>
					<td>
				<div style='float:left'>");
								
		require '../Inclu/year_in_select_bbdd.php';
																
		print ("</select>
					</div>
					<div style='float:left'>
				<select style='margin-left:12px' name='dm' class='botonverde' >");
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
						<select style='margin-left:12px' name='dd' class='botonverde'>");
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
					<td style='text-align:right;'>RAZON SOCIAL</td>
					<td>
		<input type='hidden' name='factnom' value='".@$defaults['factnom']."' />".@$defaults['factnom']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>REFERENCIA</td>
					<td>
		<input type='hidden' name='refcliente' value='".$defaults['refcliente']."' />".$defaults['refcliente']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>NIF/CIF</td>
					<td>
		<input type='hidden' name='factnif'value='".@$defaults['factnif']."' />".@$defaults['factnif']."
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IMPUESTOS %</td>
					<td>
			<div style='float:left'>
				<select name='factiva' class='botonverde'>");

		global $db;
		global $vname; 		$vname = "`".$_SESSION['clave']."impuestos`";
		$sqli =  "SELECT * FROM $vname ORDER BY `iva` ASC ";
		$qi = mysqli_query($db, $sqli);

			if(!$qi){	print("* ".mysqli_error($db)."</br>");
			} else {
					while($rowimp = mysqli_fetch_assoc($qi)){
							print ("<option value='".$rowimp['iva']."' ");
							if($rowimp['iva'] == @$defaults['factiva']){
							print ("selected = 'selected'");
									}
							print ("> ".$rowimp['name']." </option>");
							}
						} 
						 
		print ("</select>
						</div>
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>IMPUESTOS €</td>
					<td>
			<input style='text-align:right' type='text' name='factivae1' size=5 maxlength=5 value='".@$defaults['factivae1']."' />,
			<input type='text' name='factivae2' size=2 maxlength=2 value='".@$defaults['factivae2']."' />€
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RETENCIONES %</td>
					<td>
			<div style='float:left'>
				<select name='factret' class='botonverde'>");

		global $db;
		global $vnamer; 	$vnamer = "`".$_SESSION['clave']."retencion`";
		$sqlr =  "SELECT * FROM $vnamer ORDER BY `ret` ASC ";
		$qr = mysqli_query($db, $sqlr);

			if(!$qr){	print("* ".mysqli_error($db)."</br>");
				} else {
					while($rowret = mysqli_fetch_assoc($qr)){
							print ("<option value='".$rowret['ret']."' ");
							if($rowret['ret'] == @$defaults['factret']){
							print ("selected = 'selected'");
								}
							print ("> ".$rowret['name']." </option>");
							}
						} 
						 
		print ("</select>
						</div>
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>RETENCIONES €</td>
					<td>
			<input style='text-align:right' type='text' name='factrete1' size=5 maxlength=5 value='".@$defaults['factrete1']."' />,
			<input type='text' name='factrete2' size=2 maxlength=2 value='".@$defaults['factrete2']."' />€
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>SUBTOTAL €</td>
					<td>
			<input style='text-align:right' type='text' name='factpvp1' size=5 maxlength=5 value='".@$defaults['factpvp1']."' />,
			<input type='text' name='factpvp2' size=2 maxlength=2 value='".@$defaults['factpvp2']."' />€
					</td>
				</tr>
				<tr>
					<td style='text-align:right;'>TOTAL €</td>
					<td>
			<input style='text-align:right' type='text' name='factpvptot1' size=5 maxlength=5 value='".@$defaults['factpvptot1']."' />,
			<input type='text' name='factpvptot2' size=2 maxlength=2 value='".@$defaults['factpvptot2']."' />€
					</td>
				</tr>
				<tr>
					<td style='text-align:right; vertical-align:top;'>DESCRIPCIÓN</td>
					<td>
			<textarea cols='35' rows='7' onkeypress='return limitac(event, 200);' onkeyup='actualizaInfoc(200)' name='coment' id='coment'>".@$defaults['coment']."</textarea>
			</br>
	            <div id='infoc' align='center' style='color:#0080C0;'>
        					Maximum 200 characters            
				</div>
					</td>
				</tr>");

?>