<?php
$palvelin = "localhost";
$kayttaja = "root";  // tämä on tietokannan käyttäjä, ei tekemäsi järjestelmän
$salasana = "";
$tietokanta = "Autokanta";

//Macin XAMPPissa XAMPP/xamppfiles/phpmyadmin/config.inc.php tiedostosta

// luo yhteys
$yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);

// jos yhteyden muodostaminen ei onnistunut, keskeytä
if ($yhteys->connect_error) {
    die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
}
// aseta merkistökoodaus (muuten ääkköset sekoavat)
$yhteys->set_charset("utf8");
echo "Yhteys muodostettu onnistuneesti" . "<br>";

$hakusql = "SELECT * FROM auto";
$tulokset = $yhteys->query($hakusql);

// jos tulosrivejä löytyi
if ($tulokset->num_rows > 0) {
    // hae joka silmukan kierroksella uusi rivi
    while ($rivi = $tulokset->fetch_assoc()) {
        // taulukon avaimet (hakasuluissa olevat nimet) ovat TIETOKANNAN KENTTIÄ (sarakkeita)
        echo "Rekisterinumero: " . $rivi["rekisterinro"] . " - Merkki: " . $rivi["merkki"] . " - Väri: " . $rivi["vari"] . "<br>";
    }
} else {
    echo "Ei tuloksia";
}

$lisayssql = "INSERT INTO auto (rekisterinro, vari, omistaja, merkki) VALUES ('CES-267', 'sininen', '200292-195H', 'Volvo')";

$tulos = $yhteys->query($lisayssql);

if ($tulos === TRUE) {
    echo "Auto lisätty.";
} else {
    echo "Virhe: " . $lisayssql . "<br>" . $conn->error;
}

$hakusql = "SELECT * FROM auto";
$tulokset = $yhteys->query($hakusql);

// jos tulosrivejä löytyi
if ($tulokset->num_rows > 0) {
    // hae joka silmukan kierroksella uusi rivi
    while ($rivi = $tulokset->fetch_assoc()) {
        // taulukon avaimet (hakasuluissa olevat nimet) ovat TIETOKANNAN KENTTIÄ (sarakkeita)
        echo "Rekisterinumero: " . $rivi["rekisterinro"] . " - Merkki: " . $rivi["merkki"] . " - Väri: " . $rivi["vari"] . "<br>";
    }
} else {
    echo "Ei tuloksia";
}

$yhteys->close();
