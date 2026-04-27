<?php
# stagiaires/Laetitia/02-connection-with-constent/config-dev.php
# config-dev.php
# fichier de configuration de PDO en mode dev.
# Ce fichier peut être sur github car il ne contient pas de données sensibles
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost"; // Hôte locam Wamp
const DB_CONNECT_PORT = 3307; // Port MariaDB
const DB_CONNECT_NAME = "listepays"; // Nom de la DB
const DB_CONNECT_CHARSET = "utf8mb4"; // Encodage de notre connexion
const DB_CONNECT_USER = "root"; // Login par défaut
const DB_CONNECT_PWD = ""; // Pas de mot de passe par défaut