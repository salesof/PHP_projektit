<footer>
  <div class="footer-wrapper">
    <div class="footer-block">
      <p class="bold">Puutarhaliike Neilikka, Helsinki</p>
      <p>Fabianinkatu 42</p>
      <p>00100 Helsinki</p>
      <br />
      <p>Puh. xx-xxxxxxx</p>
      <p>helsinki@puutarhaliikeneilikka.fi</p>
    </div>
    <div class="footer-block">
      <p class="bold">Puutarhaliike Neilikka, Espoo</p>
      <p>Kivenlahdentie 10</p>
      <p>01234 Espoo</p>
      <br />
      <p>Puh. xx-xxxxxxx</p>
      <p>espoo@puutarhaliikeneilikka.fi</p>
    </div>
  </div>
  <p>Copyright &copy; 2024 Puutarhaliike Neilikka</p>
</footer>
<script src="script/nav.js"></script>
<?php if (isset($js)) echo "<script defer src='$js'></script>"; ?>
<script>
  function toggleMenu() {
    const navLinks = document.getElementById("navLinks");
    navLinks.classList.toggle("active");
  }
</script>