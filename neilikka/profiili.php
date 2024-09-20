<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">
        <h1>Profiilisivu</h1>
        <?php
        session_start();

        // Tarkista, onko käyttäjä kirjautunut sisään
        if (!isset($_SESSION['id'])) {
            echo "<p>Sinun täytyy kirjautua sisään nähdäksesi profiilisivun.</p>";
            exit();
        }

        // Yhteys tietokantaan
        $conn = new mysqli('localhost', 'root', '', 'db_neilikka');

        // Tarkista tietokantayhteys
        if ($conn->connect_error) {
            die("Yhteyden luominen epäonnistui: " . $conn->connect_error);
        }

        // Hae käyttäjän tiedot
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $firstName = htmlspecialchars($user['firstname']);
            $lastName = htmlspecialchars($user['lastname']);
            $email = htmlspecialchars($user['email']);
            $profileImage = htmlspecialchars($user['image']); // Muuta tämä kenttä oikeaksi, jos käytät kuvaa

            echo '<img src="' . ($profileImage ?: 'uploads/blank-profile-picture.png') . '" alt="Profiilikuva" class="profile-image">';
            echo '<div class="info-section">';
            echo '<strong>Nimi: </strong>' . $firstName . ' ' . $lastName;
            echo '</div>';
            echo '<div class="info-section">';
            echo '<strong>Email: </strong>' . $email;
            echo '</div>';
        } else {
            echo "<p>Käyttäjän tietoja ei löytynyt.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
    <?php include "modules/footer.php" ?>
</body>

</html>