<?php include 'controllers/authController.php' ?>
<?php
// redirect user to login page if they're not logged in
if (empty($_SESSION['id'])) {
    header('location: kirjaudu.php');
}
?>

<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
    <?php include "modules/nav.php" ?>
    <?php include "modules/banner.php" ?>

    <div class="container">

        <h1>Vahvista sähköpostiosoitteesi</h1>

        <?php if (!$_SESSION['verified']): ?>
            <div>
                Sinun täytyy vahvistaa vielä sähköpostiosoitteesi!
                Kirjaudu sähköpostitilillesi ja klikkaa vahvistuslinkkiä,
                jonka lähetimme osoitteeseen
                <strong><?php echo $_SESSION['email']; ?></strong>
            </div>
        <?php else: ?>
            Kiitos, sähköpostiosoitteesi on nyt vahvistettu!
        <?php endif; ?>

    </div>
    <?php
    include "modules/footer.php"
    ?>
</body>

</html>