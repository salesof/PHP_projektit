<nav>
  <div class="logo">
    <a href="index.php"><img src="img/logo.png" /></a>
  </div>
  <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
  <ul class="nav-links" id="navLinks">
    <li><a href="index.php">Etusivu</a></li>
    <li>
      <div class="dropdown">
        <button class="dropbtn">
          <a href="tuotteet.php">Tuotteet &#x25BE;</a>
        </button>
        <div class="dropdown-content">
          <a href="sisakasvit.php">Sisäkasvit</a>
          <a href="ulkokasvit.php">Ulkokasvit</a>
          <a href="tyokalut.php">Työkalut</a>
          <a href="hoito.php">Kasvien hoito</a>
        </div>
      </div>
    </li>
    <li><a href="myymalat.php">Myymälät</a></li>
    <li><a href="tietoa.php">Tietoa Meistä</a></li>
    <li><a href="uutiset.php">Uutiset</a></li>
    <li><a href="yhteys.php">Yhteydenotto</a></li>

    <?php
    /*if ($loggedIn === 'admin') {
  echo "<a class='".active('kayttajat',$active). "' href='kayttajat.php'>Käyttäjät</a>";
  }
if ($loggedIn) {
  echo "<a class='".active('profiili',$active). "' href='profiili.php'>Profiili</a>";
  echo '<a class="nav-suojaus" href="poistu.php">Poistu</a>';
  }
if (!$loggedIn) {
  echo "<a class='nav-suojaus ".active('login',$active)."' href='login.php'>Kirjautuminen</a>";
  }*/

    switch ($loggedIn) {
      case 'admin':
        echo "<li><a class='" . active('kayttajat', $active) . "' href='kayttajat.php'>Käyttäjät</a></li>";
      case true:
        echo "<li><a class='" . active('profiili', $active) . "' href='profiili.php'>Profiili</a></li>";
        echo "<li><a class='nav-suojaus " . active('phpinfo', $active) . "' href='phpinfo.php'>phpinfo</a></li>";
        echo "<li><a class='" . active('fake', $active) . "' href='fake.php'>fake</a></li>";
        echo '<li><a href="poistu.php">Poistu</a></li>';
        break;
      default:
        echo "<li><a class='nav-suojaus " . active('login', $active) . "' href='login.php'>Kirjautuminen</a></li>";
        break;
    }
    ?>
  </ul>
</nav>