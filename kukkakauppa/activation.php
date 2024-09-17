<?php
/* Huom. aktivointitokenin voimassaoloa ei tässä tarkisteta. */
$email_verified = $email_already_verified = $activation_error = "";
$token = $_GET['token'] ?? "";

if ($token) {
    $token = $yhteys->real_escape_string($token);
    $query = "SELECT users_id, is_active, s.updated FROM signup_tokens s
              LEFT JOIN users ON users_id = id WHERE s.token = ?";

    if ($stmt = $yhteys->prepare($query)) {
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            [$id, $is_active, $updated] = $result->fetch_row();
            if ($is_active == 0) {
                $update_query = "UPDATE users SET is_active = '1' WHERE id = ?";
                if ($update_stmt = $yhteys->prepare($update_query)) {
                    $update_stmt->bind_param('i', $id);
                    $update_stmt->execute();

                    if ($update_stmt->affected_rows > 0) {
                        $email_verified =
                            '<div class="alert alert-success">
                          Sähköpostiosoitteesi on vahvistettu.
                           </div>';
                    }
                }
            } else {
                $email_already_verified =
                    '<div class="error">
                   Sähköpostiosoitteesi on jo vahvistettu.
                   </div>';
            }

            $delete_query = "DELETE FROM signup_tokens WHERE token = ?";
            if ($delete_stmt = $yhteys->prepare($delete_query)) {
                $delete_stmt->bind_param('s', $token);
                $delete_stmt->execute();
                $poistettiin = $delete_stmt->affected_rows;
            }
        } else {
            $activation_error =
                '<div class="error">
              Virhe, sähköpostiosoitteesi saattaa olla jo vahvistettu.
              </div>';
        }
    }
}
