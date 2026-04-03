<?php
/**
 * Ce fichier gère la connexion à la base de données en utilisant PDO. Il établit une connexion à la base de données MySQL en utilisant les informations de connexion fournies (hôte, nom de la base de données, nom d'utilisateur et mot de passe). Si la connexion est réussie, l'objet PDO est créé et prêt à être utilisé pour exécuter des requêtes SQL. Si la connexion échoue, une exception est levée et un message d'erreur est affiché.
* @var string $dns C'est la chaîne de connexion à la base de données
* @var string $utilisateur C'est le nom d'utilisateur pour se connecter à la base de données
* @var string $motDePasse C'est le mot de passe pour se connecter à la base de données
* @var PDO $connection C'est l'objet de connexion à la base de données
* @throws Exception Si la connexion à la base de données échoue, une exception est levée avec un message d'erreur
*/
try {
    $dns = 'mysql:host=172.20.33.11:3307;dbname=lafleurrr;charset=utf8';
    $utilisateur = 'sio1';
    $motDePasse = '123456789';
    $connection = new PDO($dns, $utilisateur, $motDePasse);
    $connection->query("SET NAMES utf8");
} catch (Exception $e) {
    echo "Connection à MySQL impossible : ", $e->getMessage();
    die();
}

?>