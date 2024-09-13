<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <?php
    /* Huom. Tässä salasanakenttien täsmääminen tarkistetaan vain palvelimella. */
    $tietokanta = "neilikka";
    $kentat = ['firstname', 'lastname', 'email', 'password', 'password2'];
    $kentat_suomi = ['etunimi', 'sukunimi', 'sähköpostiosoite', 'salasana', 'salasana2'];
    $pakolliset = ['firstname', 'lastname', 'email', 'password', 'password2'];

    include "virheilmoitukset.php";
    echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
    include "email.php";
    include "register_handling.php";
    ?>

    <div class="container">
        <h1>Luo tunnus</h1>

        <?php if ($success != "success") { ?>

            <form novalidate method="POST">
                <fieldset>
                    <label class="label-responsive">Etunimi:
                        <input
                            type="text"
                            id="etunimi"
                            name="etunimi"
                            pattern="[A-ZÅÄÖa-zåäö \-']{2,}"
                            required />
                        <span class="error" aria-live="polite"></span>
                    </label>
                    <br />

                    <label class="label-responsive">Sukunimi:
                        <input
                            type="text"
                            id="sukunimi"
                            name="sukunimi"
                            pattern="[A-ZÅÄÖa-zåäö \-']{2,}"
                            required />
                        <span class="error" aria-live="polite"></span>
                    </label>
                    <br />

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
                            id="salasana"
                            name="salasana"
                            pattern=".{10,}"
                            required />
                        <span class="error" aria-live="polite"></span>
                    </label>
                    <br />

                    <label class="label-responsive">Salasana uudestaan:
                        <input
                            type="text"
                            id="salasana2"
                            name="salasana2"
                            pattern=".{10,}"
                            required />
                        <span class="error" aria-live="polite"></span>
                    </label>
                    <br />
                    <br /><br />

                    <input type="submit" value="Luo tunnus" />
                </fieldset>
            </form>

        <?php } ?>

        <div id="ilmoitukset" class="alert alert-<?= $success; ?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
            <p><?= $message; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </div>

    <?php
    $js = "script/index.js";
    include "modules/footer.php"
    ?>
</body>

</html>