<?php
$db = get_db();
$mysql = 'SELECT * FROM '. $db->prefix .'elements
	WHERE 
		element_set_id = "1" 
		ORDER BY '. $db->prefix .'elements.order ASC';
$our_crazy_array = $db->fetchAll($mysql);	
$count_crazy_array = count($our_crazy_array);
echo "$count_crazy_array has  djhdfgjk items";

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


