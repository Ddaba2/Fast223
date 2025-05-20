<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte </title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        
        <h2>Créer un compte</h2>
        <form methode="GET" action='traitement.php'>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>

            <label for="diplome">Diplôme :</label>
            <input type="text" id="diplome" name="diplome" required><br><br>

            <label for="role">Choisissez votre spécialité :</label>
        <select id="role" name="role">
            <option value="coach principal">Coach principal</option>
            <option value="coach assistan">Coach assistan</option>
            <option value="coach gardien">Coach gardien</option>
            <option value="préparateur physique">Préparateur physique</option>
        </select><br><br>

            <label for="age">Age :</label>
            <input type="text" id="age" name="age" required><br><br>

            <label for="email">Email :</label>
            <input type="text" id="email" name="email" required><br><br>

            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" required><br><br>

            <label for="nom_utilisateur">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required><br><br>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="password">Confirmer mot de passe :</label>
            <input type="password" id="cpassword" name="cpassword" required><br><br>

            <input type="hidden" id="" name="type" value="coach" required><br><br>

            <button type="submit" name='create_count'>Créer</button>
        </form>
        <div class="buttons">
             
            <button onclick="window.location.href='Accueil.php'">Annuler</button>
            
        </div>
    </div>
</body>
</html>