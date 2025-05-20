<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Récupération de mot de passe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Récupération de mot de passe</h2>
        <form method="GET" action="tr.php">
            <label for="email">Entrez votre adresse e-mail :</label>
            <input type="email" id="email" name="email" required><br><br>
            <input type="hidden" id="type" name="type" value="<?php echo $_GET['type'] ?>" required><br><br>
            <button type="submit" name="recuperer">Envoyer</button>
        </form>
    </div>
</body>
</html>
