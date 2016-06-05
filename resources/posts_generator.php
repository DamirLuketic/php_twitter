<?php
$array=array();
$handle = fopen("C:\Users\Luketic\Desktop\New Text Document.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
    	//echo $line;
        if(trim($line)==""){
        	continue;
        }
		$array[]=str_replace("'","''",$line);
    }

    fclose($handle);
} else {
  // echo "error";
} 

//print_r($niz);

for($i=1;$i<=200;$i++){
	echo 'insert into posts (user,post_created,post) values
			 (' .  rand(1,12) . ',' . '"' . 
			 rand(2000,2015) . '-' . sprintf("%02d", rand(1,12)) . '-' . sprintf("%02d", rand(1,28)) . ' ' . 
			 sprintf("%02d", rand(0,23)) . ':' . sprintf("%02d", rand(0,59)) . ':' . sprintf("%02d", rand(0,59)) . '"' . ',' . 
			 '"' . $array[rand(0,count($array)-1)] . '");<br />';
}	

// echo '"' . rand(2000,2015) . '-' . rand(1,12) . '-' . rand(1,28) . ' ' . rand(0,23) . ':' . rand(0,59) . ':' . rand(0,59) . '"'
