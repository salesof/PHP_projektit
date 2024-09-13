<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">
        <h1>Kirjaudu sisään</h1>

        <form novalidate method="POST">
            <fieldset>
                <label class="label-responsive">Sähköposti:
                    <input
                        type="email"
                        id="sahkoposti"
                        name="sahkoposti"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label>
                <br />

                <label class="label-responsive">Salasana:
                    <input
                        type="text"
                        id="nimi"
                        name="nimi"
                        pattern="[A-ZÅÄÖa-zåäö \-']{2,}"
                        required />
                    <span class="error" aria-live="polite"></span>
                </label>
                <br /><br />

                <input type="submit" value="Kirjaudu" />
            </fieldset>
        </form>

        <p><a href="salasanan-palautus.php" class="big-text">Salasana unohtunut?</a></p>
        <p><a href="rekisterointi.php" class="big-text">Luo uusi tunnus</a></p>

    </div>

    <?php
    $js = "script/index.js";
    include "modules/footer.php"
    ?>
</body>

</html>