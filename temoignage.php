<?php
session_start();
require_once 'bdd.php'; 

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: Accueil.php');
    echo "Vous devez être connecté pour accéder à cette page.";
    exit();
}

// Récupération du nom de l'utilisateur connecté
$nom_utilisateur = $_SESSION['nom_utilisateur'];   

// Ajout d'un temoignage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['temoignage'])) {
        $temoignage = trim($_POST['temoignage']);
        $date = date('Y-m-d H:i:s'); 

        try {
            $stmt = $pdo->prepare("INSERT INTO temoignage (nom_utilisateur, texte, date) VALUES (:nom_utilisateur, :texte, :date)");
            $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
            $stmt->bindParam(':texte', $temoignage, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->execute();

            $message = "temoignage ajouté avec succès.";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout du temoignage : " . $e->getMessage();
        }
    } else {
        $message = "Le champ temoignage est requis.";
    }
}

// Récupération des temoignages existants
$temoignages = [];
try {
    $stmt = $pdo->query("SELECT nom_utilisateur, texte, date FROM temoignage ORDER BY date ASC");
    $temoignages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Erreur lors de la récupération des temoignages : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Témoignages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        h1, h2 {
            text-align: center;
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

        .message {
            color: #28a745;
            text-align: center;
            font-weight: bold;
        }

        .comment-container {
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .comment {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment.left {
            justify-content: flex-start;
        }

        .comment.right {
            justify-content: flex-end;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            margin-right: 15px;
        }

        .comment.right .avatar {
            margin-right: 0;
            margin-left: 15px;
        }

        .comment-content {
            max-width: 70%;
        }

        .comment .user {
            font-weight: bold;
            font-size: 1.1em;
        }

        .comment .date {
            font-size: 0.85em;
            color: #6c757d;
        }

        .comment .text {
            margin-top: 5px;
            line-height: 1.5;
        }

        .form-container {
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            resize: none;
            margin-bottom: 15px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Témoignages</h1>

<div class="buttons">
    <a href="Bienvenue.php">Retour à la page</a>
</div>

<?php if (isset($message)): ?>
    <p class="message"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<div class="comment-container">
    <h2>Témoignage précédents</h2>
    <?php foreach ($temoignages as $temoignage): ?>
        <?php
        $isUser = $temoignage['nom_utilisateur'] === $nom_utilisateur;
        $class = $isUser ? 'right' : 'left';
        $initials = strtoupper(substr($temoignage['nom_utilisateur'], 0, 1));
        ?>
        <div class="comment <?php echo $class; ?>">
            <div class="avatar"><?php echo htmlspecialchars($initials); ?></div>
            <div class="comment-content">
                <p class="user"><?php echo htmlspecialchars($temoignage['nom_utilisateur']); ?></p>
                <p class="date"><?php echo htmlspecialchars($temoignage['date']); ?></p>
                <p class="text"><?php echo htmlspecialchars($temoignage['texte']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="form-container">
    <form action="temoignage.php" method="post">
        <label for="temoignage">Votre témoignage :</label>
        <textarea id="temoignage" name="temoignage" placeholder="Écrivez votre temoignage ici..." required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>

</body>
</html>
