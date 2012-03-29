<?php  
//firstly, we're faking this. Its a PHP file that we want
//the browser to load as if it were a CSS file. 

/* set MIME type */ 
header("Content-Type: text/css"); 
/* set caching to a reasonable value */ 
header("Cache-Control: must-revalidate"); 
$offset = 72000 ; 
$ExpStr = "Expires: " . 
gmdate("D, d M Y H:i:s", 
time() + $offset) . " GMT"; 
header($ExpStr); 
$db = get_db();
$mysql = 'SELECT * FROM '. $db->prefix .'elements
		WHERE 
		element_set_id = "1" 
		ORDER BY '. $db->prefix .'elements.order ASC';
$our_crazy_array = $db->fetchAll($mysql);	
$count_crazy_array = count($our_crazy_array);
	for($x=0;$x<$count_crazy_array;$x++)
	{
		//there should be 15 of these. Unless someone hacked and modified the code...
	 	$thisone = get_option('simplifyon'.$our_crazy_array[$x][id].'');
		if($thisone == "no")
			{
				//first, parse the ID into the div. 
				//the id of the fields on the admin
				//side look like this: id="element-50"
				?>
				#element-<?php echo $our_crazy_array[$x][id];?>
					{display: none; }
				<?php
			}
	}
?>