<?php

/*	Script Name: User Agent Information
	Version: 1.1
	Description: Returns user agent information
	Author: Juan González
	Author URI: http://www.gjtech.net/
---------------------------------------------------------------------------*/
define('SCRIPT.STATUS', TRUE);
define('SCRIPT_BASE_DIRECTORY', getcwd());

/* Required common script */
require(SCRIPT_BASE_DIRECTORY . '/includes/common.php');

/* Declare global variables */
global $userAgent,$client_ip,$lastModified;

/* Declare variable values */
$userAgent		= $_SERVER["HTTP_USER_AGENT"];
$userIPAddress	= $client_ip;
$lastModified	= sprintf("Last-Modified: %s GMT", gmdate("D, d M Y H:i:s"));

$params = array('method' => 'method');
foreach($params AS $key => $value)
{
    unset($$key);
    if (isset($_GET[$key]) && !empty($_GET[$key]))
    {
    	$$key = $_GET[$key];
        break;
    }
}

switch ($method)
{
	case 'get-ip':
		$pageMetaTitle	= 'IP Address';
		$pageTitle		= 'IP Address';
		$pageDetails	= $userIPAddress;
		break;
	
	default:
		$pageMetaTitle	= 'User Agent';
		$pageTitle		= 'User Agent';
		$pageDetails	= $userAgent;
	break;
}

/* Send PHP Headers */
prepare_for_output($lastModified,'text/html');

/* Print user agent to screen */
print ('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">');
print ('<html xmlns="http://www.w3.org/1999/xhtml\">');
print ('<head>');
print ('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />');
printf('<title>%s</title>',$pageMetaTitle);
print ('<style>#body{margin:50px 0px;padding:0px;text-align:center;} div.title{font-size:1.5em;font-weight:bold;} div.agent{font-size:1em;}</style>');
print ('</head>');
print ('<body id="body">');
/*---------*/
printf('<div class="title">%s</div>',$pageTitle);
printf('<div class="agent">%s</div>',$pageDetails);
/*---------*/
print ('</body>');
print ('</html>');

/* Exit Script */
exit(0);

?>