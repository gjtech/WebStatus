<?php

/*	Script Name: PHP Information
	Version: 1.1
	Description: Returns PHP Module information
	Author: Juan González
	Author URI: http://www.gjtech.net/
---------------------------------------------------------------------------*/
define('SCRIPT.STATUS', TRUE);
define('SCRIPT_BASE_DIRECTORY', getcwd());

/* Required common script */
require(SCRIPT_BASE_DIRECTORY . '/includes/common.php');

/* Declare global variables */
global $lastModified;

/* Declare variable values */
$lastModified = sprintf("Last-Modified: %s GMT", gmdate("D, d M Y H:i:s"));

/* Send PHP Headers */
prepare_for_output($lastModified,'text/html');

/* Print PHP info to screen */
print phpinfo();

/* Exit script */
exit(0);

?>