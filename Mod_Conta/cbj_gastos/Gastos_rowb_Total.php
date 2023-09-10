<?php
        if(!isset($vname)){$vname = $vnameBot; }else{ }
        //echo "-- ".$vname."<br>";
        
        print(" <input type='hidden' name='dyt1' value='".$dyt1."' />
                <input type='hidden' name='vname' value='".$vname."' />
                <input type='hidden' name='id' value='".$rowb['id']."' />
                <input type='hidden' name='factnum' value='".$rowb['factnum']."' />
                <input type='hidden' name='factdate' value='".$rowb['factdate']."' />
                <input type='hidden' name='factnom' value='".$rowb['factnom']."' />
                <input type='hidden' name='factnif' value='".$rowb['factnif']."' />
                <input type='hidden' name='factiva' value='".$rowb['factiva']."' />
                <input type='hidden' name='factivae' value='".$rowb['factivae']."' />
                <input type='hidden' name='factpvp' value='".$rowb['factpvp']."' />
                <input type='hidden' name='factret' value='".$rowb['factret']."' />
                <input type='hidden' name='factrete' value='".$rowb['factrete']."' />
                <input type='hidden' name='factpvptot' value='".$rowb['factpvptot']."' />
                <input type='hidden' name='coment' value='".$rowb['coment']."' />

                <input type='hidden' name='refprovee' value='".$rowb['refprovee']."' />

                <input type='hidden' name='myimg1'value='".@$rowb['myimg1']."' />
                <input type='hidden' name='myimg2' value='".@$rowb['myimg2']."' />
                <input type='hidden' name='myimg3' value='".@$rowb['myimg3']."' />
                <input type='hidden' name='myimg4' value='".@$rowb['myimg4']."' />");

?>