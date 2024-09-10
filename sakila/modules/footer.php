<footer>
  <p>Copyright &copy; 2024 Sakila</p>
</footer>
<script src="script/nav.js"></script>
<?php if (isset($js)) echo "<script defer src='$js'></script>"; ?>
<script>
  function toggleMenu() {
    const navLinks = document.getElementById("navLinks");
    navLinks.classList.toggle("active");
  }
</script>