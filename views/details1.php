<?php
session_start();
require_once '../Connect.php';
$connect = new Connect();
$db = $connect->conn;

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Accès refusé. Veuillez vous connecter.");
}

$id = intval($_SESSION['user_id']);

// Si nom/email pas encore stockés en session
if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
    $sql = "SELECT name, email FROM registration WHERE id = $id";
    $result = $db->query($sql);
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
    } else {
        die("Utilisateur introuvable.");
    }
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($db, $_POST['name'] ?? '');
    $email = mysqli_real_escape_string($db, $_POST['email'] ?? '');

    $mot_de_passe_actuel = $_POST['mot_de_passe_actuel'] ?? '';
    $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'] ?? '';
    $confirmer_mot_de_passe = $_POST['confirmer_mot_de_passe'] ?? '';

    // Update nom + email
    $sqlUpdate = "UPDATE registration SET name = '$name', email = '$email' WHERE id = $id";
    if ($db->query($sqlUpdate)) {
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
    }

    // Si mot de passe modifié
    if (!empty($nouveau_mot_de_passe)) {
        $sql = "SELECT password FROM registration WHERE id = $id";
        $result = $db->query($sql);
        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $mot_de_passe_hash = $row['password'];

            if (password_verify($mot_de_passe_actuel, $mot_de_passe_hash)) {
                if ($nouveau_mot_de_passe === $confirmer_mot_de_passe) {
                    $nouveau_hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
                    $db->query("UPDATE registration SET password = '$nouveau_hash' WHERE id = $id");
                }
            }
        }
    }

    // Redirection vers même page sans messages
    header("Location: modifier.php");
    exit;
} else {
    $name = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
}

$db->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier mon profil</title>
    <link rel="stylesheet" href="../styles/details1.css">
</head>
<body>

<form action="" method="POST">
    <label for="name">Nom complet :</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>

    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>

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