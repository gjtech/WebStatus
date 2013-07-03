<?php

/*	Script Name: common.php
	Version: 1.0
	Description: Shared runtime functions
	Author: Juan González
	Author URI: http://www.gjtech.net/
---------------------------------------------------------------------------*/

if (!defined('SCRIPT.STATUS') || !defined('SCRIPT_BASE_DIRECTORY'))
{
	printf("Illegal operation in file %s at line %d.",__FILE__,__LINE__);
	exit(0);
}

/* Required scripts */
require(SCRIPT_BASE_DIRECTORY . '/includes/bootstrap.php');
require(SCRIPT_BASE_DIRECTORY . '/includes/functions.php');

?>