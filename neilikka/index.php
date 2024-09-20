<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>
  <body>
  <?php include "modules/nav.php" ?>
  <?php include "modules/banner.php" ?>

    <div class="container">
      <h1>Etusivu</h1>
      <p>
        Tervetuloa Puutarhaliike Neilikan kotisivuille! Meiltä löydät sekä sisä-
        että ulkokasvit ja kaiken tarvitsemasi kasvien hoitoon.
      </p>

      <p>
        Olipa toiveissasi vehreä viidakko sisätiloihin, värikäs kukkaloisto
        parvekkeelle tai upea piha- ja puutarhakokonaisuus, Puutarhaliike
        Neilikka auttaa sinua toteuttamaan unelmasi. Asiantunteva
        henkilökuntamme on apunasi valitsemassa juuri sinun tarpeisiisi sopivat
        kasvit ja hoitotuotteet, jotka menestyvät niin kotona kuin ulkona.
        Laajasta valikoimastamme löydät myös laadukkaat työkalut ja tarvikkeet,
        jotka tekevät puutarhatöistä vaivattomia ja mukavia.
      </p>
      <p>
        Tutustu rauhassa tuotteisiimme ja palveluihimme verkkosivuillamme tai
        tule käymään myymälässämme! Tarjoamme inspiraatiota, vinkkejä ja ideoita
        kaikenlaisille viherpeukaloille. Puutarhaliike Neilikka on täällä
        auttamassa sinua luomaan omasta ympäristöstäsi kauniin ja viihtyisän
        keitaan – juuri sellaisen, josta olet aina haaveillut.
      </p>

      <h2>Uutisia</h2>

      <div class="flex-wrapper"></div>

      <!-- Old page content without db.json
      <div class="flex-wrapper">
        <div class="news-block">
          <img src="img/news10.jpg" />
          <p class="news-date">4.9.2024</p>
          <p>
            Tule hankkimaan kukkasipulit kevättä varten! Meiltä löydät nyt
            laajan valikoiman tulppaanien, narsissien, krookusten ja muiden
            kevään kukkien sipuleita edulliseen hintaan.
          </p>
        </div>

        <div class="news-block">
          <img src="img/news9.jpg" />
          <p class="news-date">3.7.2024</p>
          <p>
            Puutarhakasvien karsiminen kannattaa aloittaa hyvissä ajoin! Meiltä
            löydät kaikki tarvittavat työvälineet pitääksesi pihasi siistinä.
          </p>
        </div>

        <div class="news-block">
          <img src="img/news8.jpg" />
          <p class="news-date">1.6.2024</p>
          <p>
            Onnea tänään valmistuville! Muista juhlasankareita kauniilla
            ruusuilla ja kukkakimpuilla vierailemalla liikkeissämme.
          </p>
        </div>

        <div class="news-block">
          <img src="img/news7.jpg" />
          <p class="news-date">15.2.2024</p>
          <p>
            Kevään lähestyessä on aika pistää kädet multaan ja hoitaa
            sisäkasvien mullanvaihto. Autamme tarvittaessa valitsemaan oikean
            mullan kasvillesi.
          </p>
        </div>

        <div class="news-block">
          <img src="img/news6.jpg" />
          <p class="news-date">2.1.2024</p>
          <p>
            Hyvää uutta vuotta! Uuden vuoden kunniaksi myymälöissämme upeita
            tarjouksia.
          </p>
        </div>

        <div class="news-block">
          <img src="img/news5.jpg" />
          <p class="news-date">14.12.2023</p>
          <p>
            Joulukukat edullisesti meiltä. Myymälöissämme myös kattava ja
            edullinen valikoima joulukuusia.
          </p>
        </div>
      </div>
      -->

      <div class="center-block">
        <a href="uutiset.php"><button>Näytä kaikki uutiset</button></a>
      </div>
    </div>

    <?php
      $js = "script/index.js";
      include "modules/footer.php"
    ?>
  </body>
</html>
