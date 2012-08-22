<?php
add_plugin_hook('public_theme_header', 'simplify_public_theme_header');
add_plugin_hook('admin_theme_header', 'simplify_admin_theme_header');
add_plugin_hook('config_form', 'simplify_config_form');
add_plugin_hook('config', 'simplify_config');
add_plugin_hook('install', 'simplify_install');
add_plugin_hook('uninstall', 'simplify_uninstall');

//suggestions
//consolidate the "get the list"into its own list of functions
// figure out the array of dublin core options
// and pass that array around the script, rather than going to the DB too
// many times. 

function simplify_uninstall()
{
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
	 	delete_option('simplifyon'.$our_crazy_array[$x][id].'');
	}
}

function simplify_install()
{
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
	 	set_option('simplifyon'.$our_crazy_array[$x][id].'', 'yes');
	 }
 }

function simplify_admin_theme_header($request)
{
	$styles = "";//we'll concatenate each thing we do here.
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
				$lowerme	= strtolower($our_crazy_array[$x][name]);
				$styles .= "#dublin-core-". $lowerme ."{display:none;}";
				$styles .=	"#element-". $our_crazy_array[$x][id] ."{display: none;}";
			}
	}
   queue_css_string($styles, $media = 'all', $conditional = false);

}

function simplify_public_theme_header($request)
{
   // queue_css('my-stylesheet');	
}

function simplify_config_form()
{
include 'config_form.php';
}

function simplify_config()
{
	$db = get_db();
	$mysql = 'SELECT * FROM '. $db->prefix .'elements
	WHERE 
		element_set_id = "1" 
		ORDER BY '. $db->prefix .'elements.order ASC';
	$our_crazy_array = $db->fetchAll($mysql);	
	$count_crazy_array = count($our_crazy_array);

for($x=0;$x<$count_crazy_array;$x++)
	{   
    // Use the form to set a bunch of default options in the db
    $onoffswitch = $_POST['simplifyon'.$our_crazy_array[$x][id].''];
    set_option('simplifyon'.$our_crazy_array[$x][id].'', $onoffswitch);
	}
}
    