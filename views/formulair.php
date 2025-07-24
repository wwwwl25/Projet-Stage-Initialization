<?php
session_start();
require_once '../Connect.php';
require_once 'dashboard.php';
$connect = new Connect();
$db = $connect->conn;

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour modifier votre profil.");
}

$id = intval($_SESSION['user_id']);

//  Si formulaire envoyé, traiter la mise à jour
if (isset($_POST['submit'])) {
    $new_name = mysqli_real_escape_string($db, $_POST['name']);
    $new_email = mysqli_real_escape_string($db, $_POST['email']);

    // Mise à jour du nom et email
    $update_sql = "UPDATE registration SET name = '$new_name', email = '$new_email' WHERE id = $id";
    if ($db->query($update_sql)) {
        echo "<p style='color:green;'> Nom et e-mail mis à jour avec succès.</p>";
    } else {
        echo "<p style='color:red;'> Erreur lors de la mise à jour : " . $db->error . "</p>";
    }

    // 🔒 Changement de mot de passe si demandé
    if (!empty($_POST['mot_de_passe_actuel']) && !empty($_POST['nouveau_mot_de_passe']) && !empty($_POST['confirmer_mot_de_passe'])) {
        $current_pass = $_POST['mot_de_passe_actuel'];
        $new_pass = $_POST['nouveau_mot_de_passe'];
        $confirm_pass = $_POST['confirmer_mot_de_passe'];

        if ($new_pass !== $confirm_pass) {
            echo "<p style='color:red;'>❌ Les mots de passe ne correspondent pas.</p>";
        } else {
            $query_pass = "SELECT password FROM registration WHERE id = $id";
            $result_pass = $db->query($query_pass);

            if ($result_pass && $result_pass->num_rows === 1) {
                $row = $result_pass->fetch_assoc();
                $hashed_password = $row['password'];

                // Vérifie mot de passe actuel
                if (password_verify($current_pass, $hashed_password)) {
                    $new_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
                    $update_pass = "UPDATE registration SET password = '$new_hashed' WHERE id = $id";
                    if ($db->query($update_pass)) {
                        echo "<p style='color:green;'> Mot de passe changé avec succès.</p>";
                    } else {
                        echo "<p style='color:red;'> Erreur lors du changement de mot de passe.</p>";
                    }
                } else {
                    echo "<p style='color:red;'> Mot de passe actuel incorrect.</p>";
                }
            }
        }
    }
}

// ➕ Recharger les données utilisateur après mise à jour
$sql = "SELECT name, email FROM registration WHERE id = $id";
$result = $db->query($sql);
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    die("Utilisateur introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/details1.css">
    <title>Modifier mon profil</title>
</head>
<body>

<form action="" method="POST">
    <label for="name">Nom complet :</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

    <hr>

    <h3>Changer le mot de passe (optionnel)</h3>

    <label for="mot_de_passe_actuel">Mot de passe actuel :</label>
    <input type="password" name="mot_de_passe_actuel" id="mot_de_passe_actuel">

    <label for="nouveau_mot_de_passe">Nouveau mot de passe :</label>
    <input type="password" name="nouveau_mot_de_passe" id="nouveau_mot_de_passe">

    <label for="confirmer_mot_de_passe">Confirmer le nouveau mot de passe :</label>
    <input type="password" name="confirmer_mot_de_passe" id="confirmer_mot_de_passe">

    <br><br>
    <button type="submit" name="submit">Enregistrer</button>
</form>

</body>
</html>
