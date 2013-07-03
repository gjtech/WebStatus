<?php

/*	Script Name: Apaache Status
	Version: 1.4
	Description: Returns status message verifying that Apache process is alive and serving web pages.
	Author: Juan González
	Author URI: http://www.gjtech.net/
---------------------------------------------------------------------------*/
define('SCRIPT.STATUS', TRUE);
define('SCRIPT_BASE_DIRECTORY', getcwd());

/* Required common script */
require(SCRIPT_BASE_DIRECTORY . '/includes/common.php');

/* Declare global variables */
global $cfg,$serverStatus,$serverProtocol,$lastModified,$userAgent;
$serverStatus	= FALSE;
$serverProtocol = ($_SERVER['HTTPS'] ? TRUE: FALSE);
$lastModified	= sprintf("Last-Modified: %s GMT", gmdate("D, d M Y H:i:s"));
$userAgent		= strtolower($_SERVER['HTTP_USER_AGENT']);

/* Declare script defaults */
$cfg = array(
	'current-status-up'		=> 'status up',
	'current-status-down'	=> 'status down',
	'require-wget'			=> FALSE,
	'require-wget-match'	=> '/^(curl|wget)\/([0-9]+)\.([0-9]+)/i',
	'script-require-https'	=> TRUE
);

/*
  Terminate script when:
  		1. get-status is not set in url request
  		2. https is required but not called
		3. wget is required but different agent makes call
*/
if (
	!isset($_GET["get-status"]) ||
	(($cfg['script-require-https'] === TRUE) && ($serverProtocol === FALSE)) ||
	(($cfg['require-wget'] === TRUE) && !preg_match($cfg['require-wget-match'],$userAgent))
   )
{
    header('Location: /');
    exit(0);
}

/* Declare variable values */
$serverStatus = $cfg['current-status-up'];

/* Send PHP Headers */
prepare_for_output($lastModified);

/* Server status conditional */
if (!($serverStatus === FALSE))
{
	print($serverStatus);
}

/* Exit script */
exit(0);

?>