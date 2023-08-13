<?php

	global $db; 	global $db_name; 	global $dyt1;
	
	if(isset($_POST['dy'])){
		if(strlen(trim($_POST['dy'])) != 0){ $dyt1  = '20'.$_POST['dy']; }else{ $dyt1 = date('Y'); }
	}else{ $dyt1 = date('Y'); }
    global $dyt1y;  $dyt1y = substr($dyt1, -2);    //echo $dyt1y;

	global $dm1; 
	if(isset($_POST['dm'])){
		if(strlen(trim($_POST['dm'])) != 0){ $dm1 = $_POST['dm']; }else{ $dm1 = "TRI0"; }
	}else{ $dm1 = "TRI0"; }	
	//echo $dm1;

	global $sent; 	$sent = "LIKE '%".$dm1."%'";

    global $betwIni;    global $betwFin;
    global $mesIni;     global $mesFin;
	
    if($dm1 == 'TRI0'){
        $mesIni = 1;            $mesFin = 3;
		$mesIniGri = 1;			$mesFinGri = 3;
		$mesIniGrg = 1;			$mesFinGrg = 3;
		$mesIniGrd = 1;			$mesFinGrd = 3;
    }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	////////////////////		***********  		////////////////////
                        /* TABLA BALANCE INGRESOS */
	////////////////////		***********  		////////////////////

	
	global $vnamei; 	$vnamei = "`".$_SESSION['clave']."ingresos_".$dyt1."`";

    global $OperSql;        $OperSql = "*";

    $sqli = "SELECT $OperSql FROM $vnamei";
    //echo " <br>* ".$sqli."<br>";
	$qbi = mysqli_query($db, $sqli);
	$counti = mysqli_num_rows($qbi);
    //echo "Rows: ".$counti."<br><br>";

/////////////////////	
/* PARA SUMAR PVPTOT */	
    global $OperSql;        $OperSql = "SUM(`factpvptot`)";

    $sqlSumToti = "SELECT $OperSql AS 'YearSumToti' FROM $vnamei";
    //echo "- ".$sqlSumToti."<br>";
    $qrySumToti = mysqli_query($db, $sqlSumToti);
    $SumToti = mysqli_fetch_assoc($qrySumToti);
	global $sumapvptoti;
    $sumapvptoti = $SumToti['YearSumToti'];
	$sumapvptoti  = number_format($sumapvptoti ,2,".","");
    //if($sumapvptoti == ''){ $sumapvptoti = "0.00"; }else{ }
    //echo "- TOTAL ANUAL: ".$sumapvptoti."<br>";

/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */	

    global $OperSql;        $OperSql = "SUM(`factrete`)";

    $sqlSumRetei = "SELECT $OperSql AS 'YearSumRetei' FROM $vnamei";
    //echo "* ".$sqlSumRetei."<br>";
    $qrySumRetei = mysqli_query($db, $sqlSumRetei);
    $SumRetei = mysqli_fetch_assoc($qrySumRetei);
	global $sumaretei;
    $sumaretei = $SumRetei['YearSumRetei'];
	$sumaretei  = number_format($sumaretei ,2,".","");
    //if($sumaretei == ''){ $sumaretei = "0.00"; }else{ }
    //echo "* TOTAL ANUAL RETENCIONES: ".$sumaretei."<br>";

/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	 
/* PARA SUMAR IVA */	

    global $OperSql;        $OperSql = "SUM(`factivae`)";
    $sqlSumIvai = "SELECT $OperSql AS 'YearSumIvai' FROM $vnamei";
    //echo "- ".$sqlSumIvai."<br>";
    $qrySumIvai = mysqli_query($db, $sqlSumIvai);
    $SumIvai = mysqli_fetch_assoc($qrySumIvai);
	global $sumaivaei;
    $sumaivaei = $SumIvai['YearSumIvai'];
	$sumaivaei  = number_format($sumaivaei ,2,".","");
    //if($sumaivaei == ''){ $sumaivaei = "0.00";   }else{ }
    //echo "- TOTAL ANUAL IVA: ".$sumaivaei."<br>";

/* FIN PARA SUMAR IVA */
/////////////////////////

    print ("<div style='clear:both'></div>
			<div class='divTablaIndex' >
			<table class='tabla' >
			<tr>
				<th colspan=6 class='BorderInf resultadosi'>
					BALANCE INGRESOS ".$counti."R
				</th>
			</tr>
			<tr>
				<td colspan=6 class='BorderInf'>
					<div class='section'>
						<ul class='timeline'>");
			  
		global $grd;	$gri = 1;

		while($gri<=4){

			if($dm1 == 'TRI0'){
				if($mesIniGri < 10){ $mesIniGri = '0'.$mesIniGri; }else{ }
				if($mesFinGri < 10){ $mesFinGri = '0'.$mesFinGri; }else{ }
				$betwIniGri = $dyt1y.'/'.$mesIniGri.'/01';
				$betwFinGri = $dyt1y.'/'.$mesFinGri.'/31';
		
				global $MesNombGri;
				if($mesFinGri < 4){ $MesNombGri = "TRI1"; 
				}elseif($mesFinGri < 7){ $MesNombGri = "TRI2"; 
				}elseif($mesFinGri < 10){ $MesNombGri = "TRI3"; 
				}else{  $MesNombGri = "TRI4"; }

				$rowi['factdate'] = $MesNombGri;
			}
			
			$SqlFromi = "FROM $vnamei WHERE (`factdate` BETWEEN '$betwIniGri' AND '$betwFinGri')";
			$sqlSumToti = "SELECT SUM(`factpvptot`) AS 'TriSumToti' $SqlFromi";
			$qrySumToti = mysqli_query($db, $sqlSumToti);
			$SumToti = mysqli_fetch_assoc($qrySumToti);
			$TriSumToti = $SumToti['TriSumToti'];
			$rowi['factpvptot']  = number_format($TriSumToti ,2,".","");
			//if($TriSumTotg == ''){ $TriSumTotg = "0.00"; }else{ }
			global $sumapvptoti;
			if($sumapvptoti > 0){
				$TotEi = ($rowi['factpvptot']*100)/$sumapvptoti;
			}else{ $TotEi = 0.00;}

			print("<li>
						<a href='#' title='".$rowi['factdate']." ".$rowi['factpvptot']." €'>
							<span class='label'>".$rowi['factdate']."<br>".$rowi['factpvptot']."</span>
							<span class='count bgcolori' style='height: ".$TotEi."%'>(".$TotEi.")</span>
						</a>
					</li>");

			$gri++;	$mesIniGri = $mesIniGri+3;    $mesFinGri = $mesFinGri+3;
		}

		print("	</ul>
				</div>
					</td>
				</tr>
			
			</tr>
				<tr>
					<td colspan='6' class='BorderInf'>
				</td>
			</tr>
			<tr>
				<td colspan='2' class='BorderInfDch resultadosi' align='center'>IMP REPER</td>
				<td colspan='2' class='BorderInfDch resultadosi' align='center'>RETEN REPER</td>
				<td colspan='2' class='BorderInf resultadosi' align='center'>TOT INGRESOS</td>
			</tr>
			<tr>
				<td colspan='2' class='BorderInfDch resultadosi' align='right'>".$sumaivaei." €</td>
				<td colspan='2' class='BorderInfDch resultadosi' align='right'>".$sumaretei." €</td>
				<td colspan='2' class='BorderInf resultadosi' align='right'>".$sumapvptoti." €</td>
			</tr>
			<tr>
				<td colspan='6' class='BorderInf'></td>
			</tr>
			<tr>
				<th class='BorderInfDch'>AÑO</th>		
				<th class='BorderInfDch'>MES</th>		
				<th class='BorderInfDch'>IVA REPER</th>
				<th class='BorderInfDch'>SUB TOT</th>
				<th class='BorderInfDch'>RET REPER</th>
				<th class='BorderInf'>TOTAL €</th>			
			</tr>");

    global $i;  $i = 1; 
    
	while($i <= 4){
    
        if(($dm1 == 'TRI0')||($dm1 == 'TRI0')){
            if($mesIni < 10){ $mesIni = '0'.$mesIni; }else{ }
            if($mesFin < 10){ $mesFin = '0'.$mesFin; }else{ }
            $betwIni = $dyt1y.'/'.$mesIni.'/01';
            $betwFin = $dyt1y.'/'.$mesFin.'/31';
    
            global $MesNomb;
            if($mesFin < 4){ $MesNomb = "TRI1"; 
            }elseif($mesFin < 7){ $MesNomb = "TRI2"; 
            }elseif($mesFin < 10){ $MesNomb = "TRI3"; 
            }else{  $MesNomb = "TRI4"; }

			$rowi['factdate'] = $MesNomb;

        }
    
    $SqlFromi = "FROM $vnamei WHERE (`factdate` BETWEEN '$betwIni' AND '$betwFin')";
    $sqlSumIva = "SELECT SUM(`factivae`) AS 'TriSumIvai' $SqlFromi";
    $qrySumIva = mysqli_query($db, $sqlSumIva);
    $SumIva = mysqli_fetch_assoc($qrySumIva);
    $TriSumIvai = $SumIva['TriSumIvai'];
	$rowi['factivae']  = number_format($TriSumIvai ,2,".","");
    //if($TriSumIvai == ''){ $TriSumIvai = "0.00"; }else{ }
	
    $sqlSumSub = "SELECT SUM(`factpvp`) AS 'TriSumSubToti' $SqlFromi";
    $qrySumSub = mysqli_query($db, $sqlSumSub);
    $SumSub = mysqli_fetch_assoc($qrySumSub);
    $TriSumSubToti = $SumSub['TriSumSubToti'];
	$rowi['factpvp']  = number_format($TriSumSubToti ,2,".","");
    //if($TriSumSubToti == ''){ $TriSumSubToti = "0.00"; }else{ }

    $sqlSumRete = "SELECT SUM(`factrete`) AS 'TriSumRetei' $SqlFromi";
    $qrySumRete = mysqli_query($db, $sqlSumRete);
    $SumRete = mysqli_fetch_assoc($qrySumRete);
    $TriSumRetei = $SumRete['TriSumRetei'];
	$rowi['factrete']  = number_format($TriSumRetei ,2,".","");
    //if($TriSumRetei == ''){ $TriSumRetei ="0.00"; }else{ }

    $sqlSumTot = "SELECT SUM(`factpvptot`) AS 'TriSumToti' $SqlFromi";
	//echo "* ".$sqlSumTot."<br>";
    $qrySumTot = mysqli_query($db, $sqlSumTot);
    $SumTot = mysqli_fetch_assoc($qrySumTot);
    $TriSumToti = $SumTot['TriSumToti'];
	$rowi['factpvptot']  = number_format($TriSumToti ,2,".","");
    //if($TriSumToti == ''){ $TriSumToti = "0.00"; }else{ }
            
	global $vnamei; 	global $dyt1;   global $MesNomb;
	print (	"<tr align='center'>
								
	<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

		<input name='id' type='hidden' value='".@$rowi['id']."' />

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

        $i++;   $mesIni = $mesIni+3;    $mesFin = $mesFin+3;

    } /* Fin del while.*/ 

	print("</table>");

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	////////////////////		***********  		////////////////////
                        /* TABLA BALANCE GASTOS */
	////////////////////		***********  		////////////////////

	global $betwIni;    global $betwFin;
    global $mesIni;     global $mesFin;
	global $mesIniGrg;	global $mesFinGrg;
    if($dm1 == 'TRI0'){
        $mesIni = 1;	$mesFin = 3;
		$mesIniGrg = 1;	$mesFinGrg = 3;
	}

	global $vnameg; 	$vnameg = "`".$_SESSION['clave']."gastos_".$dyt1."`";
    
    global $OperSql;        $OperSql = "*";

    $sqlg = "SELECT $OperSql FROM $vnameg";
    //echo " * NUEVA SENTECIA TABLA INFERIOR:<br>".$sqli."<br>";
	$qbg = mysqli_query($db, $sqlg);
	$countg = mysqli_num_rows($qbg);
    //echo "Rows: ".$count."<br><br>";

/////////////////////	
/* PARA SUMAR PVPTOT */

    global $OperSql;        $OperSql = "SUM(`factpvptot`)";
    $sqlSumTotg = "SELECT $OperSql AS 'YearSumTotg' FROM $vnameg";
    //echo $sqlSumTot."<br>";
    $qrySumTotg = mysqli_query($db, $sqlSumTotg);
    $SumTotg = mysqli_fetch_assoc($qrySumTotg);
	global $sumapvptotg;
    $sumapvptotg = $SumTotg['YearSumTotg'];
	$sumapvptotg  = number_format($sumapvptotg ,2,".","");
    //if($sumapvptotg == ''){ $sumapvptotg = "0.00"; }else{ }
    //echo "* TOTAL ANUAL: ".$sumapvptoti."<br>";

/* FIN PARA SUMAR PVPTOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR RETENCION TOT */	

    global $OperSql;        $OperSql = "SUM(`factrete`)";
    $sqlSumReteg = "SELECT $OperSql AS 'YearSumReteg' FROM $vnameg";
    //echo $sqlSumRete."<br>";
    $qrySumReteg = mysqli_query($db, $sqlSumReteg);
    $SumReteg = mysqli_fetch_assoc($qrySumReteg);
	global $sumareteg;
    $sumareteg = $SumReteg['YearSumReteg'];
	$sumareteg  = number_format($sumareteg ,2,".","");
    //if($sumareteg == ''){ $sumareteg = "0.00"; }else{ }
    //echo "* TOTAL ANUAL RETENCIONES: ".$sumaretei."<br>";

/* FIN PARA SUMAR RETENCION TOT */
/////////////////////////

/////////////////////	
/* PARA SUMAR IVA */	

    global $OperSql;        $OperSql = "SUM(`factivae`)";
    $sqlSumIvag = "SELECT $OperSql AS 'YearSumIvag' FROM $vnameg";
    //echo $sqlSumIva."<br>";
    $qrySumIvag = mysqli_query($db, $sqlSumIvag);
    $SumIvag = mysqli_fetch_assoc($qrySumIvag);
	global $sumaivaeg;
    $sumaivaeg = $SumIvag['YearSumIvag'];
	$sumaivaeg  = number_format($sumaivaeg ,2,".","");
    //if($sumaivaeg == ''){ $sumaivaeg = "0.00";   }else{ }
    //echo "* TOTAL ANUAL IVA: ".$sumaivaei."<br>";

/* FIN PARA SUMAR IVA */
/////////////////////////

    print ("<table class='tablac' style='text-aling:center !important;'>
			<tr>
				<th colspan=6 class='BorderInf resultadosg'>
					BALANCE GATOS ".$countg."R
				</th>
			</tr>
			<tr>
				<td colspan=6 class='BorderInf'>
					<div class='section'>
						<ul class='timeline'>");
			  
		global $grg;	$grg = 1;

		while($grg<=4){

			if($dm1 == 'TRI0'){
				if($mesIniGrg < 10){ $mesIniGrg = '0'.$mesIniGrg; }else{ }
				if($mesFinGrg < 10){ $mesFinGrg = '0'.$mesFinGrg; }else{ }
				$betwIniGrg = $dyt1y.'/'.$mesIniGrg.'/01';
				$betwFinGrg = $dyt1y.'/'.$mesFinGrg.'/31';
		
				global $MesNombGrg;
				if($mesFinGrg < 4){ $MesNombGrg = "TRI1"; 
				}elseif($mesFinGrg < 7){ $MesNombGrg = "TRI2"; 
				}elseif($mesFinGrg < 10){ $MesNombGrg = "TRI3"; 
				}else{  $MesNombGrg = "TRI4"; }

				$rowg['factdate'] = $MesNombGrg;
			}
			
			$SqlFromg = "FROM $vnameg WHERE (`factdate` BETWEEN '$betwIniGrg' AND '$betwFinGrg')";

			$sqlSumTotg = "SELECT SUM(`factpvptot`) AS 'TriSumTotg' $SqlFromg";
			$qrySumTotg = mysqli_query($db, $sqlSumTotg);
			$SumTotg = mysqli_fetch_assoc($qrySumTotg);
			$TriSumTotg = $SumTotg['TriSumTotg'];
			$rowg['factpvptot']  = number_format($TriSumTotg ,2,".","");
			//if($TriSumTotg == ''){ $TriSumTotg = "0.00"; }else{ }
			global $sumapvptotg;
			if($sumapvptotg > 0){
				$TotE = ($rowg['factpvptot']*100)/$sumapvptotg;
			}else{ $TotE = 0.00;}

			print("<li>
						<a href='#' title='".$rowg['factdate']." ".$rowg['factpvptot']." €'>
							<span class='label'>".$rowg['factdate']."<br>".$rowg['factpvptot']."</span>
							<span class='count bgcolorg' style='height: ".$TotE."%'>(".$TotE.")</span>
						</a>
					</li>");

			$grg++;	$mesIniGrg = $mesIniGrg+3;    $mesFinGrg = $mesFinGrg+3;
		}

		print("	</ul>
				</div>
					</td>
				</tr>
				<tr>
					<td colspan='6' class='BorderInf'>
					</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch resultadosg' align='center'>IMP REPER</td>
					<td colspan='2' class='BorderInfDch resultadosg' align='center'>RETEN REPER</td>
					<td colspan='2' class='BorderInf resultadosg' align='center'>TOT INGRESOS</td>
				</tr>
				<tr>
					<td colspan='2' class='BorderInfDch resultadosg' align='right'>".$sumaivaeg." €</td>
					<td colspan='2' class='BorderInfDch resultadosg' align='right'>".$sumareteg." €</td>
					<td colspan='2' class='BorderInf resultadosg' align='right'>".$sumapvptotg." €</td>
				</tr>
				<tr>
					<td colspan='6' class='BorderInf'>
					</td>
				</tr>
				<tr>
					<th class='BorderInfDch'>AÑO</th>		
					<th class='BorderInfDch'>MES</th>		
					<th class='BorderInfDch'>IVA REPER</th>
					<th class='BorderInfDch'>SUB TOT</th>
					<th class='BorderInfDch'>RET REPER</th>
					<th class='BorderInf'>TOTAL €</th>			
				</tr>");

	global $i;  $i = 1; 
    
	while($i <= 4){
    
        if($dm1 == 'TRI0'){
            if($mesIni < 10){ $mesIni = '0'.$mesIni; }else{ }
            if($mesFin < 10){ $mesFin = '0'.$mesFin; }else{ }
            $betwIni = $dyt1y.'/'.$mesIni.'/01';
            $betwFin = $dyt1y.'/'.$mesFin.'/31';
    
            global $MesNomb;
            if($mesFin < 4){ $MesNomb = "TRI1"; 
            }elseif($mesFin < 7){ $MesNomb = "TRI2"; 
            }elseif($mesFin < 10){ $MesNomb = "TRI3"; 
            }else{  $MesNomb = "TRI4"; }

			$rowg['factdate'] = $MesNomb;
        }
    
    $SqlFromg = "FROM $vnameg WHERE (`factdate` BETWEEN '$betwIni' AND '$betwFin')";
    $sqlSumIvag = "SELECT SUM(`factivae`) AS 'TriSumIvag' $SqlFromg";
    $qrySumIvag = mysqli_query($db, $sqlSumIvag);
    $SumIvag = mysqli_fetch_assoc($qrySumIvag);
    $TriSumIvag = $SumIvag['TriSumIvag'];
	$rowg['factivae'] = number_format($TriSumIvag ,2,".","");
    //if($TriSumIvag == ''){ $TriSumIvag = "0.00"; }else{ }

    $sqlSumSubg = "SELECT SUM(`factpvp`) AS 'TriSumSubTotg' $SqlFromg";
    $qrySumSubg = mysqli_query($db, $sqlSumSubg);
    $SumSubg = mysqli_fetch_assoc($qrySumSubg);
    $TriSumSubTotg = $SumSubg['TriSumSubTotg'];
	$rowg['factpvp'] = number_format($TriSumSubTotg ,2,".","");
    //if($TriSumSubTotg == ''){ $TriSumSubTotg = "0.00"; }else{ }

    $sqlSumReteg = "SELECT SUM(`factrete`) AS 'TriSumReteg' $SqlFromg";
    $qrySumReteg = mysqli_query($db, $sqlSumReteg);
    $SumReteg = mysqli_fetch_assoc($qrySumReteg);
    $TriSumReteg = $SumReteg['TriSumReteg'];
	$rowg['factrete']  = number_format($TriSumReteg ,2,".","");
    //if($TriSumReteg == ''){ $TriSumReteg ="0.00"; }else{ }

    $sqlSumTotg = "SELECT SUM(`factpvptot`) AS 'TriSumTotg' $SqlFromg";
    $qrySumTotg = mysqli_query($db, $sqlSumTotg);
    $SumTotg = mysqli_fetch_assoc($qrySumTotg);
    $TriSumTotg = $SumTotg['TriSumTotg'];
	$rowg['factpvptot']  = number_format($TriSumTotg ,2,".","");
    //if($TriSumTotg == ''){ $TriSumTotg = "0.00"; }else{ }
            
	global $dyt1;
	print (	"<tr align='center'>
								
	<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

		<input name='id' type='hidden' value='".@$rowg['id']."' />

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

        $i++;   $mesIni = $mesIni+3;    $mesFin = $mesFin+3;

    } /* Fin del while.*/ 

	print("</table>");

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

			////////////////////		**********  		////////////////////
								/* TABLA BALANCE DIFERENCIAL */
			////////////////////		**********  		////////////////////
		
    if($dm1 == 'TRI0'){
        $mesIni = 1;            $mesFin = 3;
	}

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
	//if($sumaivaed == ""){ $sumaivaed = "0.00"; }else{ }

    print ("<table class='tabla' >
			<tr>
				<th colspan=6 class='BorderInf resultadosd'>
					DIFERENCIA INGRESOS / GASTOS
				</th>
			</tr>
			<tr>
				<td colspan=6 class='BorderInf'>
					<div class='section'>
						<ul class='timeline'>");
	
		global $grd;	$grd = 1;

		while($grd<=4){

			if($dm1 == 'TRI0'){
				if($mesIniGrd < 10){ $mesIniGrd = '0'.$mesIniGrd; }else{ }
				if($mesFinGrd < 10){ $mesFinGrd = '0'.$mesFinGrd; }else{ }

				$betwIniGri = $dyt1y.'/'.$mesIniGrd.'/01';	$betwIniGrg = $dyt1y.'/'.$mesIniGrd.'/01';
				$betwFinGri = $dyt1y.'/'.$mesFinGrd.'/31';	$betwFinGrg = $dyt1y.'/'.$mesFinGrd.'/31';
		
				global $MesNombGrd;
				if($mesFinGrd < 4){ $MesNombGrd = "TRI1"; 
				}elseif($mesFinGrd < 7){ $MesNombGrd = "TRI2"; 
				}elseif($mesFinGrd < 10){ $MesNombGrd = "TRI3"; 
				}else{  $MesNombGrd = "TRI4"; }

				$rowd['factdate'] = $MesNombGrd;
			}
			
			
			$SqlFromgri = "FROM $vnamei WHERE (`factdate` BETWEEN '$betwIniGri' AND '$betwFinGri')";
			//echo $SqlFromgri."<br>";
			$sqlSumTotgri = "SELECT SUM(`factpvptot`) AS 'TriSumTotgri' $SqlFromgri";
			$qrySumTotgri = mysqli_query($db, $sqlSumTotgri);
			$SumTotgri = mysqli_fetch_assoc($qrySumTotgri);
			$TriSumTotgri = $SumTotgri['TriSumTotgri'];
			$rowgri['factpvptot']  = number_format($TriSumTotgri ,2,".","");
			//if($TriSumTotg == ''){ $TriSumTotg = "0.00"; }else{ }
			//echo $rowgri['factpvptot']."<br>";

			global $sumapvptoti;
			if($sumapvptoti > 0){
				$TotEi = ($rowi['factpvptot']*100)/$sumapvptoti;
			}else{ $TotEi = 0.00;}
			
			/*	*/
			$SqlFromgrg = "FROM $vnameg WHERE (`factdate` BETWEEN '$betwIniGrg' AND '$betwFinGrg')";
			//echo $SqlFromgrg."<br>";
			$sqlSumTotgrg = "SELECT SUM(`factpvptot`) AS 'TriSumTotgrg' $SqlFromgrg";
			$qrySumTotgrg = mysqli_query($db, $sqlSumTotgrg);
			$SumTotgrg = mysqli_fetch_assoc($qrySumTotgrg);
			$TriSumTotgrg = $SumTotgrg['TriSumTotgrg'];
			$rowgrg['factpvptot']  = number_format($TriSumTotgrg ,2,".","");
			//if($TriSumTotg == ''){ $TriSumTotg = "0.00"; }else{ }
			//echo $rowgrg['factpvptot']."<br>";
			/* */

			global $sumapvptotd;
			$calculo = $rowgri['factpvptot']  - $rowgrg['factpvptot'];
			$rowd['factpvptot'] = number_format($calculo ,2,".","");
			if($sumapvptotd > 0){
				$TotEd = ($rowd['factpvptot']*100)/$sumapvptotd;
			}else{ $TotEd = 0.00;}

			print("<li>
						<a href='#' title='".$rowd['factdate']." ".$rowd['factpvptot']." €'>
							<span class='label'>".$rowd['factdate']."<br>".$rowd['factpvptot']."</span>
							<span class='count bgcolord' style='height: ".$TotEd."%'>(".$TotEd.")</span>
						</a>
					</li>");

			$grd++;	$mesIniGrd = $mesIniGrd+3;    $mesFinGrd = $mesFinGrd+3;
		}

	print("	</ul>
				</div>
					</td>
			</tr>
			<tr>
				<td colspan='6' class='BorderInf'>
				</td>
			</tr>
			<tr>
				<td colspan='2' class='BorderInfDch resultadosd' align='center'>IMP REPER</td>
				<td colspan='2' class='BorderInfDch resultadosd' align='center'>RETEN REPER</td>
				<td colspan='2' class='BorderInf resultadosd' align='center'>TOT INGRESOS</td>
			</tr>
			<tr>
				<td colspan='2' class='BorderInfDch resultadosd' align='right'>".$sumaivaed." €</td>
				<td colspan='2' class='BorderInfDch resultadosd' align='right'>".$sumareted." €</td>
				<td colspan='2' class='BorderInf resultadosd' align='right'>".$sumapvptotd." €</td>
			</tr>
			<tr>
				<td colspan='6' class='BorderInf'>
				</td>
			</tr>
			<tr>
				<th class='BorderInfDch'>AÑO</th>		
				<th class='BorderInfDch'>MES</th>		
				<th class='BorderInfDch'>IVA REPER</th>
				<th class='BorderInfDch'>SUB TOT</th>
				<th class='BorderInfDch'>RET REPER</th>
				<th class='BorderInf'>TOTAL €</th>			
			</tr>");

    global $i;  $i = 1; 
    global $TriSumIvad;	global $TriSumSubTotd; global $TriSumReted; global $TriSumTotd;

	while($i <= 4){
    
        if($dm1 == 'TRI0'){
            if($mesIni < 10){ $mesIni = '0'.$mesIni; }else{ }
            if($mesFin < 10){ $mesFin = '0'.$mesFin; }else{ }
            $betwIni = $dyt1y.'/'.$mesIni.'/01';
            $betwFin = $dyt1y.'/'.$mesFin.'/31';
    
            global $MesNomb;
            if($mesFin < 4){ $MesNomb = "TRI1"; 
            }elseif($mesFin < 7){ $MesNomb = "TRI2"; 
            }elseif($mesFin < 10){ $MesNomb = "TRI3"; 
            }else{  $MesNomb = "TRI4"; }
        }

		/* CONSULTAS PARA INGRESOS */
		global $vnamei; global $SqlFromi;
		$SqlFromi = "FROM $vnamei WHERE (`factdate` BETWEEN '$betwIni' AND '$betwFin')";

		$sqlSumIva = "SELECT SUM(`factivae`) AS 'TriSumIvai' $SqlFromi";
		$qrySumIva = mysqli_query($db, $sqlSumIva);
		$SumIva = mysqli_fetch_assoc($qrySumIva);
		$TriSumIvai = $SumIva['TriSumIvai'];
		$TriSumIvai = number_format($TriSumIvai,2,".","");
		//if($TriSumIvai == ''){ $TriSumIvai = "0.00"; }else{ }
		
		$sqlSumSub = "SELECT SUM(`factpvp`) AS 'TriSumSubToti' $SqlFromi";
		$qrySumSub = mysqli_query($db, $sqlSumSub);
		$SumSub = mysqli_fetch_assoc($qrySumSub);
		$TriSumSubToti = $SumSub['TriSumSubToti'];
		$TriSumSubToti = number_format($TriSumSubToti,2,".","");
		//if($TriSumSubToti == ''){ $TriSumSubToti = "0.00"; }else{ }
	
		$sqlSumRete = "SELECT SUM(`factrete`) AS 'TriSumRetei' $SqlFromi";
		$qrySumRete = mysqli_query($db, $sqlSumRete);
		$SumRete = mysqli_fetch_assoc($qrySumRete);
		$TriSumRetei = $SumRete['TriSumRetei'];
		$TriSumRetei = number_format($TriSumRetei,2,".","");
		//if($TriSumRetei == ''){ $TriSumRetei ="0.00"; }else{ }
	
		$sqlSumTot = "SELECT SUM(`factpvptot`) AS 'TriSumToti' $SqlFromi";
		$qrySumTot = mysqli_query($db, $sqlSumTot);
		$SumTot = mysqli_fetch_assoc($qrySumTot);
		$TriSumToti = $SumTot['TriSumToti'];
		$TriSumToti= number_format($TriSumToti,2,".","");
		//if($TriSumToti == ''){ $TriSumToti = "0.00"; }else{ }

		/* CONSULTAS PARA GASTOS */
		global $vnameg; 	global $SqlFromg;
		$SqlFromg = "FROM $vnameg WHERE (`factdate` BETWEEN '$betwIni' AND '$betwFin')";
		
		$sqlSumIvag = "SELECT SUM(`factivae`) AS 'TriSumIvag' $SqlFromg";
		$qrySumIvag = mysqli_query($db, $sqlSumIvag);
		$SumIvag = mysqli_fetch_assoc($qrySumIvag);
		$TriSumIvag = $SumIvag['TriSumIvag'];
		$TriSumIvag = number_format($TriSumIvag,2,".","");
		//if($TriSumIvag == ''){ $TriSumIvag = "0.00"; }else{ }
	
		$sqlSumSubg = "SELECT SUM(`factpvp`) AS 'TriSumSubTotg' $SqlFromg";
		$qrySumSubg = mysqli_query($db, $sqlSumSubg);
		$SumSubg = mysqli_fetch_assoc($qrySumSubg);
		$TriSumSubTotg = $SumSubg['TriSumSubTotg'];
		$TriSumSubTotg = number_format($TriSumSubTotg,2,".","");
		//if($TriSumSubTotg == ''){ $TriSumSubTotg = "0.00"; }else{ }
	
		$sqlSumReteg = "SELECT SUM(`factrete`) AS 'TriSumReteg' $SqlFromg";
		$qrySumReteg = mysqli_query($db, $sqlSumReteg);
		$SumReteg = mysqli_fetch_assoc($qrySumReteg);
		$TriSumReteg = $SumReteg['TriSumReteg'];
		$TriSumReteg = number_format($TriSumReteg,2,".","");
		//if($TriSumReteg == ''){ $TriSumReteg ="0.00"; }else{ }
	
		$sqlSumTotg = "SELECT SUM(`factpvptot`) AS 'TriSumTotg' $SqlFromg";
		$qrySumTotg = mysqli_query($db, $sqlSumTotg);
		$SumTotg = mysqli_fetch_assoc($qrySumTotg);
		$TriSumTotg = $SumTotg['TriSumTotg'];
		$TriSumTotg = number_format($TriSumTotg,2,".","");
		//if($TriSumTotg == ''){ $TriSumTotg = "0.00"; }else{ }

		/* CALCULO DE LAS DIFERENCIAS */

	$TriSumIvad = $TriSumIvai - $TriSumIvag;
	$TriSumIvad = number_format($TriSumIvad,2,".","");

	$TriSumSubTotd = $TriSumSubToti - $TriSumSubTotg;
	$TriSumSubTotd= number_format($TriSumSubTotd,2,".","");

	$TriSumReted = $TriSumRetei - $TriSumReteg;
	$TriSumReted = number_format($TriSumReted,2,".","");

	$TriSumTotd = $TriSumToti - $TriSumTotg;
	$TriSumTotd = number_format($TriSumTotd,2,".","");

	global $dyt1;   global $MesNomb;
	//if($rowi['tot']!= 0.00){
	print (	"<tr align='center'>
								
	<form name='ver' action='Gastos_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=440px,height=670px')\">

					<td class='BorderInfDch' align='right'>
		<input name='year' type='hidden' value='".$dyt1."' />".$dyt1."
					</td>

					<td class='BorderInfDch' align='right'>
		<input name='mes' type='hidden' value='".$MesNomb."' />".$MesNomb."
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='iva' type='hidden' value='".$TriSumIvad."' />".$TriSumIvad." €
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='sub' type='hidden' value='".$TriSumSubTotd."' />".$TriSumSubTotd." €
					</td>
					
					<td class='BorderInfDch' align='right'>
		<input name='ret' type='hidden' value='".$TriSumReted."' />".$TriSumReted." €
					</td>
																		
					<td class='BorderInf' align='right'>
		<input name='tot' type='hidden' value='".$TriSumTotd."' />".$TriSumTotd." €
					</td>
		</form>
				</tr>");

        $i++;   $mesIni = $mesIni+3;    $mesFin = $mesFin+3;

    } /* Fin del while.*/ 

	print("</table>");

			////////////////////		***********  		////////////////////

	print("</div>");


?>