<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">

        <h1>Lisää elokuva</h1>
        <form novalidate method="POST">
            <fieldset>
                <label class="label-responsive">Elokuvan nimi:
                    <input
                        type="text"
                        id="title"
                        name="title"
                        pattern="^[A-Za-z0-9\s]{2,}$"
                        value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-additional">Elokuvan kuvaus:<br />
                    <textarea id="description" name="description" required rows="4"><?php echo ($_POST['description'] ?? '') ?></textarea>
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan julkaisuvuosi:
                    <input
                        type="number"
                        id="release_year"
                        name="release_year"
                        pattern="^\d{4}$"
                        value="<?= htmlspecialchars($_POST['release_year'] ?? '') ?>"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-additional">Elokuvan kieli:
                    <select id="language" name="language_id" required>
                        <option value="" disabled selected>Valitse</option>
                        <option value="1" <?= (isset($_POST['language_id']) && $_POST['language_id'] == '1') ? 'selected' : '' ?>>Englanti</option>
                        <option value="2" <?= (isset($_POST['language_id']) && $_POST['language_id'] == '2') ? 'selected' : '' ?>>Italia</option>
                        <option value="3" <?= (isset($_POST['language_id']) && $_POST['language_id'] == '3') ? 'selected' : '' ?>>Japani</option>
                        <option value="4" <?= (isset($_POST['language_id']) && $_POST['language_id'] == '4') ? 'selected' : '' ?>>Mandariinikiina</option>
                        <option value="5" <?= (isset($_POST['language_id']) && $_POST['language_id'] == '5') ? 'selected' : '' ?>>Ranska</option>
                        <option value="6" <?= (isset($_POST['language_id']) && $_POST['language_id'] == '6') ? 'selected' : '' ?>>Saksa</option>
                    </select>
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan vuokra-aika päivinä:
                    <input
                        type="number"
                        id="rental_duration"
                        name="rental_duration"
                        pattern="^\d+$"
                        value="<?= htmlspecialchars($_POST['rental_duration'] ?? '') ?>"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan vuokrahinta:
                    <input
                        type="text"
                        id="rental_rate"
                        name="rental_rate"
                        pattern="^\d+(\.\d{1,2})?$"
                        value="<?= htmlspecialchars($_POST['rental_rate'] ?? '') ?>"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan pituus minuutteina:
                    <input
                        type="number"
                        id="length"
                        name="length"
                        pattern="^\d+$"
                        value="<?= htmlspecialchars($_POST['length'] ?? '') ?>"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan korvaushinta:
                    <input
                        type="number"
                        id="replacement_cost"
                        name="replacement_cost"
                        pattern="^\d+(\.\d{1,2})?$"
                        value="<?= htmlspecialchars($_POST['replacement_cost'] ?? '') ?>"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-additional">Elokuvan ikäraja:
                    <select id="rating" name="rating" required>
                        <option value="" disabled selected>Valitse</option>
                        <option value="G" <?= (isset($_POST['rating']) && $_POST['rating'] == 'G') ? 'selected' : '' ?>>G</option>
                        <option value="PG" <?= (isset($_POST['rating']) && $_POST['rating'] == 'PG') ? 'selected' : '' ?>>PG</option>
                        <option value="PG-13" <?= (isset($_POST['rating']) && $_POST['rating'] == 'PG-13') ? 'selected' : '' ?>>PG-13</option>
                        <option value="R" <?= (isset($_POST['rating']) && $_POST['rating'] == 'R') ? 'selected' : '' ?>>R</option>
                        <option value="NC-17" <?= (isset($_POST['rating']) && $_POST['rating'] == 'NC-17') ? 'selected' : '' ?>>NC-17</option>
                    </select>
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan mahdollinen bonus-sisältö:
                    <p class="label-wrapper">
                        <input type="checkbox" id="special_features1" name="special_features[]" value="Deleted Scenes"
                            <?php if (isset($_POST['special_features']) && in_array('Deleted Scenes', $_POST['special_features'])) echo 'checked'; ?>>
                        <label for="special_features1"> Deleted Scenes</label><br />

                        <input type="checkbox" id="special_features2" name="special_features[]" value="Behind the Scenes"
                            <?php if (isset($_POST['special_features']) && in_array('Behind the Scenes', $_POST['special_features'])) echo 'checked'; ?>>
                        <label for="special_features2"> Behind the Scenes</label><br />

                        <input type="checkbox" id="special_features3" name="special_features[]" value="Trailers"
                            <?php if (isset($_POST['special_features']) && in_array('Trailers', $_POST['special_features'])) echo 'checked'; ?>>
                        <label for="special_features3"> Trailers</label><br />

                        <input type="checkbox" id="special_features4" name="special_features[]" value="Commentaries"
                            <?php if (isset($_POST['special_features']) && in_array('Commentaries', $_POST['special_features'])) echo 'checked'; ?>>
                        <label for="special_features4"> Commentaries</label>
                    </p>
                    <span class="error" aria-live="polite"></span>
                </label>
                <br />

                <input type="submit" name="painike" value="Lisää" />
            </fieldset>
        </form>

        <?php
        if (isset($_POST['painike'])) {
            $tietokanta = "sakila";
            include 'debugger.php';
            include 'db-routines.php';
            include 'modules/form-validation.php';
            register_shutdown_function('debugger_shutdown');

            // Taking all values from the form data (input)
            $title = $_POST['title'];
            $description = $_POST['description'];
            $release_year = $_POST['release_year'];
            $language_id = (int)$_POST['language_id'];
            $rental_duration = $_POST['rental_duration'];
            $rental_rate = $_POST['rental_rate'];
            $length = $_POST['length'];
            $replacement_cost = $_POST['replacement_cost'];
            $rating = $_POST['rating'];

            // Combine selected special features into a single string
            $special_features = isset($_POST['special_features']) ? implode(",", $_POST['special_features']) : "";

            // Suorita validointi
            $validation_result = validate_film($_POST, $yhteys);
            $errors = $validation_result['errors'];
            $data = $validation_result['data'];

            // Jos validointi epäonnistui, näytetään virheet
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p class='error' style='padding: 5px'>$error</p>";
                }
            } else {
                // Jos validointi onnistui, suoritetaan tietokantakysely
                $query = "INSERT INTO film (title, description, rating, release_year, language_id, rental_duration, rental_rate, length, replacement_cost, special_features)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                if ($stmt = $yhteys->prepare($query)) {
                    $stmt->bind_param(
                        // Bind parameters (sssiidsdss for string, string, string, int, int, int, double, int, double, string)
                        "sssiidsdss",
                        $data['title'],
                        $data['description'],
                        $data['rating'],
                        $data['release_year'],
                        $data['language_id'],
                        $data['rental_duration'],
                        $data['rental_rate'],
                        $data['length'],
                        $data['replacement_cost'],
                        $data['special_features']
                    );

                    if ($stmt->execute()) {
                        echo "<h2 class='success'>Elokuva lisätty!</h2>";
                    } else {
                        echo "<h2 class='failure'>Elokuvan lisäys ei onnistunut: " . $stmt->error . "</h2>";
                    }

                    $stmt->close();
                } else {
                    echo "<h2 class='failure'>Elokuvan lisäys ei onnistunut: " . $yhteys->error . "</h2>";
                }
            }
        }
        ?>
    </div>

    <?php
    $js = "script/lisaa.js";
    include "modules/footer.php"
    ?>
</body>

</html>