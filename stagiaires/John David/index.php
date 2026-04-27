<?php

// notre premiere connexion

$connexionPDO = new PDO(
    dsn: "mysql:host=localhost;dbname=listepays;port=3307;charset=utf8mb4",
    username: "root",
    password: "",
);

$request = $connexionPDO->query("
    SELECT * FROM countries
");


var_dump($connexionPDO, $request);


while($item = $request->fetch(PDO::FETCH_ASSOC)){
    echo $item['nom']." | ";
}