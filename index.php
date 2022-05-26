<?php

session_start();

// Include the main OpenDocMan config file
include('../../odm-load.php');

$last_message = (isset($_REQUEST['last_message']) ? $_REQUEST['last_message'] : '');

// Check to make sure there is a session user ID set
if (!isset($_SESSION['uid']))
{
    header('Location:index.php?redirection=' . urlencode($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']));
    exit;
}

// Create the user object
$user_obj = new User($_SESSION['uid'], $pdo);

// Only root user as configured in the OpenDocMan config can access this plugin. Can also be isAdmin()
if (!$user_obj->isRoot())
{
    header('Location: error.php?ec=1');
    exit;
}

// Now draw the standard header, menu, and status bar
draw_header('Self Link', $last_message);

include('CopySelfLink_class.php');
// Here we create the object
$copy_self_link = new CopySelfLink();

// Assign this value for our view
$GLOBALS['smarty']->assign('copy_self_link', $copy_self_link);

// Make sure Smarty will look for the template file in this folder
$current_directory = dirname(__FILE__);
$GLOBALS['smarty']->display('file:' . $current_directory . '/templates/copy_self_link_view.tpl');

draw_footer();
