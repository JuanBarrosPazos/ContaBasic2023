<?php

print("<select name='dy'>
			<option value=''>YEAR</option>");
				
	global $db;
	global $t1; 		$t1 = "`".$_SESSION['clave']."status`";
	$sqlb =  "SELECT * FROM $t1  WHERE `hidden` = 'no' ORDER BY `year` DESC ";
	$qb = mysqli_query($db, $sqlb);				
		
	if(!$qb){print("* ".mysqli_error($db)."<br/>");

		} else {while($rows = mysqli_fetch_assoc($qb)){
						print ("<option value='".$rows['ycod']."' ");
							if($rows['ycod'] == @$defaults['dy']){
											print ("selected = 'selected'");}
											print ("> ".$rows['year']." </option>");
										}
									}  

?>