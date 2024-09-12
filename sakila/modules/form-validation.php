<?php
function validate_film($data, $yhteys)
{
    $errors = [];
    $data = [];

    $errors ??= [];
    $kentat ??= ['title', 'description', 'rating', 'release_year', 'language_id', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'special_features'];
    $pakolliset ??= ['title', 'description', 'rating', 'release_year', 'language_id', 'rental_duration', 'rental_rate', 'length', 'replacement_cost'];

    $patterns['title'] = "/^[A-Za-z0-9\s]{2,}$/";
    $patterns['description'] = "/^.{3,500}$/";
    $patterns['rating'] = "/^(G|PG|PG-13|R|NC-17)$/";
    $patterns['release_year'] = "/^\d{4}$/";
    $patterns['language_id'] = "/^(1|2|3|4|5|6)$/";
    $patterns['rental_duration'] = "/^\d+$/";
    $patterns['rental_rate'] = "/^\d+(\.\d{1,2})?$/";
    $patterns['length'] = "/^\d+$/";
    $patterns['replacement_cost'] = "/^\d+(\.\d{1,2})?$/";

    // Validointi title-kentälle
    $kentta = "title";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Nimi on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Kirjoita elokuvan nimi (väh. 2 merkkiä) ilman erikoismerkkejä.";
        } else {
            $title = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi description-kentälle
    $kentta = "description";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Kuvaus on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Kuvauksen tulee olla 3-500 merkkiä pitkä.";
        } else {
            $description = trim($yhteys->real_escape_string(strip_tags($arvo)));
            $data[$kentta] = $description;
        }
    }

    // Validointi rating-kentälle
    $kentta = "rating";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Ikäraja on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Valitse kelvollinen ikäraja (G, PG, PG-13, R, NC-17).";
        } else {
            $rating = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi release_year-kentälle
    $kentta = "release_year";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Julkaisuvuosi on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Anna kelvollinen julkaisuvuosi (4 numeroa).";
        } else {
            $release_year = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi language_id-kentälle
    $kentta = "language_id";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Kieli on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Valitse kelvollinen kieli.";
        } else {
            $language_id = $yhteys->real_escape_string(strip_tags(trim($arvo)));
            $data[$kentta] = $language_id;
        }
    }

    // Validointi rental_duration-kentälle
    $kentta = "rental_duration";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Vuokra-aika on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Vuokra-ajan tulee olla positiivinen kokonaisluku.";
        } else {
            $rental_duration = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi rental_rate-kentälle
    $kentta = "rental_rate";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Vuokrahinta on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Vuokrahinnan tulee olla positiivinen numero (enintään kaksi desimaalia).";
        } else {
            $rental_rate = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi length-kentälle
    $kentta = "length";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Elokuvan pituus on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Elokuvan pituuden tulee olla positiivinen kokonaisluku.";
        } else {
            $length = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi replacement_cost-kentälle
    $kentta = "replacement_cost";
    $arvo = $_POST[$kentta] ?? '';
    if (in_array($kentta, $pakolliset) and empty($arvo)) {
        $errors[$kentta] = "Korvaushinta on pakollinen kenttä.";
    } else {
        if (isset($patterns[$kentta]) and !preg_match($patterns[$kentta], $arvo)) {
            $errors[$kentta] = "Korvaushinnan tulee olla positiivinen numero (enintään kaksi desimaalia).";
        } else {
            $replacement_cost = $yhteys->real_escape_string(strip_tags(trim($arvo)));
        }
    }

    // Validointi special_features-kentälle
    $kentta = "special_features";
    $arvo = $_POST[$kentta] ?? [];
    if (is_array($arvo)) {
        $special_features = implode(',', array_map(function ($feature) use ($yhteys) {
            return $yhteys->real_escape_string(strip_tags(trim($feature)));
        }, $arvo));
    } else {
        $special_features = '';
    }

    return [
        'errors' => $errors,
        'data' => array_merge([
            'title' => $title,
            'description' => $description,
            'rating' => $rating,
            'release_year' => $release_year,
            'language_id' => $language_id,
            'rental_duration' => $rental_duration,
            'rental_rate' => $rental_rate,
            'length' => $length,
            'replacement_cost' => $replacement_cost,
            'special_features' => $special_features
        ], $data)
    ];
}
