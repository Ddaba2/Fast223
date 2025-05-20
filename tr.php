<?php
require 'bdd.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['recuperer'])) {
    $email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        die("Adresse e-mail invalide.");
    }

    $type = isset($_GET['type']) ? $_GET['type'] : null;
    if (!$type) {
        die("Type non spécifié.");
    }

    if ($type == 'joueur') {
        $stmt = $pdo->prepare("SELECT id, nom_utilisateur FROM joueur WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        $nom_utilisateur = $user['nom_utilisateur'];
        $idu = $user['id'];
    
        if ($user) {
            $token = mt_rand(1000, 9999);
            $stmt = $pdo->prepare("UPDATE joueur SET reset_token = :token, reset_expiry = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE email = :email");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $subject = "Réinitialisation de votre mot de passe";
            $message = "Voici votre code de réinitialisation : $token";
            include 'email.php';

            if (!email($subject, $message, $email, $nom_utilisateur)) {
                die("Erreur lors de l'envoi de l'email.");
            }
            $_SESSION['typeu']=$type;
            $_SESSION['idu']=$idu;

            header('Location: vmd.php');
            exit();
        } else {
            die("Adresse e-mail introuvable.");
        }
    } elseif ($type == 'coach') {
        $stmt = $pdo->prepare("SELECT id, nom_utilisateur FROM coach WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        $nom_utilisateur = $user['nom_utilisateur'];

        if ($user) {
            $token = mt_rand(1000, 9999);
            $stmt = $pdo->prepare("UPDATE coach SET reset_token = :token, reset_expiry = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE email = :email");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $subject = "Réinitialisation de votre mot de passe";
            $message = "Voici votre code de réinitialisation : $token";
            include 'email.php';

            if (!email($subject, $message, $email, $nom_utilisateur)) {
                die("Erreur lors de l'envoi de l'email.");
            }
            header('Location: vmd.php');
            exit();
        } else {
            die("Adresse e-mail introuvable.");
        }
    } else {
        die("Type non reconnu.");
    }
}
?>
