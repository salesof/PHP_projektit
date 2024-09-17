<?php
if (!defined('DEBUG')) define('DEBUG', true);

// Rekisteröi mukautettu virheenkäsittelijä
if (DEBUG) {
  set_error_handler('debug_error_handler');
  register_shutdown_function('debuggeri_shutdown');
}

function debug_error_handler($errno, $errstr, $errfile, $errline)
{
  if (!(error_reporting() & $errno)) {
    // Tämä virhekoodi ei ole virheiden raportoinnissa, joten anna sen kulkea
    return false;
  }

  $message = "";
  switch ($errno) {
    case E_USER_ERROR:
      $message = "<b>My ERROR</b> [$errno] $errstr<br />\n";
      $message .= "  Fatal error on line $errline in file $errfile";
      $message .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
      $message .= "Aborting...<br />\n";
      exit(1);
      break;

    case E_USER_WARNING:
      $message = "<b>My WARNING</b> [$errno] $errstr<br />\n";
      break;

    case E_USER_NOTICE:
      $message = "<b>My NOTICE</b> [$errno] $errstr<br />\n";
      break;

    default:
      return false;
      break;
  }

  debuggeri($message);
  /* Älä suorita PHP:n sisäistä virheenkäsittelijää */
  return true;
}

function debuggeri($arvo)
{
  if (!DEBUG) return;
  $msg = is_array($arvo) ? var_export($arvo, true) : $arvo;
  $msg = date("Y-m-d H:i:s") . " " . $msg . "\n";
  file_put_contents("debug_log.txt", $msg, FILE_APPEND | LOCK_EX);
}

function debuggeri_filter($n)
{
  $args = isset($n['args']) ? implode(",", $n['args']) : "";
  $m = basename($n['file']) . ", rivi " . $n['line'] . ", " . $n['function'] . "($args)";
  return $m;
}

function debuggeri_backtrace($errorMsg)
{
  if (!DEBUG) return;
  $msg = date("Y-m-d H:i:s") . " " . $errorMsg;
  if ($backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) {
    array_shift($backtrace);
    $backtrace = array_reverse($backtrace);
    $backtrace = array_map('debuggeri_filter', $backtrace);
    $msg .= "\n" . implode("\n", $backtrace);
  }
  debuggeri($msg);
}

function debuggeri_shutdown()
{
  if (!DEBUG) return;
  $error = error_get_last();
  if ($error && $error['type'] === E_ERROR) {
    $type = $error['type'];
    $msg = date("Y-m-d H:i:s") . " Ohjelman suoritus päättyi.";
    $msg .= " Pysäyttävä virhe $type rivillä " . $error['line'] . ", tiedostossa " . $error['file'];
    file_put_contents("debug_shutdown.txt", $msg . "\n", FILE_APPEND | LOCK_EX);
    echo "<p>Ohjelman suoritus päättyi virheeseen.</p>";
  }
}
