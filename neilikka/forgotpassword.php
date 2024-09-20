<!DOCTYPE html>
<html>
<?php include 'controllers/authController.php' ?>
<?php include "modules/head.php" ?>

<body>
  <?php include "modules/nav.php" ?>
  <?php include "modules/banner.php" ?>

  <div class="container">

    <h1>Salasanan palautus</h1>

    <form method="post" autocomplete="on" novalidate>
      <fieldset>

        <label for="email">Sähköpostiosoite:</label>
        <input type="email" name="email" id="email"
          placeholder="etunimi.sukunimi@palvelu.fi" value=""
          pattern="" autofocus required>
        <div class="error"></div>
        <br />

        <input type="submit" name="reset-request" value="Lähetä palautuslinkki">

      </fieldset>
    </form>

    <?php if (!empty($resetMessage)): ?>
      <p style="color:green;"><?php echo $resetMessage; ?></p>
    <?php endif; ?>

  </div>
  <?php
  include "modules/footer.php"
  ?>
</body>

</html>