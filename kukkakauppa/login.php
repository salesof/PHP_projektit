<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
  <?php include "modules/nav.php" ?>
  <?php include "modules/banner.php" ?>

  <?php
  if ($loggedIn = loggedIn()) {
    header("location: profiili.php");
    exit;
  }

  /* Lomakkeen kentät, nimet samat kuin users-taulussa. */
  $kentat = ['email', 'password', 'rememberme'];
  $kentat_suomi = ['sähköpostiosoite', 'salasana', 'muista minut'];
  $pakolliset = ['email', 'password'];
  include "virheilmoitukset.php";
  include 'kasittelija_login.php';
  echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
  debuggeri($errors);
  ?>
  <div class="container">

    <h1>Kirjaudu sisään</h1>

    <form method="post" autocomplete="on" class="login-form" novalidate>
      <fieldset>

        <label for="email">Sähköpostiosoite:</label>
        <input type="email" class="<?= is_invalid('email'); ?>" name="email" id="email"
          placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email"); ?>"
          pattern="<?= pattern('email'); ?>" autofocus required>
        <div class="error">
          <?= $errors['email'] ?? ""; ?>
        </div>

        <label for="password">Salasana:</label>
        <input type="password" class="<?= is_invalid('password'); ?>" name="password" id="password"
          placeholder="salasana" pattern="<?= pattern('password'); ?>" required>
        <div class="error">
          <?= $errors['password'] ?? ""; ?>
        </div>


        <input type="checkbox" <?= nayta_rememberme('rememberme'); ?> id="rememberme" name="rememberme" />
        <label for="rememberme">Muista minut</label>
        <div class="error">
          <?= $errors['rememberme'] ?? ""; ?>
        </div>
        <br />

        <input type="submit" name="painike" value="Kirjaudu">

      </fieldset>
    </form>

    <p><a href="forgotpassword.php" class="big-text">Salasana unohtunut?</a></p>
    <p><a href="rekisteroitymislomake.php" class="big-text">Luo uusi tunnus</a></p>

  </div>
  <?php
  include "modules/footer.php"
  ?>
</body>

</html>