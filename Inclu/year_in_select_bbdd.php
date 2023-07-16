<?php

print("
						<select name='dy'>
							<option value=''>YEAR</option>");
				
			global $db;
			global $t1;
			$t1 = "cbj_status";
			$t1 = "`".$t1."`";
			$sqlb =  "SELECT * FROM $t1 WHERE `stat` = 'open' ORDER BY `year` DESC ";
			$qb = mysqli_query($db, $sqlb);				
		
			if(!$qb){
					print("* ".mysqli_error($db)."<br/>");
			} else {
							
				while($rows = mysqli_fetch_assoc($qb)){
							print ("<option value='".$rows['ycod']."' ");
							if($rows['ycod'] == $defaults['dy']){
											print ("selected = 'selected'");
																				}
											print ("> ".$rows['year']." </option>");
				}
			}  

?>
