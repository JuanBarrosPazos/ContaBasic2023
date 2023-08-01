<?php

	global $db;         global $cero_conection;
    global $keyIndex;   global $keyBlog;

    mysqli_report(MYSQLI_REPORT_OFF);
    $db = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    if (!$db){ 
        /*die*/ 
        echo ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
            }
?>