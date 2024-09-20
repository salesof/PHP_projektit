<!DOCTYPE html>
<html>
<?php include 'controllers/authController.php' ?>
<?php include "modules/head.php" ?>

<body>
  <?php include "modules/nav.php" ?>
  <?php include "modules/banner.php" ?>

  <div class="container">

    <h1>Kirjaudu sisään</h1>

    <?php if (count($errors) > 0): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
          <li>
            <?php echo $error; ?>
          </li>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" autocomplete="on" class="login-form" novalidate>
      <fieldset>

        <label for="email">Sähköpostiosoite:</label>
        <input type="email" class="" name="email" id="email"
          placeholder="etunimi.sukunimi@palvelu.fi" value=""
          pattern="" autofocus required>
        <div class="error"></div>

        <label for="password">Salasana:</label>
        <input type="password" class="" name="password" id="password"
          placeholder="salasana" pattern="" required>
        <div class="error"></div>


        <!--<input type="checkbox" id="rememberme" name="rememberme" />
        <label for="rememberme">Muista minut</label>
        <div class="error"></div>-->
        <br />

        <input type="submit" name="login" value="Kirjaudu">

      </fieldset>
    </form>

    <p><a href="forgotpassword.php" class="big-text">Salasana unohtunut?</a></p>
    <p><a href="rekisteroidy.php" class="big-text">Luo uusi tunnus</a></p>

  </div>
  <?php
  include "modules/footer.php"
  ?>
</body>

</html>