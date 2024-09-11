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
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-additional">Elokuvan kuvaus:<br />
                    <textarea
                        id="description"
                        name="description"
                        required
                        rows="4"
                        cols=""></textarea>
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan julkaisuvuosi:
                    <input
                        type="number"
                        id="release_year"
                        name="release_year"
                        pattern="^\d{4}$"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-additional">Elokuvan kieli:
                    <select id="language" name="language" required>
                        <option value="" disabled selected>Valitse</option>
                        <option value="English">Englanti</option>
                        <option value="Italian">Italia</option>
                        <option value="Japanese">Japani</option>
                        <option value="Mandarin">Mandariinikiina</option>
                        <option value="French">Ranska</option>
                        <option value="German">Saksa</option>
                    </select>
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan vuokra-aika päivinä:
                    <input
                        type="number"
                        id="rental_duration"
                        name="rental_duration"
                        pattern="^\d+$"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan vuokrahinta:
                    <input
                        type="text"
                        id="rental_rate"
                        name="rental_rate"
                        pattern="^\d+(\.\d{1,2})?$"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan pituus minuutteina:
                    <input
                        type="number"
                        id="length"
                        name="length"
                        pattern="^\d+$"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan korvaushinta:
                    <input
                        type="number"
                        id="replacement_cost"
                        name="replacement_cost"
                        pattern="^\d+(\.\d{1,2})?$"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-additional">Elokuvan ikäraja:
                    <select id="rating" name="rating" required>
                        <option value="" disabled selected>Valitse</option>
                        <option value="G">G</option>
                        <option value="PG">PG</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R</option>
                        <option value="NC-17">NC-17</option>
                    </select>
                    <span class="error" aria-live="polite"></span>
                </label><br />

                <label class="label-responsive">Elokuvan mahdollinen bonus-sisältö:
                    <p class="label-wrapper">
                        <input type="checkbox" id="special_features1" name="special_features1" value="Deleted Scenes">
                        <label for="special_features1"> Deleted Scenes</label><br />
                        <input type="checkbox" id="special_features2" name="special_features2" value="Behind the Scenes">
                        <label for="special_features2"> Behind the Scenes</label><br />
                        <input type="checkbox" id="special_features3" name="special_features3" value="Trailers">
                        <label for="special_features3"> Trailers</label><br />
                        <input type="checkbox" id="special_features4" name="special_features4" value="Commentaries">
                        <label for="special_features4"> Commentaries</label>
                    </p>
                    <span class="error" aria-live="polite"></span>
                </label>

                <br />

                <input type="submit" value="Lähetä" />
            </fieldset>
        </form>

        <?php

        ?>
    </div>

    <?php
    $js = "script/lisaa.js";
    include "modules/footer.php"
    ?>
</body>

</html>