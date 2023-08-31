<?php

    print ("<tr class='".$styleBgc."'>
    <form name='ver' action='Gastos_Pendientes_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=580px,height=660px')\">
        <input name='dyt1' type='hidden' value='".$dyt1."' />
        <input name='vname' type='hidden' value='".$vname."' />
                <td align='center'>
        <input name='id' type='hidden' value='".$rowb['id']."' />".$rowb['id']."
                </td>
                <td align='center'>
        <input name='factnum' type='hidden' value='".$rowb['factnum']."' />".$rowb['factnum']."
                </td>
                <td align='left'>
        <input name='factdate' type='hidden' value='".$rowb['factdate']."' />".$rowb['factdate']."
                </td>
                <td align='center'>
        <input name='factnom' type='hidden' value='".$rowb['factnom']."' />".$rowb['factnom']."
                </td>
                <td align='left'>
        <input name='factnif' type='hidden' value='".$rowb['factnif']."' />".$rowb['factnif']."
                </td>
                <td align='right'>
        <input name='factiva' type='hidden' value='".$rowb['factiva']."' />".$rowb['factiva']."
                </td>
                <td align='right'>
        <input name='factivae' type='hidden' value='".$rowb['factivae']."' />".$rowb['factivae']."
                </td>
                <td align='right'>
        <input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />".$rowb['factpvp']."
                </td>
                <td align='right'>
        <input name='factret' type='hidden' value='".$rowb['factret']."' />".$rowb['factret']."
                </td>
                <td align='right'>
        <input name='factrete' type='hidden' value='".$rowb['factrete']."' />".$rowb['factrete']."
                </td>
                <td align='right'>
        <input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />".$rowb['factpvptot']."
                </td>
        <input name='coment' type='hidden' value='".$rowb['coment']."' />
                <td>
            <input type='submit' value='VER DETALLES' title='VER DETALLES FACTURA' class='botonverde' />
            <input type='hidden' name='oculto2' value=1 />
    </form>
                </td>
                <td>			
    <form name='ver' action='Gastos_Pendientes_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=580px,height=600px')\">
                <input name='id' type='hidden' value='".$rowb['id']."' />
                <input name='dyt1' type='hidden' value='".$dyt1."' />
                <input name='vname' type='hidden' value='".$vname."' />
                <input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
                <input name='coment' type='hidden' value='".$rowb['coment']."' />
                <input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
                <input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
                <input name='factivae' type='hidden' value='".$rowb['factivae']."' />
                <input name='factiva' type='hidden' value='".$rowb['factiva']."' />
                <input name='factret' type='hidden' value='".$rowb['factret']."' />
                <input name='factrete' type='hidden' value='".$rowb['factrete']."' />
                <input name='factnif' type='hidden' value='".$rowb['factnif']."' />
                <input name='factnom' type='hidden' value='".$rowb['factnom']."' />
                <input name='factdate' type='hidden' value='".$rowb['factdate']."' />
                <input name='factnum' type='hidden' value='".$rowb['factnum']."' />
                <input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
                <input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
                <input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
                <input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
                        <input type='submit' value='MODIF DOCS' title='MODIFICAR DOCUMENTOS ASOCIADOS' class='botonnaranja' />
                        <input type='hidden' name='oculto2' value=1 />
        </form>						
                </td>
                <td>
        <form name='modifica' action='Gastos_Pendientes_Modificar_02.php' method='POST'>
                <input name='dyt1' type='hidden' value='".$dyt1."' />
                <input name='vname' type='hidden' value='".$vname."' />
                <input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
                <input name='id' type='hidden' value='".$rowb['id']."' />
                <input name='factnum' type='hidden' value='".$rowb['factnum']."' />
                <input name='factdate' type='hidden' value='".$rowb['factdate']."' />
                <input name='factnom' type='hidden' value='".$rowb['factnom']."' />
                <input name='factnif' type='hidden' value='".$rowb['factnif']."' />
                <input name='factiva' type='hidden' value='".$rowb['factiva']."' />
                <input name='factivae' type='hidden' value='".$rowb['factivae']."' />
                <input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
                <input name='factret' type='hidden' value='".$rowb['factret']."' />
                <input name='factrete' type='hidden' value='".$rowb['factrete']."' />
                <input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
                <input name='coment' type='hidden' value='".$rowb['coment']."' />
                <input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
                <input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
                <input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
                <input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
                        <input type='submit' value='MODIF DATOS' title='MOFIFICAR DATOS FACTURA' class='botonnaranja' />
                        <input type='hidden' name='oculto2' value=1 />
         </form>
                </td>
                <td>
        <form name='modifica' action='Gastos_Pendientes_Modificar_03.php' method='POST' >
                <input name='id' type='hidden' value='".$rowb['id']."' />
                <input name='dyt1' type='hidden' value='".$dyt1."' />
                <input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
                <input name='coment' type='hidden' value='".$rowb['coment']."' />
                <input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
                <input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
                <input name='factivae' type='hidden' value='".$rowb['factivae']."' />
                <input name='factiva' type='hidden' value='".$rowb['factiva']."' />
                <input name='factrete' type='hidden' value='".$rowb['factrete']."' />
                <input name='factret' type='hidden' value='".$rowb['factret']."' />
                <input name='factnif' type='hidden' value='".$rowb['factnif']."' />
                <input name='factnom' type='hidden' value='".$rowb['factnom']."' />
                <input name='factdate' type='hidden' value='".$rowb['factdate']."' />
                <input name='factnum' type='hidden' value='".$rowb['factnum']."' />
                <input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
                <input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
                <input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
                <input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
                        <input type='submit' value='PAGADA' title='FACTURA PAGADA' class='botonazul' />
                        <input type='hidden' name='oculto2' value=1 />
        </form>		
                </td>
    		<td>
	<form name='modifica' action='Gastos_Pendientes_Borrar_02.php' method='POST'>
                <input name='dyt1' type='hidden' value='".$dyt1."' />
                <input name='refprovee' type='hidden' value='".$rowb['refprovee']."' />
                <input name='id' type='hidden' value='".$rowb['id']."' />
                <input name='factnum' type='hidden' value='".$rowb['factnum']."' />
                <input name='factdate' type='hidden' value='".$rowb['factdate']."' />
                <input name='factnom' type='hidden' value='".$rowb['factnom']."' />
                <input name='factnif' type='hidden' value='".$rowb['factnif']."' />
                <input name='factiva' type='hidden' value='".$rowb['factiva']."' />
                <input name='factivae' type='hidden' value='".$rowb['factivae']."' />
                <input name='factpvp' type='hidden' value='".$rowb['factpvp']."' />
                <input name='factret' type='hidden' value='".$rowb['factret']."' />
                <input name='factrete' type='hidden' value='".$rowb['factrete']."' />
                <input name='factpvptot' type='hidden' value='".$rowb['factpvptot']."' />
                <input name='coment' type='hidden' value='".$rowb['coment']."' />
                <input name='myimg1' type='hidden' value='".$rowb['myimg1']."' />
                <input name='myimg2' type='hidden' value='".$rowb['myimg2']."' />
                <input name='myimg3' type='hidden' value='".$rowb['myimg3']."' />
                <input name='myimg4' type='hidden' value='".$rowb['myimg4']."' />
                        <!--
                        <input type='submit' value='BORRAR DATOS' />
                        -->
                        <button type='submit' title='BORRAR FACTURA' class='botonrojo imgButIco DeleteWhite'>
                        </button>
                        <input type='hidden' name='oculto2' value=1 />
        </form>
                </td>
            </tr>");

?>