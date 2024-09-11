document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const titleInput = document.getElementById("title");
  const descriptionInput = document.getElementById("description");
  const release_yearSelect = document.getElementById("release_year");
  const languageSelect = document.getElementById("language");
  const rental_durationSelect = document.getElementById("rental_duration");
  const rental_rateSelect = document.getElementById("rental_rate");
  const lengthSelect = document.getElementById("length");
  const replacement_costSelect = document.getElementById("replacement_cost");
  const ratingSelect = document.getElementById("rating");

  const titleError = document.querySelector("#title + .error");
  const descriptionError = document.querySelector("#description + .error");
  const release_yearError = document.querySelector("#release_year + .error");
  const languageError = document.querySelector("#language + .error");
  const rental_durationError = document.querySelector(
    "#rental_duration + .error"
  );
  const rental_rateError = document.querySelector("#rental_rate + .error");
  const lengthError = document.querySelector("#length + .error");
  const replacement_costError = document.querySelector(
    "#replacement_cost + .error"
  );
  const ratingError = document.querySelector("#rating + .error");

  function updateErrorPadding(errorSpan) {
    if (errorSpan.textContent.trim() !== "") {
      errorSpan.style.padding = "5px";
      errorSpan.style.display = "block";
    } else {
      errorSpan.style.padding = "0";
    }
  }

  titleInput.addEventListener("input", function () {
    if (titleInput.value.trim() === "") {
      titleError.textContent = "Nimi on pakollinen kenttä.";
    } else if (!/^[A-Za-z0-9\s]{2,}$/.test(titleInput.value)) {
      titleError.textContent =
        "Kirjoita elokuvan nimi (väh. 2 merkkiä) ilman erikoismerkkejä.";
    } else {
      titleError.textContent = "";
    }
    updateErrorPadding(titleError);
  });

  // Validate the description field
  descriptionInput.addEventListener("input", function () {
    if (descriptionInput.value.trim() === "") {
      descriptionError.textContent = "Kuvaus on pakollinen kenttä.";
    } else if (descriptionInput.value.length < 3) {
      descriptionError.textContent =
        "Kuvauksen tulee olla vähintään 3 merkkiä pitkä.";
    } else if (descriptionInput.value.length > 500) {
      descriptionError.textContent =
        "Kuvauksen pituus ei saa ylittää 500 merkkiä.";
    } else {
      descriptionError.textContent = "";
    }
    updateErrorPadding(descriptionError);
  });

  // Validate the release year field
  release_yearSelect.addEventListener("input", function () {
    if (release_yearSelect.value.trim() === "") {
      release_yearError.textContent = "Julkaisuvuosi on pakollinen kenttä.";
    } else if (!/^\d{4}$/.test(release_yearSelect.value)) {
      release_yearError.textContent = "Kirjoita kelvollinen vuosi (4 numeroa).";
    } else {
      release_yearError.textContent = "";
    }
    updateErrorPadding(release_yearError);
  });

  // Validate the language field
  languageSelect.addEventListener("change", function () {
    if (languageSelect.value === "") {
      languageError.textContent = "Valitse kieli.";
    } else {
      languageError.textContent = "";
    }
    updateErrorPadding(languageError);
  });

  // Validate the rental duration field
  rental_durationSelect.addEventListener("input", function () {
    if (rental_durationSelect.value.trim() === "") {
      rental_durationError.textContent = "Vuokra-aika on pakollinen kenttä.";
    } else if (!/^\d+$/.test(rental_durationSelect.value)) {
      rental_durationError.textContent = "Kirjoita kelvollinen vuokra-aika.";
    } else {
      rental_durationError.textContent = "";
    }
    updateErrorPadding(rental_durationError);
  });

  // Validate the rental rate field
  rental_rateSelect.addEventListener("input", function () {
    if (rental_rateSelect.value.trim() === "") {
      rental_rateError.textContent = "Vuokrahinta on pakollinen kenttä.";
    } else if (!/^\d+(\.\d{1,2})?$/.test(rental_rateSelect.value)) {
      rental_rateError.textContent = "Kirjoita kelvollinen hinta.";
    } else {
      rental_rateError.textContent = "";
    }
    updateErrorPadding(rental_rateError);
  });

  // Validate the length field
  lengthSelect.addEventListener("input", function () {
    if (lengthSelect.value.trim() === "") {
      lengthError.textContent = "Pituus on pakollinen kenttä.";
    } else if (!/^\d+$/.test(lengthSelect.value)) {
      lengthError.textContent = "Kirjoita kelvollinen pituus.";
    } else {
      lengthError.textContent = "";
    }
    updateErrorPadding(lengthError);
  });

  // Validate the replacement cost field
  replacement_costSelect.addEventListener("input", function () {
    if (replacement_costSelect.value.trim() === "") {
      replacement_costError.textContent = "Korvaushinta on pakollinen kenttä.";
    } else if (!/^\d+(\.\d{1,2})?$/.test(replacement_costSelect.value)) {
      replacement_costError.textContent = "Kirjoita kelvollinen korvaushinta.";
    } else {
      replacement_costError.textContent = "";
    }
    updateErrorPadding(replacement_costError);
  });

  // Validate the rating field
  ratingSelect.addEventListener("change", function () {
    if (ratingSelect.value === "") {
      ratingError.textContent = "Valitse ikäraja.";
    } else {
      ratingError.textContent = "";
    }
    updateErrorPadding(ratingError);
  });

  // Prevent form submission if there are invalid fields
  form.addEventListener("submit", function (event) {
    if (!titleInput.checkValidity()) {
      titleError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (
      !descriptionInput.checkValidity() ||
      descriptionInput.value.trim() === ""
    ) {
      descriptionError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (release_yearSelect.value.trim() === "") {
      release_yearError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (languageSelect.value === "") {
      languageError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (rental_durationSelect.value.trim() === "") {
      rental_durationError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (rental_rateSelect.value.trim() === "") {
      rental_rateError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (lengthSelect.value.trim() === "") {
      lengthError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (replacement_costSelect.value.trim() === "") {
      replacement_costError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }
    if (ratingSelect.value === "") {
      ratingError.textContent = "Pakollinen kenttä";
      event.preventDefault();
    }

    updateErrorPadding(titleError);
    updateErrorPadding(descriptionError);
    updateErrorPadding(release_yearError);
    updateErrorPadding(languageError);
    updateErrorPadding(rental_durationError);
    updateErrorPadding(rental_rateError);
    updateErrorPadding(lengthError);
    updateErrorPadding(replacement_costError);
    updateErrorPadding(ratingError);
  });
});
