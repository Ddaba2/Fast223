
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #logo {
            width: 300px;
            margin-bottom: 25px;
        }

        h1 {
            margin: 20px 0;
            color: #333;
        }

        .options-container {
            display: flex;
            gap: 20px;
        }

        .option {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 40px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .option:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h1>Créer un compte</h1>

    <img id="logo" src="s.jpeg" alt="Logo création">
  
    <div class="options-container">
        <a href="joueurf.php?option= compte joueur" class="option">Joueur</a>
        <a href="coachf.php?option= compte coach" class="option">Coach</a>
    </div>

</body>
</html>

