<?php

	global $ruta;
	$ruta = "../cbj_Docs/grafics/";
	

			///// DATOS ANUALES, LOS AÑOS Y LOS MESES //////
					global $G_ANHOS;
					$G_ANHOS = $ruta."G_ANHOS.php";
					global $file_G_ANHOS;
					$file_G_ANHOS = file_get_contents($G_ANHOS);
					$G_ANHOS_a = explode(',',$file_G_ANHOS);
					$count = count($G_ANHOS_a);
					$rest = $count-1;
					unset($G_ANHOS_a[$rest]);
					//$_SESSION['G_ANHOS'] = $G_ANHOS_a;
					//$_SESSION['G_ANHOS_f'] = implode(', ',$G_ANHOS_a);
					global $g_anhos;
					$g_anhos = $G_ANHOS_a;
					global $g_anhos_f;
					$g_anhos_f = implode(', ',$G_ANHOS_a);
					
					global $G_MESESb;
					$G_MESESb = $ruta."G_MESESb.php";
					$file_G_MESESb = file_get_contents($G_MESESb);
					$G_MESESb_a = explode(',',$file_G_MESESb);
					//$_SESSION['G_MESESb'] = $G_MESESb_a;
					global $g_mesesb;
					$g_mesesb = $G_MESESb_a;
					
				///// DATOS MESUALES X AÑO & TODOS LOS AÑOS //////
			
					global $G_M_I;
					$G_M_I = $ruta."G_M_I.php";
					$file_i = file_get_contents($G_M_I);
					$G_M_I_a = explode(',',$file_i);
					$count = count($G_M_I_a);
					$rest = $count-1;
					unset($G_M_I_a[$rest]);
					//$_SESSION['G_M_I'] = $G_M_I_a;
					global $gmi;
					$gmi = $G_M_I_a;
				
					global $G_M_G;
					$G_M_G = $ruta."G_M_G.php";
					$file_g = file_get_contents($G_M_G);
					$G_M_G_a = explode(',',$file_g);
					$count = count($G_M_G_a);
					$rest = $count-1;
					unset($G_M_G_a[$rest]);
					//$_SESSION['G_M_G'] = $G_M_G_a;
					global $gmg;
					$gmg =  $G_M_G_a;
					
					global $G_M_D;
					$G_M_D = $ruta."G_M_D.php";
					$file_d = file_get_contents($G_M_D);
					$G_M_D_a = explode(',',$file_d);
					$count = count($G_M_D_a);
					$rest = $count-1;
					unset($G_M_D_a[$rest]);
					//$_SESSION['G_M_D'] = $G_M_D_a;
					global $gmd;
					$gmd = $G_M_D_a;
			
				///// DATOS TRIMESTRALES X AÑO & TODOS LOS AÑOS //////
			
					global $G_TRI0_I;
					$G_TRI0_I = $ruta."G_TRI0_I.php";
					$file_i = file_get_contents($G_TRI0_I);
					$G_TRI0_I_a = explode(',',$file_i);
					$count = count($G_TRI0_I_a);
					$rest = $count-1;
					unset($G_TRI0_I_a[$rest]);
					//$_SESSION['G_TRI0_I'] = $G_TRI0_I_a;
					global $gtri0i;
					$gtri0i = $G_TRI0_I_a;
				
					global $G_TRI0_G;
					$G_TRI0_G = $ruta."G_TRI0_G.php";
					$file_g = file_get_contents($G_TRI0_G);
					$G_TRI0_G_a = explode(',',$file_g);
					$count = count($G_TRI0_G_a);
					$rest = $count-1;
					unset($G_TRI0_G_a[$rest]);
					//$_SESSION['G_TRI0_G'] = $G_TRI0_G_a;
					global $gtri0g;
					$gtri0g = $G_TRI0_G_a;
					
					global $G_TRI0_D;
					$G_TRI0_D = $ruta."G_TRI0_D.php";
					$file_d = file_get_contents($G_TRI0_D);
					$G_TRI0_D_a = explode(',',$file_d);
					$count = count($G_TRI0_D_a);
					$rest = $count-1;
					unset($G_TRI0_D_a[$rest]);
					//$_SESSION['G_TRI0_D'] = $G_TRI0_D_a;
					global $gtri0d;
					$gtri0d = $G_TRI0_D_a;
			
				///// DATOS TRIME 1 TODOS LOS AÑOS //////
			
					global $G_TRI1_I;
					$G_TRI1_I = $ruta."G_TRI1_I.php";
					$file_i = file_get_contents($G_TRI1_I);
					$G_TRI1_I_a = explode(',',$file_i);
					$count = count($G_TRI1_I_a);
					$rest = $count-1;
					unset($G_TRI1_I_a[$rest]);
					//$_SESSION['G_TRI1_I'] = $G_TRI1_I_a;
					global $gtri1i;
					$gtri1i = $G_TRI1_I_a;
				
					global $G_TRI1_G;
					$G_TRI1_G = $ruta."G_TRI1_G.php";
					$file_g = file_get_contents($G_TRI1_G);
					$G_TRI1_G_a = explode(',',$file_g);
					$count = count($G_TRI1_G_a);
					$rest = $count-1;
					unset($G_TRI1_G_a[$rest]);
					//$_SESSION['G_TRI1_G'] = $G_TRI1_G_a;
					global $gtri1g;
					$gtri1g = $G_TRI1_G_a;
					
					global $G_TRI1_D;
					$G_TRI1_D = $ruta."G_TRI1_D.php";
					$file_d = file_get_contents($G_TRI1_D);
					$G_TRI1_D_a = explode(',',$file_d);
					$count = count($G_TRI1_D_a);
					$rest = $count-1;
					unset($G_TRI1_D_a[$rest]);
					//$_SESSION['G_TRI1_D'] = $G_TRI1_D_a;
					global $gtri1d;
					$gtri1d = $G_TRI1_D_a;
			
				///// DATOS TRIME 2 TODOS LOS AÑOS //////
			
					global $G_TRI2_I;
					$G_TRI2_I = $ruta."G_TRI2_I.php";
					$file_i = file_get_contents($G_TRI2_I);
					$G_TRI2_I_a = explode(',',$file_i);
					$count = count($G_TRI2_I_a);
					$rest = $count-1;
					unset($G_TRI2_I_a[$rest]);
					//$_SESSION['G_TRI2_I'] = $G_TRI2_I_a;
					global $gtri2i;
					$gtri2i = $G_TRI2_I_a;
				
					global $G_TRI2_G;
					$G_TRI2_G = $ruta."G_TRI2_G.php";
					$file_g = file_get_contents($G_TRI2_G);
					$G_TRI2_G_a = explode(',',$file_g);
					$count = count($G_TRI2_G_a);
					$rest = $count-1;
					unset($G_TRI2_G_a[$rest]);
					//$_SESSION['G_TRI2_G'] = $G_TRI2_G_a;
					global $gtri2g;
					$gtri2g = $G_TRI2_G_a;
					
					global $G_TRI2_D;
					$G_TRI2_D = $ruta."G_TRI2_D.php";
					$file_d = file_get_contents($G_TRI2_D);
					$G_TRI2_D_a = explode(',',$file_d);
					$count = count($G_TRI2_D_a);
					$rest = $count-1;
					unset($G_TRI2_D_a[$rest]);
					//$_SESSION['G_TRI2_D'] = $G_TRI2_D_a;
					global $gtri2d;
					$gtri2d = $G_TRI2_D_a;
			
				///// DATOS TRIME 3 TODOS LOS AÑOS //////
			
					global $G_TRI3_I;
					$G_TRI3_I = $ruta."G_TRI3_I.php";
					$file_i = file_get_contents($G_TRI3_I);
					$G_TRI3_I_a = explode(',',$file_i);
					$count = count($G_TRI3_I_a);
					$rest = $count-1;
					unset($G_TRI3_I_a[$rest]);
					//$_SESSION['G_TRI3_I'] = $G_TRI3_I_a;
					global $gtri3i;
					$gtri3i = $G_TRI3_I_a;
				
					global $G_TRI3_G;
					$G_TRI3_G = $ruta."G_TRI3_G.php";
					$file_g = file_get_contents($G_TRI3_G);
					$G_TRI3_G_a = explode(',',$file_g);
					$count = count($G_TRI3_G_a);
					$rest = $count-1;
					unset($G_TRI3_G_a[$rest]);
					//$_SESSION['G_TRI3_G'] = $G_TRI3_G_a;
					global $gtri3g;
					$gtri3g = $G_TRI3_G_a;
					
					global $G_TRI3_D;
					$G_TRI3_D = $ruta."G_TRI3_D.php";
					$file_d = file_get_contents($G_TRI3_D);
					$G_TRI3_D_a = explode(',',$file_d);
					$count = count($G_TRI3_D_a);
					$rest = $count-1;
					unset($G_TRI3_D_a[$rest]);
					//$_SESSION['G_TRI3_D'] = $G_TRI3_D_a;
					global $gtri3d;
					$gtri3d = $G_TRI3_D_a;
			
				///// DATOS TRIME 4 TODOS LOS AÑOS //////
			
					global $G_TRI4_I;
					$G_TRI4_I = $ruta."G_TRI4_I.php";
					$file_i = file_get_contents($G_TRI4_I);
					$G_TRI4_I_a = explode(',',$file_i);
					$count = count($G_TRI4_I_a);
					$rest = $count-1;
					unset($G_TRI4_I_a[$rest]);
					//$_SESSION['G_TRI4_I'] = $G_TRI4_I_a;
					global $gtri4i;
					$gtri4i = $G_TRI4_I_a;
				
					global $G_TRI4_G;
					$G_TRI4_G = $ruta."G_TRI4_G.php";
					$file_g = file_get_contents($G_TRI4_G);
					$G_TRI4_G_a = explode(',',$file_g);
					$count = count($G_TRI4_G_a);
					$rest = $count-1;
					unset($G_TRI4_G_a[$rest]);
					//$_SESSION['G_TRI4_G'] = $G_TRI4_G_a;
					global $gtri4g;
					$gtri4g = $G_TRI4_G_a;
					
					global $G_TRI4_D;
					$G_TRI4_D = $ruta."G_TRI4_D.php";
					$file_d = file_get_contents($G_TRI4_D);
					$G_TRI4_D_a = explode(',',$file_d);
					$count = count($G_TRI4_D_a);
					$rest = $count-1;
					unset($G_TRI4_D_a[$rest]);
					//$_SESSION['G_TRI4_D'] = $G_TRI4_D_a;
					global $gtri4d;
					$gtri4d = $G_TRI4_D_a;
			
				///// DATOS ANUAL TODOS LOS AÑOS //////
			
					global $G_ANU_I;
					$G_ANU_I = $ruta."G_ANU_I.php";
					$file_i = file_get_contents($G_ANU_I);
					$G_ANU_I_a = explode(',',$file_i);
					$count = count($G_ANU_I_a);
					$rest = $count-1;
					unset($G_ANU_I_a[$rest]);
					//$_SESSION['G_ANU_I'] = $G_ANU_I_a;
					global $ganui;
					$ganui = $G_ANU_I_a;
				
					global $G_ANU_G;
					$G_ANU_G = $ruta."G_ANU_G.php";
					$file_g = file_get_contents($G_ANU_G);
					$G_ANU_G_a = explode(',',$file_g);
					$count = count($G_ANU_G_a);
					$rest = $count-1;
					unset($G_ANU_G_a[$rest]);
					//$_SESSION['G_ANU_G'] = $G_ANU_G_a;
					global $ganug;
					$ganug = $G_ANU_G_a;
					
					global $G_ANU_D;
					$G_ANU_D = $ruta."G_ANU_D.php";
					$file_d = file_get_contents($G_ANU_D);
					$G_ANU_D_a = explode(',',$file_d);
					$count = count($G_ANU_D_a);
					$rest = $count-1;
					unset($G_ANU_D_a[$rest]);
					//$_SESSION['G_ANU_D'] = $G_ANU_D_a;
					global $ganud;
					$ganud = $G_ANU_D_a;
			
				///// DATOS MENSUALES TODOS LOS AÑOS //////

					global $mes;
					$mes = substr($_SESSION['gtime'],-2);
					global $file_i;
					$file_i = "G_M".$mes."_I.php";
					global $file_g;
					$file_g = "G_M".$mes."_G.php";
					global $file_d;
					$file_d = "G_M".$mes."_D.php";

					global $G_MES_I;
					$G_MES_I = $ruta.$file_i;
					$file_i = file_get_contents($G_MES_I);
					$G_MES_I_a = explode(',',$file_i);
					$count = count($G_MES_I_a);
					$rest = $count-1;
					unset($G_MES_I_a[$rest]);
					//$_SESSION['G_MES_I'] = $G_MES_I_a;
					global $gmesi;
					$gmesi = $G_MES_I_a;
				
					global $G_MES_G;
					$G_MES_G = $ruta.$file_g;
					$file_g = file_get_contents($G_MES_G);
					$G_MES_G_a = explode(',',$file_g);
					$count = count($G_MES_G_a);
					$rest = $count-1;
					unset($G_MES_G_a[$rest]);
					//$_SESSION['G_MES_G'] = $G_MES_G_a;
					global $gmesg;
					$gmesg = $G_MES_G_a;
					
					global $G_MES_D;
					$G_MES_D = $ruta.$file_d;
					$file_d = file_get_contents($G_MES_D);
					$G_MES_D_a = explode(',',$file_d);
					$count = count($G_MES_D_a);
					$rest = $count-1;
					unset($G_MES_D_a[$rest]);
					//$_SESSION['G_MES_D'] = $G_MES_D_a;
					global $gmesd;
					$gmesd = $G_MES_D_a;

	global $coordenadax;

	global $ruta;
	global $file_G_ANHOS;
	
	global $g_anhos;	global $g_anhos_f;	global $g_meses;	global $g_mesesb;
	global $gmi;		global $gmg;		global $gmd;		
	global $gtri0i;		global $gtri0g;		global $gtri0d;	
	global $gtri1i;		global $gtri1g;		global $gtri1d;
	global $gtri2i;		global $gtri2g;		global $gtri2d;
	global $gtri3i;		global $gtri3g;		global $gtri3d;		
	global $gtri4i;		global $gtri4g;		global $gtri4d;	
	global $ganui;		global $ganug;		global $ganud;		
	global $gmesi;		global $gmesg;		global $gmesd;

	global $datai;		global $datag;		global $datad;
		
$timemes = substr($_SESSION['gtime'],-2);
if ($timemes == '01'){$timemes = 'ENERO';}
elseif ($timemes == '02'){$timemes = 'FEBRERO';}
elseif ($timemes == '03'){$timemes = 'MARZO';}
elseif ($timemes == '04'){$timemes = 'ABRIL';}
elseif ($timemes == '05'){$timemes = 'MAYO';}
elseif ($timemes == '06'){$timemes = 'JUNIO';}
elseif ($timemes == '07'){$timemes = 'JULIO';}
elseif ($timemes == '08'){$timemes = 'AGOSTO';}
elseif ($timemes == '09'){$timemes = 'SEPTIEMBRE';}
elseif ($timemes == '10'){$timemes = 'OCTUBRE';}
elseif ($timemes == '11'){$timemes = 'NOVIEMBRE';}
elseif ($timemes == '12'){$timemes = 'DICIEMBRE';}

if($_SESSION['gyear'] == 'XXX'){
					$timeanho = " AÑOS. ".$g_anhos_f;
	}
else{	global $timeanho;
					$timeanho = " 20".$_SESSION['gyear'];}

if($_SESSION['gtime'] == "TRI0"){ 
					$titulo = 'TRIMESTRAL '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri0i;
		$datag = $gtri0g;
		$datad = $gtri0d;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_x'] = array('TR_01','TR_02','TR_03','TR_04');		
		$_SESSION['coor_xb'] = array('TR_01','TR_02','TR_03','TR_04');		
		$datai = $gtri0i;
		$datag = $gtri0g;
		$datad = $gtri0d;
		}
	}
elseif($_SESSION['gtime'] == "TRI1"){ 
					$titulo = 'TRIMESTRE 01 '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri1i;
		$datag = $gtri1g;
		$datad = $gtri1d;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri1i;
		$datag = $gtri1g;
		$datad = $gtri1d;
		}
	}
elseif($_SESSION['gtime'] == "TRI2"){ 
					$titulo = 'TRIMESTRE 02 '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri2i;
		$datag = $gtri2g;
		$datad = $gtri2d;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri2i;
		$datag = $gtri2g;
		$datad = $gtri2d;
		}
	}
elseif($_SESSION['gtime'] == "TRI3"){ 
					$titulo = 'TRIMESTRE 03 '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri3i;
		$datag = $gtri3g;;
		$datad = $gtri3d;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri3i;
		$datag = $gtri3g;;
		$datad = $gtri3d;
		}
	}
elseif($_SESSION['gtime'] == "TRI4"){ 
					$titulo = 'TRIMESTRE 04 '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri4i;
		$datag = $gtri4g;
		$datad = $gtri4d;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gtri4i;
		$datag = $gtri4g;
		$datad = $gtri4d;
		}
	}
elseif($_SESSION['gtime'] == "ANU"){ 
					$titulo = 'ANUAL '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $ganui;
		$datag = $ganug;
		$datad = $ganud;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $ganui;
		$datag = $ganug;
		$datad = $ganud;
		}
	}

elseif($_SESSION['gtime'] == "M"){ 
					$titulo = 'MENSUAL '.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gmi;
		$datag = $gmg;
		$datad = $gmd;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
$_SESSION['coor_x'] = array('ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');		
$_SESSION['coor_xb'] = array('ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');		
		$datai = $gmi;
		$datag = $gmg;
		$datad = $gmd;
		}
	}
	
else{ $titulo = 'MES '.$timemes.$timeanho;
	if($_SESSION['gyear'] == 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gmesi;
		$datag = $gmesg;
		$datad = $gmesd;
		}
	elseif($_SESSION['gyear'] != 'XXX'){
		$_SESSION['coor_xb'] = $g_mesesb;
		$datai = $gmesi;
		$datag = $gmesg;
		$datad = $gmesd;
		}
	}

	global $titulo1;
	$titulo1 = "CONSUTAL BALANCE ".$titulo;
	
	global $coordenadax;
	$coordenadax = @$_SESSION['coor_x'];
	
?>