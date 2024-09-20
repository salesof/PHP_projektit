<!DOCTYPE html>
<html>
<?php include 'controllers/authController.php' ?>
<?php include "modules/head.php" ?>

<body>
       <?php include "modules/nav.php" ?>
       <?php include "modules/banner.php" ?>

       <div class="container">
              <h1>Luo uusi tunnus sivustolle</h1>

              <form method="post" novalidate enctype="multipart/form-data" autocomplete="on">
                     <fieldset>
                            <label for="firstname">Etunimi:</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Etunimi" value="<?php echo htmlspecialchars($firstname ?? '', ENT_QUOTES); ?>" required autofocus>
                            <div class="error">
                                   <?php if (isset($errors['firstname'])): ?>
                                          <?php echo $errors['firstname']; ?>
                                   <?php endif; ?>
                            </div>

                            <label for="lastname">Sukunimi:</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Sukunimi" value="<?php echo htmlspecialchars($lastname ?? '', ENT_QUOTES); ?>" required>
                            <div class="error">
                                   <?php if (isset($errors['lastname'])): ?>
                                          <?php echo $errors['lastname']; ?>
                                   <?php endif; ?>
                            </div>

                            <label for="email">Sähköpostiosoite:</label>
                            <input type="email" name="email" id="email" placeholder="etunimi.sukunimi@palvelu.fi" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>" required>
                            <div class="error">
                                   <?php if (isset($errors['email'])): ?>
                                          <?php echo $errors['email']; ?>
                                   <?php endif; ?>
                            </div>

                            <label for="password">Salasana:</label>
                            <input type="password" name="password" id="password" placeholder="Salasana" required>
                            <div class="error">
                                   <?php if (isset($errors['password'])): ?>
                                          <?php echo $errors['password']; ?>
                                   <?php endif; ?>
                            </div>

                            <label for="passwordConf">Salasana uudestaan:</label>
                            <input type="password" name="passwordConf" id="passwordConf" placeholder="Salasana uudestaan" required>
                            <div class="error">
                                   <?php if (isset($errors['passwordConf'])): ?>
                                          <?php echo $errors['passwordConf']; ?>
                                   <?php endif; ?>
                            </div>

                            <label for="image">Kuva:</label><br />
                            <input id="image" name="image" type="file" class="img-button" accept="image/*">
                            <div class="error">
                                   <?php if (isset($errors['image'])): ?>
                                          <?php echo $errors['image']; ?>
                                   <?php endif; ?>
                            </div>
                            <br />

                            <input name='signup' type="submit" value='Luo tunnus'></input>
                     </fieldset>
              </form>
       </div>

       <?php include "modules/footer.php" ?>
</body>

</html>