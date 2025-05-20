<!DOCTYPE html>
<html>
<head>
    <title>Afficher les données de la base de données</title>
    <link rel="stylesheet" href="Profil.css">
</head>
<body>

<?php

session_start();
require 'bdd.php';

if (!isset($_SESSION['id'])) {
   
    header('location:Accueil.php');
}
$coach_id = $_SESSION['id'];
        $sql = "SELECT nom, prenom, diplome, role, age, telephone, nom_utilisateur, mot_de_passe FROM coach WHERE id = :coach_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':coach_id', $coach_id);
        $stmt->execute();
        $result = $stmt->fetch();

// Supposons que l'ID de l'utilisateur connecté soit stocké dans une variable de session

if ($result) {
    echo "<form action='update.php' method='post'>";
        echo "Nom: <input type='text' name='nom' value='" . $result["nom"] . "'><br>";
        echo "Prénom: <input type='text' name='prenom' value='" . $result["prenom"] . "'><br>";
        echo "Diplôme: <input type='text' name='diplome' value'".  $result["diplome"] . "'><br>";
        echo "Rôle: <input type='text' name='role' value='" . $result["role"] . "'><br>";
        echo "Age: <input type='text' name='age' value='" . $result["age"] . "'><br>";
        echo "Téléphone: <input type='text' name='telephone' value='" . $result["telephone"] . "'><br>";
        echo "Nom d'utilisateur: <input type='text' name='nom_utilisateur' value='" . $result["nom_utilisateur"] . "'><br>";
        echo "Mot de passe: <input type='text' name='mot_de_passe' value='" . $result["mot_de_passe"] . "'><br>";
        echo "<input type='submit' value='Mettre à jour'>";
        echo "</form><br>";
} else {
    echo "<tr><td colspan='8' style='text-align:center'>Utilisateur non trouvé</td></tr>";
}

?>

</body>
</html>