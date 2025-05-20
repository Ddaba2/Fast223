<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .profile-container div {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .buttons {
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .buttons button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <?php
        session_start();
        require 'bdd.php';

        if (!isset($_SESSION['id'])) {
            header('location:Accueil.php');
            exit;
        }

        $joueur_id = $_SESSION['id'];
        $sql = "SELECT nom, prenom, age, poste, taille, pied, telephone, nom_utilisateur FROM joueur WHERE id = :joueur_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':joueur_id', $joueur_id);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            echo "<div class='profile-container'>";
            echo "<img src='p.png' alt='Profil'>";
            echo "<div>Nom : " . $result['nom'] . "</div>";
            echo "<div>Prénom : " . $result['prenom'] . "</div>";
            echo "<div>Age : " . $result['age'] . "</div>";
            echo "<div>Poste : " . $result['poste'] . "</div>";
            echo "<div>Taille : " . $result['taille'] . "</div>";
            echo "<div>Pied : " . $result['pied'] . "</div>";
            echo "<div>Téléphone : " . $result['telephone'] . "</div>";
            echo "<div>Nom d'utilisateur : " . $result['nom_utilisateur'] . "</div>";
            echo "<div class='buttons'>";
            echo "<button onclick=\"window.location.href='Modifier.php'\">Modifier le profil</button>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "Utilisateur non trouvé";
        }
    ?>

</body>
</html>
