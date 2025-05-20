<?php
require 'bdd.php'; 
require 'mail.php';
// Récupérer les événements qui commencent dans 2 heures
$now = date('Y-m-d H:i:s');
$date_2_heure = date('Y-m-d H:i:s', strtotime('+2 hours'));
$query = $pdo->prepare("
    SELECT e.id, e.titre, e.lieu, e.date, e.description
    FROM evenement e
    WHERE e.date BETWEEN '$now' AND '$date_2_heure'
");
$query->execute();
$evenements = $query->fetchAll(PDO::FETCH_ASSOC);
$message='Nous vous rappelons que les evements suivants approchent :';
// Envoyer un email à chaque joueur pour chaque événement
$i=1;
foreach ($evenements as $evenement) {
    $titre=$evenement['titre'];
    $lieu=$evenement['lieu'];
    $date=$evenement['date'];

    $description=$evenement['description'];

    $message .= "
                <p><strong> 0$i $titre :</strong> </p>
                <p><strong>$description :</strong> </p>
                 <p><strong>📅 Date et heure :</strong> $date</p>
                 <p><strong>📍 Lieu :</strong> $lieu</p> 
                <hr>";  
                $i++;  
}

// Récupérer tous les joueurs
$queryJoueur = $pdo->prepare("SELECT nom_utilisateur, email FROM joueur");
$queryJoueur->execute();
$joueurs = $queryJoueur->fetchAll(PDO::FETCH_ASSOC);



    foreach ($joueurs as $joueur) {
        $nom_utilisateur = $joueur['nom_utilisateur'];
        $email = $joueur['email'];

        $objet = "⏰ Rappel ";

      /*  $date = date("d/m/Y H:i", strtotime($evenement['date']));
        $lieu = $evenement['lieu'];
        $titre = $evenement['titre'];

        $objet = "⏰ Rappel : $titre";
        $message = "
        <p>Bonjour $nom_utilisateur,</p>

        <p>Nous vous rappelons que votre essai de football approche !<br>
        Voici les détails :</p>

        

        <p>Veuillez arriver 30 minutes à l'avance pour vous préparer.<br>
        N’oubliez pas d’apporter vos équipements (chaussures, protège-tibias, bouteille d’eau, etc.).</p>

        <hr>
        <p style='font-size: 0.9em; color: #666;'>
        Ce message et ses pièces jointes peuvent contenir des informations confidentielles ou privilégiées et ne doivent donc pas être diffusés, exploités ou copiés sans autorisation. 
        Si vous avez reçu ce message par erreur, veuillez le signaler à l'expéditeur et le détruire ainsi que les pièces jointes. 
        Les messages électroniques étant susceptibles d'altération, nous déclinons toute responsabilité si ce message a été altéré, déformé ou falsifié. Merci.
        </p>

        <p style='font-size: 0.9em; color: #666;'>
        This message and its attachments may contain confidential or privileged information that may be protected by law; they should not be distributed, used, or copied without authorization. 
        If you have received this email in error, please notify the sender and delete this message and its attachments. 
        As emails may be altered, we are not liable for messages that have been modified, changed, or falsified. Thank you.
        </p>

        <p>Cordialement,<br>L'équipe FAST 233⚽</p>";
        
        */
            // Envoi de l'email
            if (envoyerEmail($email, $objet, $message)) {
                echo "✅ Email envoyé à $nom_utilisateur ($email).<br>";
            } else {
                echo "❌ Échec de l'envoi du mail à $nom_utilisateur ($email).<br>";
            }
    }



?>
