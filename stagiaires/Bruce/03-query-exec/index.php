<?php

require_once 'config-dev.php';

try { 
    $db = new PDO (
        dsn: MARIA_DSN,
        username: DB_CONNECT_USER, 
        password: DB_CONNECT_PWD, 
    );
} catch (Exception $e) {
    die("Numéro d'erreur: " . $e->getCode() . "<br>Message d'erreur: " . $e->getMessage());
}
if (isset($_POST['email'],$_POST['title'],$_POST['text'])){
    $mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
    $text = htmlspecialchars(trim(strip_tags($_POST['text'])));
    if($mail===false || empty($title) || empty($text)){
        $erreur = "Bien essayé, <a> href='javascript:history.go(-1)'>recommence </a>";
    }else{
        $db->exec("INSERT INTO `livre` (`email`, `title`, `text`) VALUES ('$mail', '$title', '$text');");
    }
    }
// on va recuperer tous les messages 
$sql = "SELECT * FROM `livre` ORDER BY `datetime` ASC;";
$request= $db->query($sql);
$nbArticcle = $request->rowCount();

$message = ($nbArticcle ===0)?
    $message = "pas encore de commentaires"
    : "Nous avons $nbArticcle commentaires";
$request->closeCursor();
$db = null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>livre d'or</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 16px;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            padding: 32px;
            width: 100%;
            max-width: 480px;
        }

        h1 {
            color: #333;
            margin-bottom: 24px;
            font-size: 1.6rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            color: #555;
            font-weight: bold;
        }

        input[type="email"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.95rem;
            transition: border-color 0.2s;
            outline: none;
        }

        input[type="email"]:focus,
        input[type="text"]:focus,
        textarea:focus {
            border-color: #4a90e2;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 11px;
            background-color: #4a90e2;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #357abd;
        }
    </style>
</head>
<body>
    <?php if (isset($erreur)) echo $erreur ?>
    <div class="container">
        <h1>Livre d'or</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="votre@email.com" required>
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" placeholder="Titre de votre message" required>
            </div>
            <div class="form-group">
                <label for="text">Message</label>
                <textarea id="text" name="text" placeholder="Votre message..." required></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <h3><?= $message ?></h3>
</body>
</html>