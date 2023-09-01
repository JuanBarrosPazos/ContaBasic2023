<?php

    global $AddBlackTit;    global $DetalleGreyTit;   global $DetalleBlackTit;     
    		

    global $KeyForm;    global $link1;      global $link2;      global $link3;
    if($KeyForm == "pend"){
        $AddBlackTit = "CREAR NUEVO GASTO PENDIENTE";
        $link1 = "Gastos_Pendientes_Crear.php";
        $DetalleGreyTit = "VER TODOS GASTOS PENDIENTES";
        $link2 = "Gastos_Pendientes_Ver.php";
        $DetalleBlackTit = "VER TODOS GASTOS";
        $link3 = "Gastos_Ver.php";
    }else{
        $AddBlackTit = "CREAR NUEVO GASTO";
        $link1 = "Gastos_Crear.php";
        $DetalleGreyTit = "VER TODOS GASTOS";
        $link2 = "Gastos_Ver.php";
        $DetalleBlackTit = "VER TODOS GASTOS PENDIENTES";
        $link3 = "Gastos_Pendientes_Ver.php";
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
                        ".$DetalleGrey."
							<a href='".$link2."' >&nbsp;&nbsp;&nbsp;&nbsp</a>
						".$closeButton.$AddBlack."
							<a href='".$link1."' >&nbsp;&nbsp;&nbsp;&nbsp</a>
						".$closeButton.$DetalleBlack."
                            <a href='".$link3."' >&nbsp;&nbsp;&nbsp;&nbsp</a>
                        ".$closeButton."
                    </th>
                </tr>
            </table>");

?>