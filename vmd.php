<?php
require 'bdd.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['token'])) {
        $token = trim($_POST['token']);
        $type = $_POST['type'];
        if($type == 'joueur'){
        try {
            // Vérifiez si le token est valide
            $stmt = $pdo->prepare("SELECT id FROM joueur WHERE reset_token = :token AND reset_expiry > NOW()");
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Token valide - Rediriger vers la page de réinitialisation
                header('Location: newmd.php?token=' . urlencode($token));
                exit();
            } else {
                $error = "Code invalide ou expiré.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de la base de données : " . $e->getMessage();
        }
                } elseif ($type == 'coach') {
                    try {
                        // Vérifiez si le token est valide
                        $stmt = $pdo->prepare("SELECT id FROM coach WHERE reset_token = :token AND reset_expiry > NOW()");
                        $stmt->bindParam(':token', $token);
                        $stmt->execute();
            
                        if ($stmt->rowCount() > 0) {
                            // Token valide - Rediriger vers la page de réinitialisation
                            header('Location: newmd.php?token=' . urlencode($token));
                            exit();

            } else {
                $error = "Code invalide ou expiré.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de la base de données : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez saisir un code.";
    }
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vérification du code</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Saisisez le code à 4 chiffres</h2>
        <form method="POST">
            <label for="token">Code:</label>
            <input type="token" id="token" name="token" required><br><br>
            <input type="hidden" id="type" name="type" value="<?php echo $_SESSION['typeu'] ?>" required><br><br>
            <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['idu'] ?>" required><br><br>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>