<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Ajouter un événement</h1>
    <form method="POST" action="traitement.php" enctype="multipart/form-data">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required><br>

    <label for="date">Date :</label>
    <input type="date" id="date" name="date" required><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="image">Image :</label>
    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" required><br>

    <button type="submit" name="ajouter">Ajouter</button>
</form>

</body>
</html>
