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
       $kentat_suomi = ['etunimi', 'sukunimi', 'sähköpostiosoite', 'salasana', 'salasana'];
       $pakolliset = ['firstname', 'lastname', 'email', 'password', 'password2'];

       $kentat_tiedosto = ['image'];
       include "virheilmoitukset.php";
       echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
       include "posti.php";
       include "rekisterointi.php";
       ?>

       <div class="container">

              <h1>Luo tunnus palveluun</h1>

              <?php
              if ($success != "success") { ?>

                     <form method="post" novalidate enctype="multipart/form-data" autocomplete="on">

                            <fieldset>

                                   <label for="firstname">Etunimi:</label>
                                   <input pattern="<?= pattern("firstname"); ?>" type="text" class="<?= is_invalid('firstname'); ?>"
                                          name="firstname" id="firstname" placeholder="Etunimi" value="<?= arvo("firstname"); ?>"
                                          required autofocus>
                                   <div class="error">
                                          <?= $errors['firstname'] ?? ""; ?>
                                   </div>

                                   <label for="lastname">Sukunimi:</label>
                                   <input type="text" class="<?= is_invalid('lastname'); ?>" name="lastname" id="lastname"
                                          placeholder="Sukunimi" value="<?= arvo("lastname"); ?>" required>
                                   <div class="error">
                                          <?= $errors['lastname'] ?? ""; ?>
                                   </div>

                                   <label for="email">Sähköpostiosoite:</label>
                                   <input type="email" class="<?= is_invalid('email'); ?>" name="email" id="email"
                                          placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email"); ?>"
                                          pattern="<?= pattern('email'); ?>" required>
                                   <div class="error">
                                          <?= $errors['email'] ?? ""; ?>
                                   </div>

                                   <label for="password">Salasana:</label>
                                   <input type="password" class="<?= is_invalid('password'); ?>" name="password" id="password"
                                          placeholder="salasana" pattern="<?= pattern('password'); ?>" required>
                                   <div class="error">
                                          <?= $errors['password'] ?? ""; ?>
                                   </div>

                                   <label for="password2">Salasana uudestaan:</label>
                                   <input type="password" class="<?= is_invalid('password2'); ?>" name="password2" id="password2"
                                          placeholder="salasana uudestaan" pattern="<?= pattern('password2'); ?>" required>
                                   <div class="error">
                                          <?= $errors['password2'] ?? ""; ?>
                                   </div>

                                   <label for="image">Kuva:</label><br />
                                   <input id="image" name="image" type="file" accept="image/*" pattern="<?= pattern('image'); ?>"
                                          class="<?= is_invalid('image'); ?>" placeholder="kuva"></input>
                                   <div class="error">
                                          <?= $errors['image'] ?? ""; ?>
                                   </div>
                                   <br />

                                   <input name='painike' type="submit" value='Luo tunnus'></input>
                            </fieldset>
                     </form>

              <?php } ?>

       </div>
       <?php
       include "modules/footer.php"
       ?>
</body>

</html>