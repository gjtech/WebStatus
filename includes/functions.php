<?php

/*	Script Name: functions.php
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

/*
  Function: prepare_for_output ( $lastModified , $contentType )
  
  @return	nil
*/
function prepare_for_output($lastModified = 0,$contentType = 'text/plain')
{
	$contentType = sprintf("Content-type: %s",$contentType);
	header($contentType);
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header($lastModified);
	header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	return;
}

?>