<?php
// ============================================================
// ROUTER : gère les actions de l'utilisateur
// ============================================================

// Chargement du modèle (les fonctions)
require ROOT_PROJECT . "/model/CommentaireModel.php";

// Quelle page afficher ? (accueil par défaut)
$page = $_GET['page'] ?? 'accueil';

// ---- Page : Commentaires ----
if ($page === 'commentaires') {

    $commentaires   = readCommentaires($db);
    $nbCommentaires = countCommentaires($db);
    include ROOT_PROJECT . "/view/commentaires.html.php";

// ---- Page : Ajouter un commentaire ----
} elseif ($page === 'ajouter') {

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // On récupère et on nettoie les données du formulaire
        $email       = trim($_POST['email'] ?? '');
        $nom         = trim($_POST['nom'] ?? '');
        $titre       = trim($_POST['titre'] ?? '');
        $commentaire = trim($_POST['commentaire'] ?? '');

        // Validation backend (protection XSS côté serveur)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
            $errors['email'] = 'Email invalide ou trop long (max 120 caractères)';
        }
        if (mb_strlen($nom) < 5 || mb_strlen($nom) > 120) {
            $errors['nom'] = 'Nom : entre 5 et 120 caractères';
        }
        if (mb_strlen($titre) < 5 || mb_strlen($titre) > 180) {
            $errors['titre'] = 'Titre : entre 5 et 180 caractères';
        }
        if (mb_strlen($commentaire) < 5 || mb_strlen($commentaire) > 1000) {
            $errors['commentaire'] = 'Commentaire : entre 5 et 1000 caractères';
        }

        // Pas d'erreurs → on insère et on redirige vers les commentaires
        if (empty($errors)) {
            addCommentaire($db, $email, $nom, $titre, $commentaire);
            header('Location: index.php?page=commentaires');
            exit;
        }
    }

    include ROOT_PROJECT . "/view/ajouter.html.php";

// ---- Page : Accueil (défaut) ----
} else {

    include ROOT_PROJECT . "/view/homepage.html.php";

}
