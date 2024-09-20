<?php
session_start();

// Varmista, että käyttäjä on kirjautunut sisään
if (!isset($_SESSION['id'])) {
    $_SESSION['message'] = "Sinun täytyy kirjautua sisään nähdäksesi tämän sivun.";
    $_SESSION['type'] = "alert-danger";
    header('location: login.php');
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="fi">
<?php include "modules/head.php" ?>

<body>

    <?php include "modules/nav.php"; ?>
    <?php include "modules/banner.php" ?>

    <div class="container">
        <h1>Vahvistus onnistui!</h1>
        <p>Kiitos, että vahvistit sähköpostiosoitteesi. Olet nyt kirjautunut sisään.</p>
    </div>

    <?php include "modules/footer.php"; ?>

</body>

</html>