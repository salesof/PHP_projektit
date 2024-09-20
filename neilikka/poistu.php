<?php
session_start();
session_unset(); // Poistaa kaikki sessiotiedot
session_destroy(); // Tuhoaa sessio
header('Location: kirjaudu.php'); // Ohjaa kirjautumissivulle
exit();
