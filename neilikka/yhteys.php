<!DOCTYPE html>
<html>
<?php include "modules/head.php" ?>
  <body>
  <?php include "modules/nav.php" ?>
  <?php include "modules/banner.php" ?>

    <div class="container">
      <h1>Ota yhteyttä</h1>
      <p>
        Jos sinulla on kysyttävää tuotteistamme tai kaipaat apua oikeiden
        kasvien ja tarvikkeiden valinnassa, Puutarhaliike Neilikka on täällä
        auttamassa. Osaava henkilökuntamme vastaa mielellään kaikkiin
        kysymyksiisi, olipa kyse sitten sisäkasvien hoidosta, ulkokasvien
        istutuksesta tai oikeiden työkalujen valinnasta.
      </p>
      <p>Voit ottaa meihin yhteyttä</p>
      <ul>
        <li>puhelimitse yksittäisiin myymälöihin</li>
        <li>sähköpostitse: asiakaspalvelu@puutarhaliikeneilikka.fi</li>
        <li>alla olevalla lomakkeella</li>
      </ul>
      <p>
        Tavoitat meidät myös sosiaalisen median kanaviemme kautta, joissa jaamme
        säännöllisesti ajankohtaisia vinkkejä ja inspiraatiota puutarhanhoitoon.
        Tule käymään myymälöissämme Helsingissä ja Espoossa – meiltä saat
        henkilökohtaista palvelua ja asiantuntevaa neuvontaa kaikissa
        puutarha-asioissa!
      </p>

      <form novalidate method="POST">
        <fieldset>
          <legend>Yhteydenottolomake</legend>
          <label class="label-responsive"
            >Nimi:
            <input
              type="text"
              id="nimi"
              name="nimi"
              pattern="[A-ZÅÄÖa-zåäö \-']{2,}"
              required
            />
            <span class="error" aria-live="polite"></span> </label
          ><br />

          <label class="label-responsive"
            >Sähköposti:
            <input
              type="email"
              id="sahkoposti"
              name="sahkoposti"
              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              required
            />
            <span class="error" aria-live="polite"></span> </label
          ><br /><br />

          <label class="label-additional"
            >Aihe:
            <select id="aihe" name="aihe" required>
              <option value="" disabled selected>Valitse</option>
              <option value="tuotekysymys">Kysymys tuotteista</option>
              <option value="tilaus">Tilaus</option>
              <option value="yhteydenotto">Yhteydenottopyyntö</option>
              <option value="muu">Muu</option>
            </select>
            <span class="error" aria-live="polite"></span></label
          ><br />

          <label class="label-additional"
            >Viesti:<br />
            <textarea
              id="viesti"
              name="viesti"
              required
              rows="4"
              cols=""
            ></textarea>
            <span class="error" aria-live="polite"></span></label
          ><br /><br />

          <label class="label-additional"
            >Haluan tilata Puutarhaliike Neilikan uutiskirjeen<br />
            <p class="label-wrapper">
              <input
                type="radio"
                id="kylla"
                name="uutiskirje"
                value="kylla"
                checked
              />
              <label for="kylla">Kyllä</label><br />
              <input type="radio" id="ei" name="uutiskirje" value="ei" />
              <label for="ei">Ei</label>
            </p>
          </label>
          <br />

          <input type="submit" value="Lähetä" />
        </fieldset>
      </form>
    </div>
    <?php
      $js = "script/yhteys.js";
      include "modules/footer.php"
    ?>
  </body>
</html>
