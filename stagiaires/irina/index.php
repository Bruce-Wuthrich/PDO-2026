<?php

#Notre connexion via PDO

$connexionPDO = new PDO(
    # dns (Data Source Name) = paramètres de connexion à la DB listepays sur le port 3307
    #de notre host localhost en charset utf8mb4
   "mysql:host=localhost;dbname=listepays;port=3307; charset=utf8mb4;", //dsn = Data Source Name
   "root", //username votre login
   "", // password = votre mot de passe
);
// on crée la requete qu'on va effectuer sur notre connexion
$request = $connexionPDO->query("
      SELECT * FROM countries;
      ");

//affichage de notre instance (notre object)de type PDO
var_dump($connexionPDO, $request);

// On va utilliser un wile pour parcourir chaque élement du tableau 
//chaque resultat en tableau associatif
while($item = $request->fetch(PDO::FETCH_ASSOC)){
    //affichage de la clef venant de la table
    //ici 'nom'
   echo $item['nom']."|";
}
