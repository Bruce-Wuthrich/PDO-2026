<?php $pageTitle = 'Ajouter un commentaire'; ?>
<?php require __DIR__ . '/_header.html.php'; ?>

<h1>Ajouter un commentaire</h1>

<form action="index.php?page=ajouter" method="post" id="commentForm" novalidate>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
               required maxlength="120">
        <?php if (!empty($errors['email'])): ?>
            <p class="error"><?= $errors['email'] ?></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="nom">Nom complet *</label>
        <input type="text" name="nom" id="nom"
               value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
               required minlength="5" maxlength="120">
        <?php if (!empty($errors['nom'])): ?>
            <p class="error"><?= $errors['nom'] ?></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="titre">Titre *</label>
        <input type="text" name="titre" id="titre"
               value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>"
               required minlength="5" maxlength="180">
        <?php if (!empty($errors['titre'])): ?>
            <p class="error"><?= $errors['titre'] ?></p>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="commentaire">Commentaire *</label>
        <textarea name="commentaire" id="commentaire"
                  rows="6" required minlength="5" maxlength="1000"><?= htmlspecialchars($_POST['commentaire'] ?? '') ?></textarea>
        <?php if (!empty($errors['commentaire'])): ?>
            <p class="error"><?= $errors['commentaire'] ?></p>
        <?php endif; ?>
    </div>

    <button type="submit">Envoyer</button>

</form>

<?php require __DIR__ . '/_footer.html.php'; ?>
