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

        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .buttons {
            margin-top: 20px;
        }

        button {
            display: inline-block;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        /* Style pour le bouton "Continuer" */
        button[type="submit"], button {
            background-color: #4CAF50; /* Vert élégant */
            color: white; /* Texte blanc */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Ombre subtile */
        }

        /* Effet hover pour le bouton */
        button:hover {
            background-color: #45a049; /* Vert plus foncé */
            transform: translateY(-2px); /* Légère élévation */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }

        button:active {
            transform: translateY(0); /* Réinitialise l'élévation */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<h1>Vous êtes un Joueur ou un Coach</h1>
    <img id="logo" src="s.png" alt="mot de passe">
  
    <form action="recuperation.php" method="GET">
        <label for="type">Choisissez votre spécialité :</label>
        <select id="type" name="type">
            <option value="joueur">Joueur</option>
            <option value="coach">Coach</option>
        </select>
        <br><br>
    
        <div class="buttons"> 
            <button type="submit">Continuer</button>
        </div>
    </form>
</body>
</html>
