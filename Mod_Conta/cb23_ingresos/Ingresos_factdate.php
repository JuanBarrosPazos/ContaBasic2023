<?php

    if(@$_POST['dy'] == ''){ $dy1 = '';
                            $dyt1 = date('Y');	
                            $_SESSION['gyear'] = date('Y');
    }else{ $dy1 = $_POST['dy'];
            $dyt1 = "20".$_POST['dy'];
            $_SESSION['gyear'] = "20".$_POST['dy'];	
             }
    if(@$_POST['dm'] == ''){ $dm1 = '';
                            $_SESSION['gtime'] = '';
    }else{  $dm1 = "/".$_POST['dm']."/";
            $_SESSION['gtime'] = $_POST['dm'];

        }
    if(@$_POST['dd'] == ''){ $dd1 = '';

    }else{  $dd1 = $_POST['dd'];
             }

    // print("* ".$dy1.$dm1.$dd1.". TU PUTA MADRE");

    global $factdate;
    $factdate = @$_POST['dy']."/".@$_POST['dm']."/".@$_POST['dd'];

    global $fil;
	$fil = "%".$dy1.$dm1.$dd1."%";
	if ((@$_POST['dm'] == '')&&(@$_POST['dd'] != '')){$dm1 = '';
													$dd1 = $_POST['dd'];
													global $fil;
													$fil = "%".$dy1."/%".$dm1."%/".$dd1."%";
																					}

?>