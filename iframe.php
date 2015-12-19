<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('credentials.php');

try {
    $bdd = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

$response = $bdd->query("SELECT FLOOR(SUM(total_amount)) AS current_amount FROM civicrm_contribution WHERE contribution_status_id = 1 AND financial_type_id IN (1, 3) AND receive_date >= '2015-12-01';");

$data = $response->fetchAll();

$current_amount = $data[0]['current_amount'];

$response = $bdd->query("SELECT FLOOR(goal_revenue) AS goal_amount FROM civicrm_campaign WHERE id =4;");

$data = $response->fetchAll();
$goal_amount = $data[0]['goal_amount'];

$percentage = round($current_amount/$goal_amount*100, 0);

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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
	<link rel="stylesheet" href="iframe.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div id="donations-thermometer">
  		<h3>On a besoin de vous !</h3>
  		<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%">
				<span class="sr-only"><?php echo $percentage; ?>%</span><?php echo $percentage; ?>%
				</div>
		</div>
  		<p class="text-center"><?php echo number_format($current_amount, 0, ',', ' '); ?> / <?php echo number_format($goal_amount, 0, ',', ' '); ?> €</p>
  		<p>Wikimédia France ne vit que grâce à vos dons ! Pour que nous puissions continuer à soutenir la connaissance libre en 2016,
  		<strong><a href="http://dons.wikimedia.fr/civicrm/contribute/transact?reset=1&id=2" title="Soutenez-nous">soutenez-nous !</a></strong></p>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>

