<?php
session_start();
require 'bdd.php';

// Récupération des partenaires depuis la base de données
$clubs = $pdo->query("SELECT * FROM clubs")->fetchAll(PDO::FETCH_ASSOC);
$agents = $pdo->query("SELECT * FROM agents")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nos Partenaires</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .section {
            margin: 40px 0;
        }

        .section h2 {
            color: #555;
            border-bottom: 2px solid #28a745;
            display: inline-block;
            padding-bottom: 5px;
        }

        .partners-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .partner-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: calc(33.333% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .partner-card img {
            max-width: 100%;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .partner-card h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }
        .buttons a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            display: inline-block;
            margin: 10px auto;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Nos Partenaires</h1>

    <div class="buttons">
    <a href="Bienvenue.php">Retour à la page</a>
</div>

    <!-- Section Clubs Partenaires -->
    <div class="section">
        <h2>Clubs Partenaires</h2>
        <div class="partners-grid">
            <?php foreach ($clubs as $club): ?>
                <div class="partner-card">
                    <img src="<?= htmlspecialchars($club['logo']) ?>" alt="Logo de <?= htmlspecialchars($club['nom_club']) ?>">
                    <h3><?= htmlspecialchars($club['nom_club']) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Section Agents Partenaires -->
    <div class="section">
        <h2>Agents Partenaires</h2>
        <div class="partners-grid">
            <?php foreach ($agents as $agent): ?>
                <div class="partner-card">
                    <img src="<?= htmlspecialchars($agent['photo']) ?>" alt="Photo de <?= htmlspecialchars($agent['nom_agent']) ?>">
                    <h3><?= htmlspecialchars($agent['nom_agent']) ?></h3>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

   

</body>
</html>
