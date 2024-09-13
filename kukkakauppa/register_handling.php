<?php
$display = "d-none";
$message = "";
$success = "";
$lisays = $lisattiin_token = $lahetetty = false;

if (isset($_POST['painike'])) {
    /*foreach ($kentat as $kentta) {
        $arvo = $_POST[$kentta] ?? "";
        if (in_array($kentta, $pakolliset) and empty($arvo)) {
            $errors[$kentta] = $virheilmoitukset[$kentta]['valueMissing'];
            }
        else {
            if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
                $errors[$kentta] = $virheilmoitukset[$kentta]['patternMismatch'];
                }
            else {
                if (is_array($arvo)) $$kentta = $arvo;
                else $$kentta = $yhteys->real_escape_string(strip_tags(trim($arvo)));
                } 
            }    
        }*/
    [$errors, $values] = validointi($kentat);
    extract($values);

    if (empty($errors['password2']) && empty($errors['password'])) {
        if ($_POST['password'] != $_POST['password2']) {
            $errors['password2'] = $virheilmoitukset['password2']['customError'];
        }
    }

    if (empty($errors)) {
        $query = "SELECT 1 FROM users WHERE email = '$email'";
        $result = $yhteys->query($query);
        if ($result->num_rows > 0) {
            $errors['email'] = $virheilmoitukset['email']['emailExistsError'];
        }
    }

    debuggeri($errors);
    if (empty($errors)) {
        $created = date('Y-m-d H:i:s');
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (firstname, lastname, email, created, password) VALUES ('$firstname', '$lastname', '$email', '$created', '$password')";
        debuggeri($query);
        $result = $yhteys->query($query);
        $lisays = $yhteys->affected_rows;
    }

    if ($lisays) {
        $id = $yhteys->insert_id;
        $token = md5(rand() . time());
        $query = "INSERT INTO signup_tokens (users_id, token) VALUES ($id, '$token')";
        debuggeri($query);
        $result = $yhteys->query($query);
        $lisattiin_token = $yhteys->affected_rows;
    }

    if ($lisattiin_token) {
        $msg = "Vahvista sähköpostiosoitteesi alla olevasta linkistä:<br><br>";
        $msg .= "<a href='http://$PALVELIN/$PALVELU/$LINKKI_VERIFICATION?token=$token'>Vahvista sähköpostiosoite</a>";
        $msg .= "<br><br>t. $PALVELUOSOITE";
        $subject = "Vahvista sähköpostiosoite";
        $lahetetty = posti($email, $msg, $subject);
    }

    if ($lahetetty) {
        $message = "Tiedot on tallennettu. Sinulle on lähetty antamaasi sähköpostiosoitteeseen ";
        $message .= "vahvistuspyyntö. Vahvista siinä olevasta linkistä sähköpostiosoitteesi.";
        $success = "success";
        //header("Location: ./rekisterointikuittaus.php?message=$message&success=$success");
        //exit;
    } elseif ($lisays) {
        /* Huom. oikeammin ohjataan vahvistuspyyntöön */
        $message = "Tallennus onnistui!";
        $success = "light";
    } else {
        $message = "Tallennus epäonnistui!";
        $success = "danger";
    }
    $display = "d-block";

    /*
    var_export($_POST);
    var_export($errors);*/
}
