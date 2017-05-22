<?php

include('top-cache.php'); 

# Variables
$goal_amount = 350000; # Currency: Euro
$year = 2016;
$campaign = 1;

# API call
include_once('credentials.php');
$api_base = 'https://dons.wikimedia.fr/api/counter/get?';
$api_login = 'user_api=' . $user_api . '&pwd_api=' . $pwd_api;
$api_params = $api_login . '&frequency=once&campaigns[]=' . $campaign;
$api_call = file_get_contents($api_base . $api_params);

$api_return = explode(';', $api_call);

if ($api_return[0] == 1) {
    $api_result = explode('|', $api_return[1]);
    $current_amount = round($api_result[1]/100, 0);
    $percentage = round($current_amount/$goal_amount*100, 0);
    $data_available = 1;
} else {
    $data_available = 0;
}

# Countdown
$date = strtotime($year . "-12-31 23:59:59 CET");
$delay = $date - time();
$days = floor($delay / 86400);
$hours = floor(($delay % 86400)/ 3600);
$minutes = floor(($delay % 3600)/ 60);
$seconds = floor($delay % 60);


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
<?php if ($data_available) { ?>
  		<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%">
				<span class="sr-only"><?php echo $percentage; ?>%</span><?php echo $percentage; ?>%
				</div>
		</div>
  		<p class="text-center"><?php echo number_format($current_amount, 0, ',', ' '); ?> / <?php echo number_format($goal_amount, 0, ',', ' '); ?> €</p>

<?php } ?>
      <?php if (time() < $date) { ?>
      <p class="text-right"><em><?php 
        if ($days > 0) { 
          echo '<span  class="text-primary"><strong>' . $days .'</strong></span> jours restants';
        } else {
          echo '<span  class="text-primary"><strong>' . sprintf("%02d", $hours) . ':' . sprintf("%02d", $minutes) . '</strong></span> restantes';
        }
      } ?>
      </em></p>

  		<p>Wikimédia France ne vit que grâce à vos dons ! Pour que nous puissions continuer à soutenir la connaissance libre en <?php echo($year+1) ?>,
  		<strong><a href="http://dons.wikimedia.fr/soutenez-nous/" target="_blank" title="Soutenez-nous">soutenez-nous !</a></strong></p>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>

<?php include('bottom-cache.php'); ?>
