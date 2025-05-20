<?php
require 'bdd.php';

// Requête pour récupérer les événements à venir
$query = $pdo->prepare("SELECT * FROM evenement WHERE date >= CURDATE() ORDER BY date ASC");
$query->execute();
$evenements = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements à venir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
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


        header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .evenement {
            border-bottom: 1px solid #ddd;
            padding: 1rem 0;
        }
        .evenement:last-child {
            border-bottom: none;
        }
        .evenement h2 {
            margin: 0 0 0.5rem;
            color: #007BFF;
        }
        .evenement p {
            margin: 0.5rem 0;
        }
        .evenement .date {
            font-weight: bold;
            color: #555;
        }
        .evenement .lieu {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Événements à venir</h1>
    </header>

    
<div class="buttons">
    <a href="Bienvenue.php">Retour à la page</a>
</div>

    <div class="container">
        <?php if (count($evenements) > 0): ?>
            <?php foreach ($evenements as $evenement): ?>
                <div class="evenement">
                    <h2><?php echo htmlspecialchars($evenement['titre']); ?></h2>
                    <p class="date">Date : <?php echo htmlspecialchars($evenement['date']); ?></p>
                    <p class="lieu">Lieu : <?php echo htmlspecialchars($evenement['lieu']); ?></p>
                    <p><?php echo htmlspecialchars($evenement['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun événement à venir pour le moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
