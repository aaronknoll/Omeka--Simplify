<?php

$db = get_db();
$mysql = 'SELECT * FROM '. $db->prefix .'elements
	WHERE 
		element_set_id = "1" 
		ORDER BY '. $db->prefix .'elements.order ASC';
$our_crazy_array = $db->fetchAll($mysql);	
$count_crazy_array = count($our_crazy_array);
echo "<p class='warning'>Please note that Omeka by default
will always display the Ttile field. This plugin will
not prevent you from disabling it on the backend, but keep in mind
it will <strong>always appear</strong> on the front.</p>";

for($x=0;$x<$count_crazy_array;$x++)
	{
	//option looks like "titleon" / "creatoron"
	$what_is_this_options_status	=	get_option('simplifyon'.$our_crazy_array[$x][id].'');
	?>
	<div class="field">
	<label for="per_page">Turn on <?php echo $our_crazy_array[$x][name]; ?></label>
	<div class="inputs">
		<select id="simplifyon<?php echo $our_crazy_array[$x][id]; ?>" name="simplifyon<?php echo $our_crazy_array[$x][id]; ?>">
	<?php
	//can only have two options, "yes" oe "no", all lowercase.
	if($what_is_this_options_status == "no")
		{ 
			?>
			<option value="yes">Show Me</option>
			<option SELECTED value="no">Hidden</option>
			<?php
		}
	else
		{
			?>
			<option SELECTED value="yes">Show Me</option>
			<option value="no">Hidden</option>
			<?php	
		}
		?>
		</select> 
	<p class="explanation"><?php echo $our_crazy_array[$x][description]; ?></p>
	</div>
</div>
	<?php	
	}
?>


