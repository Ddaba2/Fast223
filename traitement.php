<?php
require 'bdd.php';

session_start();
//Création de compte
if (isset( $_GET['create_count'])) {
    extract($_GET);
    if ($password !== $cpassword) {
        die("Les mots de passe ne correspondent pas.");
    }
    $mot_de_passe = md5($password);
    $confirmer_mot_de_passe = md5($cpassword);

    if($type == 'joueur'){
        $sql =  "INSERT INTO joueur (nom, prenom, pied, taille, poste, age, email, telephone, nom_utilisateur, mot_de_passe, confirmer_mot_de_passe)
             VALUES (:nom, :prenom, :pied, :taille, :poste, :age, :email, :telephone, :nom_utilisateur, :mot_de_passe, :confirmer_mot_de_passe)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':pied', $pied);
        $stmt->bindParam(':taille', $taille);
        $stmt->bindParam(':poste', $poste);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':confirmer_mot_de_passe', $confirmer_mot_de_passe);

        $stmt->execute();


    }else if ($type == 'coach'){
        $sql = "INSERT INTO coach (nom, prenom, diplome, role, age, email, telephone, nom_utilisateur, mot_de_passe, confirmer_mot_de_passe)
              VALUES (:nom, :prenom, :diplome, :role, :age, :email, :telephone, :nom_utilisateur, :mot_de_passe, :confirmer_mot_de_passe)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':diplome', $diplome);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':confirmer_mot_de_passe', $confirmer_mot_de_passe);
        $stmt->execute();

    }
    include 'mail.php';
    $objet = "Inscription réussie";
    $message = "
    <p>Bonjour $nom_utilisateur,</p>

    <p>Nous sommes ravis de vous accueillir sur notre plateforme FAST 233⚽ !<br>
    Votre inscription a été prise en compte avec succès.</p>

    <hr>
    <p style='font-size: 0.9em; color: #666;'>
    Ce message et ses pièces jointes peuvent contenir des informations confidentielles ou privilégiées et ne doivent donc pas être diffusés, exploités ou copiés sans autorisation. Si vous avez reçu ce message par erreur, veuillez le signaler à l'expéditeur et le détruire ainsi que les pièces jointes. Les messages électroniques étant susceptibles d'altération, nous déclinons toute responsabilité si ce message a été altéré, déformé ou falsifié. Merci.
    </p>

    <p style='font-size: 0.9em; color: #666;'>
    This message and its attachments may contain confidential or privileged information that may be protected by law; they should not be distributed, used, or copied without authorization. If you have received this email in error, please notify the sender and delete this message and its attachments. As emails may be altered, we are not liable for messages that have been modified, changed, or falsified. Thank you.
    </p>

       <p>Cordialement,<br>L'équipe FAST 233⚽</p>";
    if (envoyerEmail($email, $objet, $message)) {
        echo "Un email vous a été envoyé";
    } else {
        echo "Echec lors de l'envoi du mail";
    }
    header('location:Bienvenue.php');
}


//Connexion
if (isset( $_GET['connexion'])) {
    
  $type = $_GET['type'];

    $nom_utilisateur = $_GET['nom_utilisateur'];
   
    $password = $_GET['password'];
   
    $mot_de_passe = md5($password);

    if ($type === 'joueur') {
        $sql = ("SELECT * FROM joueur WHERE nom_utilisateur = '$nom_utilisateur' AND Mot_de_passe = '$mot_de_passe' " );
        $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultats = $stmt->fetch(PDO::FETCH_ASSOC); 
    $count= $stmt->rowCount();
    $_SESSION['type']="joueur";

    } elseif ($type === 'coach') {
        $sql = ("SELECT * FROM coach WHERE nom_utilisateur = '$nom_utilisateur' AND Mot_de_passe = '$mot_de_passe' " );
        $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $resultats = $stmt->fetch(PDO::FETCH_ASSOC); 
    $count= $stmt->rowCount();
    $_SESSION['type']="coach";
    }

    if($count==0){
        echo "Compte inexistant";
        header('location:erreur.php');

    }else{

        $_SESSION['id']=$resultats['id'];
        $_SESSION['nom']=$resultats['nom'];
        $_SESSION['prenom']=$resultats['prenom'];
        $_SESSION['role']=$resultats['role'];
        $_SESSION['taille']=$resultats['taille'];
        $_SESSION['pied']=$resultats['pied'];
        $_SESSION['poste']=$resultats['poste'];
        $_SESSION['email']=$resultats['email'];
        $_SESSION['telephone']=$resultats['telephone'];
        $_SESSION['age']=$resultats['age'];
        $_SESSION['mot_de_passe']=$resultats['mot_de_passe'];
        $_SESSION['nom_utilisateur']=$resultats['nom_utilisateur'];
        $_SESSION['photo']=$resultats['photo'];

        echo "Bienvenue sur la page!!";
        header('location:Bienvenue.php');
    }

}
// Ajouter un évènement
if (isset($_POST['ajouter'])) {
    // Vérifier si un fichier a été uploadé
    if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        // Lecture du contenu du fichier
        $imageContent = file_get_contents($_FILES['image']['tmp_name']);
        
        // Récupération des autres données
        $titre = trim($_POST['titre']);
        $date = trim($_POST['date']);
        $description = trim($_POST['description']);

        // Validation des données (optionnel)
        if (empty($titre) || empty($date) || empty($description)) {
            echo "Tous les champs sont obligatoires.";
            exit;
        }

        // Préparation de la requête SQL
        $sql = "INSERT INTO evenement (titre, date, description, image) 
                VALUES (:titre, :date, :description, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imageContent, PDO::PARAM_LOB);

        // Exécution de la requête
        if ($stmt->execute()) {
            header('Location: Accueil.php');
            exit;
        } else {
            echo "Erreur lors de l'ajout de l'événement.";
        }
    } else {
        echo "Erreur : aucun fichier n'a été uploadé.";
    }
}


    ?>