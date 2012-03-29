<?php

add_plugin_hook('public_theme_header', 'simplify_public_theme_header');
add_plugin_hook('admin_theme_header', 'simplify_admin_theme_header');
add_plugin_hook('config_form', 'simplify_config_form');
add_plugin_hook('config', 'simplify_config');

function simplify_admin_theme_header($request)
{
    if ($request->getController() == 'items' && $request->getAction() == 'edit') {
        queue_js('my-script');
    }
}

function simplify_public_theme_header($request)
{
    queue_css('my-stylesheet');	
}

function simplify_config_form()
{
include 'config_form.php';
}

function simplify_config()
{   
    // Use the form to set a bunch of default options in the db
    $perPage = (int)$_POST['per_page'];
    set_option('focusq_per_page', $perPage);
}
    