<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('credentials.php');

try {
    $bdd = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM civicrm_contribution LIMIT 5;');

$donnees = $reponse->fetchAll();

print_r($donnees);

?>