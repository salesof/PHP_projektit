<?php
$palvelin = "localhost";
$kayttaja = "root";
$salasana = "";
$tietokanta = "Autokanta";

// Luo yhteys
$yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);

// Jos yhteyden muodostaminen ei onnistunut, keskeytä
if ($yhteys->connect_error) {
    die("Yhteyden muodostaminen epäonnistui: " . $yhteys->connect_error);
}

// Aseta merkistökoodaus (muuten ääkköset sekoavat)
$yhteys->set_charset("utf8");
echo "Yhteys muodostettu onnistuneesti" . "<br>";

// Funktio taulun tietojen hakemiseen ja tulostamiseen
function tulosta_taulun_tiedot($yhteys, $taulu)
{
    $hakusql = "SELECT * FROM $taulu";
    $tulokset = $yhteys->query($hakusql);

    echo "<br><strong>$taulu-taulun tiedot:</strong><br>";

    if ($tulokset->num_rows > 0) {
        while ($rivi = $tulokset->fetch_assoc()) {
            echo implode(" | ", $rivi) . "<br>";
        }
    } else {
        echo "Ei tuloksia taulussa $taulu<br>";
    }
}

// Lisää sakko
$sakkosql = "INSERT INTO Sakko (auto, henkilo, pvm, summa, syy) VALUES
('CES-528', '281182-070W', '2012-01-02', 50.00, 'Virheellinen pysäköinti')";
$yhteys->query($sakkosql);
tulosta_taulun_tiedot($yhteys, 'Sakko');

// Poista henkilö Tapio Tamminen
//$poistosql1 = "DELETE FROM Henkilo WHERE hetu = '120760-093B'";
//$yhteys->query($poistosql1);
//tulosta_taulun_tiedot($yhteys, 'Henkilo');

// Päivitä Matti Miettisen osoite
$paivityssql = "UPDATE Henkilo SET osoite = 'Mäkelänkatu 15' WHERE hetu = '080173-169T'";
$yhteys->query($paivityssql);
tulosta_taulun_tiedot($yhteys, 'Henkilo');

// Vaihda auton HUT-444 omistajaksi Teemu Tamminen
$paivityssql2 = "UPDATE Auto SET omistaja = '200292-195H' WHERE rekisterinro = 'HUT-444'";
$yhteys->query($paivityssql2);
tulosta_taulun_tiedot($yhteys, 'Auto');

// Poista Tapio Tamminen uudelleen (nyt kun auton omistaja on vaihdettu)
$poistosql2 = "DELETE FROM Henkilo WHERE hetu = '120760-093B'";
$yhteys->query($poistosql2);
tulosta_taulun_tiedot($yhteys, 'Henkilo');

// Lisää uusi auto tietokantaan
$lisayssql = "INSERT INTO Auto (rekisterinro, merkki, vari, vuosimalli, omistaja) VALUES ('DAU-781', 'Toyota', 'musta', 2007, '080173-169T')";
$yhteys->query($lisayssql);
tulosta_taulun_tiedot($yhteys, 'Auto');

// Lisää sakko uudelle autolle
$sakkosql2 = "INSERT INTO Sakko (auto, henkilo, pvm, summa, syy) VALUES ('DAU-781', '080173-169T', '2024-09-09', 100.00, 'Ylinopeus 40 km/h alueella')";
$yhteys->query($sakkosql2);
tulosta_taulun_tiedot($yhteys, 'Sakko');

// Sulje yhteys
$yhteys->close();
echo "Yhteys suljettu";
