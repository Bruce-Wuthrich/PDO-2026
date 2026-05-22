<?php
// Ce fichier contient les fonctions pour gérer la table commentaire


// ============================================================
// FONCTION : Ajouter un commentaire dans la base de données
// ============================================================
function addCommentaire(PDO $con, string $email, string $nom, string $titre, string $commentaire): void
{
    // On prépare la requête SQL d'insertion
    $sql = "INSERT INTO `commentaire` (`email`, `full_name`, `title`, `text_comment`)
            VALUES (:email, :nom, :titre, :commentaire)";

    $prepare = $con->prepare($sql);

    // On associe les valeurs aux marqueurs
    $prepare->bindValue(':email',       $email);
    $prepare->bindValue(':nom',         $nom);
    $prepare->bindValue(':titre',       $titre);
    $prepare->bindValue(':commentaire', $commentaire);

    // On exécute la requête
    $prepare->execute();
}


// ============================================================
// FONCTION : Récupérer tous les commentaires
// ============================================================
function readCommentaires(PDO $con): array
{
    // ORDER BY post_date DESC = du plus récent au plus ancien
    $stmt = $con->query("SELECT * FROM `commentaire` ORDER BY `post_date` DESC");

    // fetchAll retourne tous les résultats sous forme de tableau
    return $stmt->fetchAll();
}


// ============================================================
// FONCTION : Compter le nombre total de commentaires
// ============================================================
function countCommentaires(PDO $con): int
{
    // COUNT(*) compte toutes les lignes de la table
    $stmt = $con->query("SELECT COUNT(*) FROM `commentaire`");

    // fetchColumn retourne uniquement la première colonne du résultat
    return (int) $stmt->fetchColumn();
}
