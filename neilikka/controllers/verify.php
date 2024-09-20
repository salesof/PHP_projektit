<?php
session_start(); // Varmista, että sessio on aloitettu

require 'authController.php'; // Sisältää tietokantayhteyden

// Tarkista, onko token asetettu URL:ssä
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Hae käyttäjä tokenin perusteella
    $sql = "SELECT * FROM users WHERE token=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // Tarkista, löytyykö käyttäjä tokenin perusteella
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Päivitä käyttäjän `verified`-tila tietokantaan
        $update_query = "UPDATE users SET verified=1, token='' WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('i', $user['id']);
        if ($stmt->execute()) {
            // Kirjaa käyttäjä sisään ja tallenna tiedot sessioon
            $_SESSION['id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;  // Päivitä vahvistustila
            $_SESSION['loggedIn'] = true;  // Määritä käyttäjä kirjautuneeksi
            $_SESSION['message'] = "Sähköpostisi on vahvistettu onnistuneesti!";
            $_SESSION['type'] = "alert-success";

            // Ohjaa vahvistuksen onnistumissivulle
            header('location: ../vahvistus_onnistui.php');
            exit(0);
        }
    } else {
        // Jos token on virheellinen tai vanhentunut
        $_SESSION['message'] = "Virheellinen tai vanhentunut vahvistuslinkki.";
        $_SESSION['type'] = "alert-danger";
        header('location: index.php');
        exit(0);
    }
} else {
    $_SESSION['message'] = "Vahvistuslinkki ei ole käytettävissä.";
    $_SESSION['type'] = "alert-danger";
    header('location: index.php');
    exit(0);
}
