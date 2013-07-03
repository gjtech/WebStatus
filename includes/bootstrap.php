<?php

/*	Script Name: bootstrap.php
	Version: 1.0
	Description: Shared runtime functions
	Author: Juan González
	Author URI: http://www.gjtech.net/
---------------------------------------------------------------------------*/
if (!defined('SCRIPT.STATUS'))
{
	printf("Illegal operation in file %s at line %d.",__FILE__,__LINE__);
	exit(0);
}

/*	@Set globals
--------------------------------------------------------*/
global $_POST,$_GET,$_SERVER,$_COOKIE,$_ENV,$_SESSION;

/*	@Kill magic quotes runtime
--------------------------------------------------------*/
// set_magic_quotes_runtime(0);

/*	@Define known browsers
--------------------------------------------------------*/
define('APPLE_IPHONE'	, 'iphone');
define('MOZILLA'		, 'mozilla');
define('MSIE8'			, 'msie8');
define('MSIE7'			, 'msie7');
define('MSIE6'			, 'msie6');
define('GECKO'			, 'gecko');
define('FIREFOX'		, 'firefox');
define('KONQUEROR'		, 'konqueror');
define('SAFARI'			, 'safari');
define('NETSCAPE'		, 'netscape');
define('OPERA'			, 'opera');
define('MOSAIC'			, 'mosaid');
define('LYNX'			, 'lynx');
define('AMAYA'			, 'amaya');
define('OMNIWEB'		, 'omniweb');
define('CHROME'			, 'chrome');
define('ADOBE_FLASH'	, 'flash');
define('ANDROID'		, 'android');

/*	@Extract globals
--------------------------------------------------------*/
$extract = array($_POST,$_GET,$_SERVER,$_COOKIE,$_ENV,$_SESSION);
foreach ($extract as $input) { if ($input) { extract($input,EXTR_SKIP); } }

/*	@Dump out if globals are set
--------------------------------------------------------*/
if (isset($_POST['GLOBALS']) || isset($_ENV['GLOBALS']) || isset($_GET['GLOBALS']) || isset($_COOKIE['GLOBALS'])) { die('Illegal $GLOBAL variable...'); }

/*	@Dump out if $_SESSION is not array
--------------------------------------------------------*/
if (isset($_SESSION) && !is_array($_SESSION)) { die('Illegal $_SESSION variable...'); }

/*	@Safty net for register globals
--------------------------------------------------------*/
if (@ini_get('register_globals'))
{
	if (!isset($_SESSION) || !is_array($_SESSION)) { $_SESSION = array(); }
	$not_unset	= array('_POST','_GET','_SERVER','_COOKIE','_ENV','_SESSION');
	$input		= array_merge($_POST,$_GET,$_SERVER,$_COOKIE,$_ENV,$_SESSION);
	unset($input['input'],$input['not_unset']);

	while (list($var,) = @each($input))
	{
		if (in_array($var,$not_unset)) { die('Illegal operations...'); }
		unset($$var);
	}
	
	unset($input);
}

/* addslashes to vars if magic_quotes_gpc is off this
   is a security precaution to prevent someone trying
   to break out of a SQL statement.
--------------------------------------------------------*/
if(!get_magic_quotes_gpc())
{
	if (is_array($_GET))
	{
		while (list($k,$v) = each($_GET))
		{
			if (is_array($_GET[$k]))
			{
				while (list($k2,$v2) = each($_GET[$k])) { $_GET[$k][$k2] = addslashes($v2); }
				@reset($_GET[$k]);
			}
			else { $_GET[$k] = addslashes($v); }
		}
		@reset($_GET);
	}

	if (is_array($_POST))
	{
		while (list($k,$v) = each($_POST))
		{
			if (is_array($_POST[$k]))
			{
				while (list($k2,$v2) = each($_POST[$k])) { $_POST[$k][$k2] = addslashes($v2); }
				@reset($_POST[$k]);
			}
			else { $_POST[$k] = addslashes($v); }
		}
		@reset($_POST);
	}

	if (is_array($_COOKIE))
	{
		while (list($k,$v) = each($_COOKIE))
		{
			if (is_array($_COOKIE[$k]))
			{
				while (list($k2,$v2) = each($_COOKIE[$k])) { $_COOKIE[$k][$k2] = addslashes($v2); }
				@reset($_COOKIE[$k]);
			}
			else { $_COOKIE[$k] = addslashes($v); }
		}
		@reset($_COOKIE);
	}
}

/*	@Obtain client IP address
---------------------------------------------------------*/
global $client_ip;
$client_ip	= $_SERVER['REMOTE_ADDR'];

/*	@Obtain client browser
---------------------------------------------------------*/
global $user_agent;
$agent		= strtolower($_SERVER['HTTP_USER_AGENT']);
$browsers	= array(
	APPLE_IPHONE	=> 'iphone',
	ANDROID			=> 'android',
	MSIE8			=> 'msie 8',
	MSIE7			=> 'msie 7',
	MSIE6			=> 'msie 6',
	CHROME			=> 'chrome',
	FIREFOX			=> 'firefox',
	KONQUEROR		=> 'konqueror',
	SAFARI			=> 'safari',
	ADOBE_FLASH		=> 'shockwave flash',
	OPERA			=> 'opera',
	MOSAIC			=> 'mosaic',
	NETSCAPE		=> 'netscape navigator',
	LYNX			=> 'lynx',
	AMAYA			=> 'amaya',
	OMNIWEB			=> 'omniweb',
	GECKO			=> 'gecko',
	MOZILLA			=> 'mozilla',
);

while (list($key,$value) = @each($browsers))
{
	if (preg_match("/\b$value\b/",$agent))
	{
		$user_agent = $key;
		break;
	}
}

/*	@Set internal character encoding
---------------------------------------------------------*/
mb_internal_encoding('UTF-8');

?>