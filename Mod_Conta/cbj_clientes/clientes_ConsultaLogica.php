<?php

	// RAZON SOCIAL
    if($_POST['rsocial'] == ''){$rso = 'ññ';}
    else{$rso = "%".$_POST['rsocial']."%";}
    global $rsocial; 		$rsocial = $_POST['rsocial'];
	// NIF
    if($_POST['dni'] == ''){$dni = 'ññ';}
    else{$dni = $_POST['dni'];}
    global $dnie; 		$dnie = $_POST['dni'];
	// REF CLIENTE
    if($_POST['ref'] == ''){$ref = 'ññ';}
    else{$ref = $_POST['ref'];}
    global $refer; 		$refer = $_POST['ref'];
    // ORDEN
    global $orden;
    if(isset($_POST['Orden'])){
        $orden = $_POST['Orden'];
    }else{ $orden = '`id` ASC'; }


?>