<?php
//stagiaires/Meidhy/02-connection-with-consent/index.php

// chargement des dépendances 
require_once 'config-dev.php';

// on veut se connecter (essai)
try{
    //tentative de connexion 
    $db = new PDO(
        //équivaut à MySQL:
        dsn: DB_CONNECT_TYPE.":" .
        // host=localhost
        "host=".DB_CONNECT_HOST .
        // ; dbname =
        ";dbname=".DB_CONNECT_NAME .
        // ; port:3307
        ";port=".DB_CONNECT_PORT . 
        // ; charset=utf8mb4;
        ";charset=".DB_CONNECT_CHARSET . ";" 
        ,
        username: DB_CONNECT_USER,
        password: "",
        );



// en cas d'erreur (équivalent $e = new PDOexception)
}catch(PDOException $e){
    //on récupère et on l'affiche 
    echo "Erreur numéro : ".$e->getcode(); // le code
    echo "<br>Message de l'erreur : ".$e->getmessage(); // le message 
}

// création de la requête SELECT sans variable utilisateurs 
$sql = "SELECT c.`nom`, c.`population`, c.`continent`, c.`capitale`
            FROM `countries` c
            ORDER BY c.`population` DESC";

// véritable requête 
$request = $db->query($sql);

//on récupère les données dans un format lisible par php 
$resultat = $request->fetchAll(PDO::FETCH_ASSOC);

// Bonne pratique mais pas utile pour Maria ou MySQL 
$request->closeCursor();

// Bonne pratique mais pas utile pour Maria ou MySQL 
// Sauf si requête permanente 
$db = null; 

// transformation en JSON 
// $json = json_encode($resultat, JSON_PRETTY_PRINT);
// on va écrire un fichier .json 
// pour ne plus devoir faire la requête 
// pour monsieur tout le monde
// création du fichier si il n'existe pas, sinon ouverture  
// $file = fopen("allCountrie.json", "wr");
//     fputs($file, $json);
// fclose($file); 
// var_dump($db,$request, $resultat); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les pays du monde</title>
</head>
<body>
    <h1>Les pays du monde</h1>
    <table>
        <thead>
            <tr>
                <td>Pays</td>
                <td>Population</td>
                <td>Capitale</td>
            </tr>
        </thead>
        <tbody>
        <?php
        // tant qu'on a des pays
        foreach($resultat as $item):
        ?>
        <tr>
            <td><span title="<?= $item['continent'] ?>"><?= $item['nom'] ?></span></td>
            <td><?= $item['population'] ?></td>
            <td><?= $item['capitale'] ?></td>
        </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</body>
</html>