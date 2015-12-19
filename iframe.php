<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('credentials.php');

try {
    $bdd = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('select FLOOR(SUM(total_amount)) AS total from civicrm_contribution WHERE contribution_status_id = 1 AND financial_type_id IN (1, 3) AND receive_date >= '2015-12-01';');

$donnees = $reponse->fetchAll();

print_r($donnees);

$reponse = $bdd->query('select FLOOR(goal_revenue) from civicrm_campaign where id =4;');

$donnees = $reponse->fetchAll();

print_r($donnees);

//*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Soutenez-nous !</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div id=\"donations-thermometer\">
  		<h3>On a besoin de vous !</h3>
  		<p>$amount / 300 000
  		<p>Wikimédia France ne vit que grâce à vous.</p>
		<p><a href=\"$base_url/civicrm/contribute/transact?reset=1&id=2\" title=\"Soutenez-nous\">Soutenez-nous !</a></p>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>

