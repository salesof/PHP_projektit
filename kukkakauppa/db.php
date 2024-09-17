<?php
// Tietokantayhteyden luominen
function db_connect()
{
   static $yhteys = null;

   if ($yhteys === null) {
      $db_server = 'localhost';
      $db_username = 'root';
      $db_password = '';
      $db_name = 'neilikka';

      try {
         $yhteys = new mysqli($db_server, $db_username, $db_password, $db_name);

         if ($yhteys->connect_error) {
            throw new Exception("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
         }

         $yhteys->set_charset("utf8");
      } catch (Throwable $e) {
         error_log("Virhe yhteyden muodostamisessa: " . $e->getMessage());
         die("Yhteyden muodostaminen epäonnistui. Ota yhteyttä järjestelmänvalvojaan.");
      }
   }

   return $yhteys;
}
