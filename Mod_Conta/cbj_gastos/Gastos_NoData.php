<?php

    global $AddBlackTit;    global $MoneypWhiteTit;   global $MoneypGreyTit;     
    		
    global $KeyForm;    global $link1;      global $link2;      global $link3;
    if($KeyForm == "pend"){
        $AddBlackTit = "CREAR NUEVO GASTO PENDIENTE";
        $link1 = "Gastos_Pendientes_Crear.php";
        $MoneypWhiteTit = "VER TODOS GASTOS PENDIENTES";
        $link2 = "Gastos_Pendientes_Ver.php";
        $MoneypGreyTit = "VER TODOS GASTOS";
        $link3 = "Gastos_Ver.php";
    }else{
        $AddBlackTit = "CREAR NUEVO GASTO";
        $link1 = "Gastos_Crear.php";
        $MoneypWhiteTit = "VER TODOS GASTOS PENDIENTES";
        $link2 = "Gastos_Pendientes_Ver.php";
        $MoneypGreyTit = "VER TODOS GASTOS";
        $link3 = "Gastos_Ver.php";
    }

    require '../Inclu/BotoneraVar.php';
    global $closeButton;

    global $titNoData;

    print ("<table class='tableForm' >
                <tr>
                    <th>
                        ".$titNoData."
                        <font color='#FF0000'>NO HAY DATOS</font>
                    </th>
                </tr>
                <tr>
                    <th>
                        ".$MoneypWhite."
							<a href='".$link2."' >&nbsp;&nbsp;&nbsp;&nbsp</a>
						".$closeButton.$AddBlack."
							<a href='".$link1."' >&nbsp;&nbsp;&nbsp;&nbsp</a>
						".$closeButton.$MoneypGrey."
                            <a href='".$link3."' >&nbsp;&nbsp;&nbsp;&nbsp</a>
                        ".$closeButton."
                    </th>
                </tr>
            </table>");

?>