<?php

        global $DeleteBlackTit;         $DeleteBlackTit = "INICIO PAPELERA CLIENTES";
        global $PersonAddBlacktit;      $PersonAddBlacktit = "CREAR NUEVO CLIENTE";
        global $PersonsBlackTit;        $PersonsBlackTit = "VER TODOS LOS CLIENTES";
        require '../Inclu/BotoneraVar.php';
        global $closeButton;

	global $KeyForm;        global $BotonPapelera;   global $tituloLoc;

	if($KeyForm == "feed"){
                $BotonPapelera = "";
                $tituloLoc = "PAPELERA CLIENTES<br><br>";
	}else{
                $BotonPapelera = $DeleteBlack."<a href='clientesFeed_Ver.php' >&nbsp;&nbsp;&nbsp;</a>".$closeButton;
                $tituloLoc = "CLIENTES<br><br>";
	}	

        print ("<table class='tableForm' style='padding:0.6em;' >
                <tr>
                        <th>
                                ".$tituloLoc."
                                <font color='#FF0000'>NO HAY DATOS</font>
                        </th>
                </tr>
                <tr>
                        <th>
                                ".$PersonAddBlack."
                                        <a href='clientes_Crear.php' >&nbsp;&nbsp;&nbsp;</a>
                                ".$closeButton.$PersonsBlack."
                        <a href='clientes_Ver.php' >&nbsp;&nbsp;&nbsp;</a>
                                ".$closeButton.$BotonPapelera."
                        </th>
                </tr>
        </table>");

?>