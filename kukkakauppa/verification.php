<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <?php
    include "activation.php";
    ?>
    <div class="container">
        <h1>Sähköpostiosoitteen vahvistus</h1>

        <?php echo $email_already_verified; ?>
        <?php echo $email_verified; ?>
        <?php echo $activation_error; ?>

        <a href="<?php echo "http://$PALVELIN/$PALVELU/login.php"; ?>">Kirjaudu sisään</a>

    </div>
    <?php
    include "modules/footer.php"
    ?>
</body>

</html>