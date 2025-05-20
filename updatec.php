<?php
session_start();
require 'bdd.php';

// Récupérer les données du formulaire
if (!isset($_SESSION['id'])){
    header('location:Accueil.php');
}
    
    $id=$_SESSION['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $diplome = $_POST['diplome'];
    $role = $_POST['role'];
    $telephone = $_POST['telephone'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];
    
    // Mettre à jour les données avec une requête préparée
    $sql = "UPDATE coach SET nom = :nom, prenom = :prenom, age = :age, diplome = :diplome, role = :role, telephone = :telephone, nom_utilisateur = :nom_utilisateur, mot_de_passe = :mot_de_passe WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':diplome', $diplome);
    $stmt->bindParam(':role', $ro, $telephone);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Mise à jour effectuée !!";
    } else {
        echo "Erreur de mise à jour: " . implode(":", $stmt->errorInfo());
    }

?>
