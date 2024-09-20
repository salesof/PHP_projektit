<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start(); // Aloitetaan tulostuksen puskurointi

// Ota käyttöön virheraportointi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'sendEmails.php'; // Sisällytä sendEmails.php-tiedosto

$email = "";
$resetMessage = "";
$errors = [];

// Yhteys tietokantaan
$conn = new mysqli('localhost', 'root', '', 'db_neilikka');

// Tarkista tietokantayhteys
if ($conn->connect_error) {
    die("Yhteyden luominen epäonnistui: " . $conn->connect_error);
}

// SIGN UP USER
if (isset($_POST['signup'])) {
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = 'Etunimi on pakollinen';
    }
    if (empty($_POST['lastname'])) {
        $errors['lastname'] = 'Sukunimi on pakollinen';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Sähköpostiosoite on pakollinen';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Salasana on pakollinen';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'Salasanat eivät täsmää';
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // encrypt password

    // Kuvan käsittely
    $imagePath = null; // Asetetaan oletusarvoksi null, jos käyttäjä ei lataa kuvaa
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imageSize = $_FILES['image']['size'];
        $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageType, $allowedTypes)) {
            $uploadDir = 'uploads/';
            $imagePath = $uploadDir . time() . "_" . $imageName;

            // Siirrä tiedosto palvelimelle
            if (!move_uploaded_file($imageTmpName, $imagePath)) {
                $errors['image'] = 'Kuvan lataaminen epäonnistui';
            }
        } else {
            $errors['image'] = 'Väärä kuvatiedoston tyyppi. Sallitut tiedostotyypit ovat jpg, jpeg, png, gif.';
        }
    }

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors['email'] = "Sähköpostiosoite löytyy jo palvelusta";
    }

    if (count($errors) === 0) {
        // Jos käyttäjä ei ladannut kuvaa, asetetaan kuvan poluksi null tietokantaan
        $query = "INSERT INTO users (firstname, lastname, email, token, password, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssss', $firstname, $lastname, $email, $token, $password, $imagePath);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // Lähetetään vahvistusviesti sähköpostiin
            sendVerificationEmail($email, $token);

            $_SESSION['id'] = $user_id;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'Olet sisäänkirjautunut';
            $_SESSION['type'] = 'alert-success';

            header('location: verifikaatio.php');
            exit(0);
        } else {
            $_SESSION['error_msg'] = "Tietokantavirhe: Käyttäjää ei voitu rekisteröidä";
        }
    }
}

// LOGIN
if (isset($_POST['login'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'Sähköpostiosoite on pakollinen';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Salasana on pakollinen';
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM users WHERE email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) { // Jos salasana täsmää
                $stmt->close();

                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['loggedIn'] = true; // Aseta tämä muuttuja merkitsemään, että käyttäjä on kirjautunut sisään
                $_SESSION['message'] = 'Olet kirjautunut sisään!';
                $_SESSION['type'] = 'alert-success';
                header('location: profiili.php');
                exit(0); // Varmistaa, että suoritus päättyy oikein
            } else {
                $errors['login_fail'] = "Väärä sähköpostiosoite tai salasana";
            }
        } else {
            $_SESSION['message'] = "Tietokantavirhe. Sisäänkirjautuminen epäonnistui.";
            $_SESSION['type'] = "alert-danger";
        }
    }
}

// RESET PASSWORD REQUEST (Salasanan palautuspyyntö)
if (isset($_POST['reset-request'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'Sähköpostiosoite on pakollinen';
    }

    $email = $_POST['email'];

    if (count($errors) === 0) {
        // Tarkista, onko sähköposti tietokannassa
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Jos käyttäjä löytyi, luo uniikki token
            $token = bin2hex(random_bytes(50));

            // Tallenna token tietokantaan ja aseta sen vanhenemisajaksi esim. 1 tunti
            $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expires=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email=?");
            $stmt->bind_param('ss', $token, $email);
            $stmt->execute();

            // Lähetä sähköposti palautuslinkillä
            sendResetEmail($email, $token); // Funktio lähetystä varten

            // Tallenna viesti
            $resetMessage = "Palautuslinkki on lähetetty sähköpostiisi.";
        } else {
            $errors['email'] = 'Sähköpostiosoitetta ei löydy järjestelmästä';
        }
    }
}

// RESET PASSWORD (Salasanan palautus)
if (isset($_POST['reset-password'])) {
    $newPassword = $_POST['new_password'];
    $newPasswordConf = $_POST['new_passwordConf'];
    $token = $_POST['token'];

    // Tarkistetaan, että salasanat eivät ole tyhjiä ja täsmäävät
    if (empty($newPassword) || empty($newPasswordConf)) {
        $errors['password'] = 'Salasana on pakollinen';
    } elseif ($newPassword !== $newPasswordConf) {
        $errors['passwordConf'] = 'Salasanat eivät täsmää';
    }

    if (count($errors) === 0) {
        // Tarkistetaan, että token on olemassa ja voimassa
        $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token=? AND reset_expires > NOW() LIMIT 1");
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Päivitetään uusi salasana ja tyhjennetään token
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
            $stmt->bind_param('ss', $newPasswordHash, $token);
            $stmt->execute();

            $resetMessage = "Salasanasi on vaihdettu onnistuneesti. Voit nyt kirjautua sisään.";
        } else {
            $errors['token'] = 'Token ei ole voimassa tai on vanhentunut';
        }
    }
}
