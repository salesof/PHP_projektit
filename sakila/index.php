<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">

        <h1>Elokuva-haku</h1>
        <form method="get" action="">
            <label for="hakuavain">Hakusana:</label>
            <input type="text" name="hakuavain" id="hakuavain">
            <input type="submit" name="painike" value="Hae">
        </form>
        <?php
        if (isset($_GET['painike'])) {
            $tietokanta = "sakila";
            include 'debugger.php';
            include 'db-routines.php';
            register_shutdown_function('debugger_shutdown');
            $hakuavain = $_GET['hakuavain'];

            // Validate hakusana on vähintään 3 merkkiä pitkä ja sisältää vain kirjaimia ja numeroita
            if (preg_match('/^[A-ZÅÄÖa-zåäö0-9]{3,}$/', $hakuavain)) {
                $hakuavain = $yhteys->real_escape_string(strip_tags($hakuavain));
                $query = "SELECT title as 'Nimi', description as 'Kuvaus', rating as 'Ikäraja', release_year as 'Julkaisuvuosi' FROM film WHERE title LIKE '%$hakuavain%'";
                $result = mysqli_my_query($query);
                $lkm = $result->num_rows;
                if ($lkm > 0) {
                    echo "<h2 class='result'>Hakusanalla '$hakuavain' löytyi $lkm tulosta:</h2>";
                    while ($row = $result->fetch_assoc()) {
                        foreach ($row as $key => $value) {
                            echo "<b>$key:</b> $value<br>";
                        }
                        echo "<br>";
                    }
                } else {
                    echo "<h2 class='result'>Ei tuloksia hakusanalla '$hakuavain'</h2>";
                }
            } else {
                echo "<h2 class='failure'>Määritä hakusana (vain aakkosia ja kirjaimia)</h2>";
            }
        }
        ?>
    </div>

    <?php
    include "modules/footer.php"
    ?>
</body>

</html>