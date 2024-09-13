<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">
        <h1>Salasanan palautus</h1>

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
                <br /><br />

                <input type="submit" value="Lähetä palautuslinkki" />
            </fieldset>
        </form>

    </div>

    <?php
    $js = "script/index.js";
    include "modules/footer.php"
    ?>
</body>

</html>