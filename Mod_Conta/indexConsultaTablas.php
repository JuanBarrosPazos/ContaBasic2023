<?php


	global $db; 	global $db_name;
	
	global $dyt1;
	if(isset($_POST['dy'])){
		if(strlen(trim($_POST['dy'])) != 0){ $dyt1  = '20'.$_POST['dy']; }else{ $dyt1 = date('Y'); }
	}else{ $dyt1 = date('Y'); }
    global $dyt1y;  $dyt1y = substr($dyt1, -2);    //echo $dyt1y;
	
	global $dm1; 
	if(isset($_POST['dm'])){
		if(strlen(trim($_POST['dm'])) != 0){ $dm1 = $_POST['dm']; }else{ $dm1 = "TRI0"; }
	}else{ $dm1 = "TRI0"; }	

	if(($dm1 == "TRI0")||($dm1 == "TRI1")||($dm1 == "TRI2")||($dm1 == "TRI3")||($dm1 == "TRI4")||($dm1 == "ANU")||($dm1 == "")){ }else{ $dm1 = substr($dm1,1,2); }

	global $sent; 	$sent = "LIKE '".$dyt1y."/".$dm1."/%'";

	////////////////////		***********  		////////////////////
                        /* TABLA BALANCE INGRESOS */
	////////////////////		***********  		////////////////////

	global $vnamei; 	$vnamei = "`".$_SESSION['clave']."gastos_".$dyt1."`";
	global $sqli;
	$sqli = "SELECT * FROM $vnamei WHERE `factdate` $sent ORDER BY `id` ASC ";
	//echo "<br>".$sqli."<br>";
	$qbi = mysqli_query($db, $sqli);

/////////////////////	
/* PARA SUMAR PVPTOT */

    global $OperSqlToti;        $OperSqlToti = "SUM(`factpvptot`)";
	$sqlSumToti = "SELECT $OperSqlToti AS 'YearSumToti' FROM $vnamei WHERE `factdate` $sent ";
    //echo $sqlSumToti."<br>";
    $qrySumToti = mysqli_query($db, $sqlSumToti);
    $SumToti = mysqli_fetch_assoc($qrySumToti);
	global $sumapvptoti;
    $sumapvptoti = $SumToti['YearSumToti'];
	$sumapvptoti  = number_format($sumapvptoti ,2,".","");

/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */	

    global $OperSqlRetei;        $OperSqlRetei = "SUM(`factrete`)";
    $sqlSumRetei = "SELECT $OperSqlRetei AS 'YearSumRetei' FROM $vnamei WHERE `factdate` $sent ";
    $qrySumRetei = mysqli_query($db, $sqlSumRetei);
    $SumRetei = mysqli_fetch_assoc($qrySumRetei);
	global $sumaretei;
    $sumaretei = $SumRetei['YearSumRetei'];
	$sumaretei  = number_format($sumaretei ,2,".","");

/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */	

    global $OperSqlIvai;        $OperSqlIvai = "SUM(`factivae`)";
    $sqlSumIvai = "SELECT $OperSqlIvai AS 'YearSumIvai' FROM $vnamei WHERE `factdate` $sent ";
    $qrySumIvai = mysqli_query($db, $sqlSumIvai);
    $SumIvai = mysqli_fetch_assoc($qrySumIvai);
	global $sumaivaei;
    $sumaivaei = $SumIvai['YearSumIvai'];
	$sumaivaei  = number_format($sumaivaei ,2,".","");

/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qbi){
	print("<font color='#FF0000'>Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else {
		if(mysqli_num_rows($qbi) == 0){
				print ("<table class='tabla' >
							<tr>
							<th colspan='3' class='BorderInf'>BALANCE INGRESOS</th>
						</tr>
						<tr>
							<td colspan='3'>
							<span style='display:block; margin-top: 0.4em;'>
								<font color='#FF0000'>NO HAY DATOS</font>
							</span>
							</td>
						</tr>
						<tr>
							<td colspan='3' class='BorderInf'></td>
						</tr>
						<tr>
							<td class='BorderInfDch' align='center'>IMP DIFER</td>
							<td class='BorderInfDch' align='center'>RETEN DIFER</td>
							<td class='BorderInf' align='center'>TOT DIFER</td>
						</tr>
						<tr>
							<td class='BorderInfDch' align='right'>".$sumaivaei." €</td>
							<td class='BorderInfDch' align='right'>".$sumaretei." €</td>
							<td class='BorderInf' align='right'>".$sumapvptoti." €</td>
						</tr>
					</table>");

		} else { print ("<div style='clear:both'></div>
			<div class='divTablaIndex'>
			<table class='tabla' >
			<tr>
				<th colspan=6 class='BorderInf'>
					BALANCE INGRESOS ".mysqli_num_rows($qbi)."R.
				</th>
			</tr>
			<tr>
				<th class='BorderInfDch'>AÑO</th>		
				<th class='BorderInfDch'>FECHA</th>		
				<th class='BorderInfDch'>IVA REPER</th>
				<th class='BorderInfDch'>SUB TOT</th>
				<th class='BorderInfDch'>RET REPER</th>
				<th class='BorderInf'>TOTAL €</th>			
			</tr>");

		while($rowi = mysqli_fetch_assoc($qbi)){

		global $dyt1;
		//if($rowi['tot']!= 0.00){
		print (	"<tr align='center'>
								
		<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

		<input name='id' type='hidden' value='".$rowi['id']."' />

					<td class='BorderInfDch' align='right'>
		<input name='year' type='hidden' value='".$dyt1."' />".$dyt1."
					</td>

					<td class='BorderInfDch' align='right'>
		<input name='mes' type='hidden' value='".$rowi['factdate']."' />".$rowi['factdate']."
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='iva' type='hidden' value='".$rowi['factivae']."' />".$rowi['factivae']." €
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='sub' type='hidden' value='".$rowi['factpvp']."' />".$rowi['factpvp']." €
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='ret' type='hidden' value='".$rowi['factrete']."' />".$rowi['factrete']." €
					</td>
																		
					<td class='BorderInf' align='right'>
		<input name='tot' type='hidden' value='".$rowi['factpvptot']."' />".$rowi['factpvptot']." €
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
			</table>");
		} /* Fin segundo else anidado en if */

		} /* Fin de primer else . */

	////////////////////		***********  		////////////////////
                        /* TABLA BALANCE GASTOS */
	////////////////////		***********  		////////////////////

	global $vnameg; 	$vnameg = "`".$_SESSION['clave']."gastos_".$dyt1."`";
	global $sqlg;
	$sqlg = "SELECT * FROM $vnameg WHERE `factdate` $sent ORDER BY `id` ASC ";
	//echo $sqlg."<br>";
	$qbg = mysqli_query($db, $sqlg);

/////////////////////	
/* PARA SUMAR PVPTOT */

    global $OperSqlTotg;        $OperSqlTotg = "SUM(`factpvptot`)";
    $sqlSumTotg = "SELECT $OperSqlTotg AS 'YearSumTotg' FROM $vnameg WHERE `factdate` $sent ";
    //echo $sqlSumTot."<br>";
    $qrySumTotg = mysqli_query($db, $sqlSumTotg);
    $SumTotg = mysqli_fetch_assoc($qrySumTotg);
	global $sumapvptotg;
    $sumapvptotg = $SumTotg['YearSumTotg'];
	$sumapvptotg  = number_format($sumapvptotg ,2,".","");

/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */

    global $OperSqlReteg;        $OperSqlReteg = "SUM(`factrete`)";
    $sqlSumReteg = "SELECT $OperSqlReteg AS 'YearSumReteg' FROM $vnameg WHERE `factdate` $sent ";
    //echo $sqlSumRete."<br>";
    $qrySumReteg = mysqli_query($db, $sqlSumReteg);
    $SumReteg = mysqli_fetch_assoc($qrySumReteg);
	global $sumareteg;
    $sumareteg = $SumReteg['YearSumReteg'];
	$sumareteg  = number_format($sumareteg ,2,".","");
			
/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */

    global $OperSqlIvag;        $OperSqlIvag = "SUM(`factivae`)";
    $sqlSumIvag = "SELECT $OperSqlIvag AS 'YearSumIvag' FROM $vnameg WHERE `factdate` $sent ";
    //echo $sqlSumIva."<br>";
    $qrySumIvag = mysqli_query($db, $sqlSumIvag);
    $SumIvag = mysqli_fetch_assoc($qrySumIvag);
	global $sumaivaeg;
    $sumaivaeg = $SumIvag['YearSumIvag'];
	$sumaivaeg  = number_format($sumaivaeg ,2,".","");
			
/* FIN PARA SUMAR IVA */
/////////////////////////

	if(!$qbg){
			print("<font color='#FF0000'>*Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else {
		if(mysqli_num_rows($qbg) == 0){
				print ("<table class='tablac' >
							<tr>
							<th colspan='3' class='BorderInf'>BALANCE GASTOS</th>
						</tr>
						<tr>
							<td colspan='3'>
							<span style='display:block; margin-top: 0.4em;'>
								<font color='#FF0000'>NO HAY DATOS</font>
							</span>
							</td>
						</tr>
						<tr>
							<td colspan='3' class='BorderInf'></td>
						</tr>
						<tr>
							<td class='BorderInfDch' align='center'>IMP DIFER</td>
							<td class='BorderInfDch' align='center'>RETEN DIFER</td>
							<td class='BorderInf' align='center'>TOT DIFER</td>
						</tr>
						<tr>
							<td class='BorderInfDch' align='right'>".$sumaivaei." €</td>
							<td class='BorderInfDch' align='right'>".$sumaretei." €</td>
							<td class='BorderInf' align='right'>".$sumapvptoti." €</td>
						</tr>
					</table>");

		} else { print ("<table class='tablac' >
								<tr>
									<th colspan='6' class='BorderInf'>
							BALANCE GASTOS ".mysqli_num_rows($qbg)."R.
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
			
	while($rowg = mysqli_fetch_assoc($qbg)){

	global $dyt1;
	//if($rowb['tot']!= 0.00){
			print (	"<tr align='center'>
									
<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">
	<input name='dyt1' type='hidden' value='".$dyt1."' />
	<input name='id' type='hidden' value='".$rowg['id']."' />

						<td class='BorderInfDch' align='right'>
	<input name='year' type='hidden' value='".$dyt1."' />".$dyt1."
						</td>
	
						<td class='BorderInfDch' align='right'>
	<input name='mes' type='hidden' value='".$rowg['factdate']."' />".$rowg['factdate']."
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='iva' type='hidden' value='".$rowg['factivae']."' />".$rowg['factivae']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='sub' type='hidden' value='".$rowg['factpvp']."' />".$rowg['factpvp']." €
						</td>
						
						<td class='BorderInfDch' align='right'>
	<input name='ret' type='hidden' value='".$rowg['factrete']."' />".$rowg['factrete']." €
						</td>
						
						<td class='BorderInf' align='right'>
	<input name='tot' type='hidden' value='".$rowg['factpvptot']."' />".$rowg['factpvptot']." €
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
			</table>");
			} /* Fin segundo else anidado en if */
		} /* Fin de primer else . */
		
			////////////////////		**********  		////////////////////
								/* TABLA BALANCE DIFERENCIAL */
			////////////////////		**********  		////////////////////
		
/////////////////////	

/* OPERACIONES PARA DIFER */	

	
	global $sumapvptoti; 		global $sumaretei; 		global $sumaivaei;
	global $sumapvptotg; 		global $sumareteg; 		global $sumaivaeg;
	global $sumapvptotd; 		global $sumareted; 		global $sumaivaed;

	$sumapvptotd = $sumapvptoti - $sumapvptotg;
	$sumapvptotd  = number_format($sumapvptotd ,2,".","");
	//if($sumapvptotd == ""){$sumapvptotd = "0.00"; }else{ }

	$sumareted = $sumaretei - $sumareteg;
	$sumareted  = number_format($sumareted ,2,".","");
	//if($sumareted == ""){ $sumareted = "0.00";}else{ }

	$sumaivaed = $sumaivaei - $sumaivaeg;
	$sumaivaed  = number_format($sumaivaed ,2,".","");

	print ("<table class='tabla' >
					<tr>
						<th colspan='3' class='BorderInf'>
								BALANCE DIFERENCIAL
						</th>
					</tr>
					<tr>
						<td colspan='3'>
							<span style='display:block; margin-top: 0.4em;'>
								&nbsp;
							</span>
						</td>
					</tr>
					<tr>
						<td colspan='3' class='BorderInf'></td>
					</tr>
					<tr>
						<td class='BorderInfDch' align='center'>IMP DIFER</td>
						<td class='BorderInfDch' align='center'>RETEN DIFER</td>
						<td class='BorderInf' align='center'>TOT DIFER</td>
					</tr>
					<tr>
						<td class='BorderInfDch' align='right'>".$sumaivaed." €</td>
						<td class='BorderInfDch' align='right'>".$sumareted." €</td>
						<td class='BorderInf' align='right'>".$sumapvptotd." €</td>
					</tr>
				</table>
			</div>");


?>