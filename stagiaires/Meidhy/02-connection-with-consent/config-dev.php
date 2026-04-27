<?php
// stagiaires/Meidhy/02-connection-with-consent/config-dev.php
# config-dev.php
# fichier de configuration de PDO en mode Dev.
# Ce fichier peut être sur github car il contient pas de données sensibles
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost"; // hôte local WAMP
const DB_CONNECT_PORT = 3307; // port vers maria db 
const DB_CONNECT_NAME = "listepays"; // nom de la db 
const DB_CONNECT_CHARSET = "utf8mb4"; // encodage de notre connexion
const DB_CONNECT_USER = "root"; //login par défaut
const DB_CONNECT_PWD = ""; // pas de mot de passe par défaut 
