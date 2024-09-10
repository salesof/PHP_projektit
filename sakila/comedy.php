<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">

        <h1>Komedia-elokuvat</h1>

        <?php
        $tietokanta = "sakila";
        include 'debugger.php';
        include 'db-routines.php';
        register_shutdown_function('debugger_shutdown');

        $query = "SELECT film.title as 'Nimi', film.description as 'Kuvaus', film.rating as 'Ikäraja', film.release_year as 'Julkaisuvuosi' 
        FROM film_category 
        INNER JOIN film ON film_category.film_id = film.film_id 
        WHERE film_category.category_id = 5";

        $result = $yhteys->query($query);

        // Tarkista, että kysely tuotti tuloksia
        if ($result->num_rows > 0) {
            // Tulosta tulokset
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    echo "<b>$key:</b> $value<br>";
                }
                echo "<br>";
            }
        } else {
            echo "Ei tuloksia.";
        }
        ?>
    </div>

    <?php
    include "modules/footer.php"
    ?>
</body>

</html>