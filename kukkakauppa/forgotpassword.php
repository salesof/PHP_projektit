<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>

<body>
  <?php include "modules/nav.php" ?>
  <?php include "modules/banner.php" ?>

  <?php
  /* 
1. Unohditko salasanan -linkki (forgotpassword.php) kirjautumislomakkeella (login.php).
2. forgotpassword.php -lomake ja kasittelija_forgotpassword.php 
3. salasanan asettamislinkki (resetpassword.php) ja resetpassword-token sähköpostilla
4. resetpassword.php -lomake ja kasittelija_resetpassword.php
*/
  $title = "Unohtunut salasana";
  $kentat = ['email'];
  $kentat_suomi = ['sähköpostiosoite'];
  $pakolliset = ['email'];
  include "virheilmoitukset.php";
  echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
  include('posti.php');
  include('kasittelija_forgotpassword.php');
  ?>
  <div class="container">

    <h1>Salasanan palautus</h1>

    <form method="post" autocomplete="on" novalidate>
      <fieldset>

        <label for="email">Sähköpostiosoite:</label>
        <input type="email" name="email" id="email"
          placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email"); ?>"
          pattern="<?= pattern('email'); ?>" autofocus required>
        <div class="error">
          <?= $errors['email'] ?? ""; ?>
        </div>
        <br />

        <input type="submit" name="painike" value="Lähetä palautuslinkki">

      </fieldset>
    </form>

  </div>
  <?php
  include "modules/footer.php"
  ?>
</body>

</html>