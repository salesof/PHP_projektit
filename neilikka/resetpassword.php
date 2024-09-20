<!DOCTYPE html>
<html>
<?php include 'controllers/authController.php'; ?>
<?php include "modules/head.php"; ?>

<body>
       <?php include "modules/nav.php"; ?>
       <?php include "modules/banner.php"; ?>

       <div class="container">
              <h1>Vaihda salasanasi</h1>

              <!-- Lomake salasanan vaihtamiseen -->
              <form method="post">
                     <fieldset>

                            <!-- Token hidden field -->
                            <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">

                            <label for="new_password">Uusi salasana:</label>
                            <input type="password" name="new_password" id="new_password" required>

                            <label for="new_passwordConf">Vahvista uusi salasana:</label>
                            <input type="password" name="new_passwordConf" id="new_passwordConf" required>

                            <!-- Submit-painike, jolla oikea name -->
                            <input type="submit" name="reset-password" value="Vaihda salasana">

                     </fieldset>
              </form>

              <!-- Näytä virheviestit -->
              <?php if (!empty($errors)): ?>
                     <div class="error">
                            <?php foreach ($errors as $error): ?>
                                   <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                     </div>
              <?php endif; ?>

              <?php if (!empty($resetMessage)): ?>
                     <p style="color:green;"><?php echo $resetMessage; ?></p>
              <?php endif; ?>

       </div>

       <?php include "modules/footer.php"; ?>
</body>

</html>