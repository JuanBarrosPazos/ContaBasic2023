<?php

    $dir = "../cb23_Docs/log";

    $logdocu = $_SESSION['ref'];
    $logdate = date('Y-m-d');
    $logtext = $text."\n";
    $filename = $dir."/".$logdate."_".$logdocu.".log";
    $log = fopen($filename, 'ab+');
    fwrite($log, $logtext);
    fclose($log);

?>