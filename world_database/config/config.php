<?php
error_reporting(E_ALL);
session_start();
ob_start();
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DATABASE','location');

//socket connection
define('SOCKET_HOST','127.0.0.1');
define('SOCKET_PORT','25010');

define('HTTP_PATH','http://localhost/phpscripts/world_database/');
define('HTTPS_PATH','https://localhost/phpscripts/world_database/');

define('DOCUMENT_PATH',$_SERVER['DOCUMENT_ROOT'].'/phpscripts/world_database/');
define('SUB_DIR','/phpscripts/world_database/');
define('SALT','12BC#@');

// ## database connection
include("database.php");
$db = new database;

include("global.php");
include("functions.php");

define('PAGENAME',get_pagename());
//include(DOCUMENT_PATH . "function/general_functions.php");
//include(DOCUMENT_PATH . "function/mailler.php");
?>