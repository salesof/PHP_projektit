<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
function active($page, $currentPage)
{
  return $page === $currentPage ? 'active' : '';
}

$active = basename($_SERVER['PHP_SELF'], '.php'); // Määritellään aktiivinen sivu
$loggedIn = $_SESSION['loggedIn'] ?? false; // Hae sessiosta, onko käyttäjä kirjautunut
?>

<nav class="main-nav">
  <div class="menu-wrapper">
    <!-- Logo -->
    <div class="logo">
      <a href="index.php"><img src="img/logo.png" alt="Neilikka logo" /></a>
    </div>

    <!-- Käyttäjätiliin liittyvät linkit -->
    <ul class="user-nav-links">
      <?php
      switch ($loggedIn) {
        case 'admin':
          // Näytetään adminille tarkoitettu linkki, kuten Käyttäjät-sivu
          echo "<li><i class='fa fa-users'></i><a class='" . active('kayttajat', $active) . "' href='kayttajat.php'>Käyttäjät</a></li>";
          // Fall-through tarkoituksella, jotta admin näkee myös tavallisen käyttäjän linkit

        case true:
          // Näytetään profiili ja uloskirjautumislinkit sisäänkirjautuneelle käyttäjälle (myös adminille)
          echo "<li><i class='fa fa-user-circle'></i><a class='" . active('profiili', $active) . "' href='profiili.php'>Profiili</a></li>";
          echo "<li><i class='fa fa-power-off'></i><a href='poistu.php'>Kirjaudu ulos</a></li>";
          break;

        default:
          // Näytetään kirjautumissivu, jos käyttäjä ei ole kirjautunut sisään
          echo "<li><i class='fa fa-sign-in'></i><a class='nav-suojaus " . active('kirjaudu', $active) . "' href='kirjaudu.php'>Kirjautuminen</a></li>";
          break;
      }
      ?>
    </ul>

    <!-- Sivuston päälinkit -->
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
    <ul class="nav-links" id="navLinks">
      <li><a class="<?php echo active('index', $active); ?>" href="index.php">Etusivu</a></li>
      <li>
        <div class="dropdown">
          <button class="dropbtn">
            <a class="<?php echo active('tuotteet', $active); ?>" href="tuotteet.php">Tuotteet &#x25BE;</a>
          </button>
          <div class="dropdown-content">
            <a class="<?php echo active('sisakasvit', $active); ?>" href="sisakasvit.php">Sisäkasvit</a>
            <a class="<?php echo active('ulkokasvit', $active); ?>" href="ulkokasvit.php">Ulkokasvit</a>
            <a class="<?php echo active('tyokalut', $active); ?>" href="tyokalut.php">Työkalut</a>
            <a class="<?php echo active('hoito', $active); ?>" href="hoito.php">Kasvien hoito</a>
          </div>
        </div>
      </li>
      <li><a class="<?php echo active('myymalat', $active); ?>" href="myymalat.php">Myymälät</a></li>
      <li><a class="<?php echo active('tietoa', $active); ?>" href="tietoa.php">Tietoa Meistä</a></li>
      <li><a class="<?php echo active('uutiset', $active); ?>" href="uutiset.php">Uutiset</a></li>
      <li><a class="<?php echo active('yhteys', $active); ?>" href="yhteys.php">Yhteydenotto</a></li>
    </ul>
  </div>
</nav>