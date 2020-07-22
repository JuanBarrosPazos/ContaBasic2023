<?php
session_start();

//		ESTE SCRIPT FUNCIONA CON VARIABLES GLOBALES.

	//require '../Inclu/error_hidden.php';
	require_once ('../cbj_Balances/jpgraph/src/jpgraph.php');
	require_once ('../cbj_Balances/jpgraph/src/jpgraph_bar.php');

	require '../Conections/conection.php';
	require '../Conections/conect.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){
				
		if($_POST['grafico']){	a();
								process_form();
								info();				} 
				} else { require '../Inclu/table_permisos.php'; }

//////////////////////////////////////////////////////////////////////////////////////////////

function a(){	global $ruta;
				$ruta = "../cbj_Docs/grafics/";

				/////	DATOS DIARIOS TOTALES	//////
		
					global $GDTVT2;
					$GDTVT2 = $ruta."GDTVT2.php";
					global $file_GDTVT2;
					$file_GDTVT2 = file_get_contents($GDTVT2);
					$GDTVT2_a = explode(',',$file_GDTVT2);
					//$count = count($GMxT_a);
					//$rest = $count-1;
					//unset($GMxT_a[$rest]);
					//$_SESSION['GMxT'] = $GMxT_a;
					global $gt;
					$gt = $GDTVT2_a;
					
				}

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){

	global $coordenadax;

	global $ruta;
	global $gt;
	global $gd;
	
	global $mensaje;
	global $s1;
	$s1 = $_SESSION['ref'];
	$s1 = trim($s1);
	global $s2;
	$s2 = $_SESSION['usuarios'];
	$s2 = trim($s2);
	if($s2 == $s1){
		$mensaje = "\nGRAFICA PARA DEL USUARIO ".$_SESSION['ref'].".\n\n";}
	elseif($s2 != $s1){
		if($s2 == ''){$mensaje = "\nGRAFICA PARA DEL USUARIO ".$_SESSION['ref'].".\n\n";}
		else{$mensaje = "\nGRAFICA PARA DEL USUARIO ".$_SESSION['usuarios'].".\n\n";}
		}
	else{$mensaje = "\nGRAFICA PARA DEL USUARIO ".$_SESSION['ref'].".\n\n";}
	
	global $data;
	$data = $gt;
	
	$_SESSION['coor_x'] = $gd;		

	$gd = array(1,2,3,4,5,6,7,8,9,10,11,12);
	
	$graph = new Graph(1000,600,'auto');
	$graph->SetScale("textlin");
	
	$graph->SetShadow();
	$graph->img->SetMargin(40,30,40,40);
	
	$theme_class=new UniversalTheme;
	$graph->SetTheme($theme_class);
	$graph->img->SetAntiAliasing(true);
	
	$coordenadax = $gd;
	$graph->xaxis->SetTickLabels($coordenadax);
	//$graph->xgrid->SetColor('#E3E3E3');
	
	global $titulo;
	$titulo = 'GASTOS MENSUALES TOTALES '.$_SESSION['rsoc']." ".$_SESSION['gyear'];
	$titulo1 = $mensaje.$titulo;
	$graph->title->Set($titulo1);
	//$graph->SetBox(false);
	
	$graph->yaxis->HideZeroLabel();
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);
	
	$bplot1 = new BarPlot($data);
	$graph->Add($bplot1);
	$bplot1->SetFillColor("#01DFD7");
	$bplot1->SetColor("#01DFD7");
	$bplot1->SetLegend($titulo);
	
	//$bplot1->SetShadow();
	
	$graph->legend->SetFrameWeight(1);
	
	$graph->Stroke();	
		
		}

/////////////////////////////////////////////////////////////////////////////////////////////////

function info(){

	global $db;
	global $titulo;
	global $gd;
	global $data;

	global $mensaje;
	if($_SESSION['usuarios'] == ''){
		$mensaje = "\USUARIO ".$_SESSION['ref'].". ";}
	elseif($_SESSION['usuarios'] != ''){
		$mensaje = "USUARIO ".$_SESSION['usuarios'].". ";}

	$ActionTime = date('H:i:s');

	global $dir;
	if ($_SESSION['Nivel'] == 'admin'){ 
				$dir = "../cbj_Docs/log";
				}
	
	global $text;
$text = "- GASTOS CONSULTA GRAFICA BARRAS.\n\t".$mensaje.$ActionTime.".\n\t* ".$titulo.".\n\tORDENADA X\n\t".implode(", ",$gd)."\n\tDATOS\n\t".implode(", ",$data);

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text."\n";
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

/////////////////////////////////////////////////////////////////////////////////////////////////
	
		
?>