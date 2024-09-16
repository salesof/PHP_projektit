<?php
if (!session_id()) session_start();
ini_set('default_charset', 'utf-8');
?>

<head>
  <title>Puutarhaliike Neilikka</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php
include_once "debuggeri.php";
/* Huom. suojatulla sivulla on asetukset,db,rememberme.php; */
if (!isset($loggedIn)) {
  require "asetukset.php";
  include "db.php";
  include "rememberme.php";
  $loggedIn = loggedIn();
}
debuggeri("loggedIn:$loggedIn");
register_shutdown_function('debuggeri_shutdown');
$active = basename($_SERVER['PHP_SELF'], ".php");

function active($sivu, $active)
{
  return $active == $sivu ? 'active' : '';
}
?>