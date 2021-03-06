<?php session_start();

  include('../db/db.php');
  $name = explode(" ", $_SESSION['bufferUsername']);
  $benutzer = $db->abfrage('SELECT * FROM Benutzer WHERE (vorname=? AND nachname=?)',[$name[1],$name[0]])->fetchAll();
  if(empty($benutzer)) {
	  if(!empty($_GET['code'])) {
		  $klassenCode=$db->abfrage('SELECT pk_jahrgang,pk_buchstabe,pk_fk_pk_kuerzel FROM Klasse WHERE klassencode=?',[$_GET['code']])->fetchAll();
		  /*User ist nicht in der Datenbank*/
		  if(!empty($klassenCode)) {
			  $db->abfrage("INSERT INTO Benutzer (vorname, nachname, fk_pk_jahrgang, fk_pk_buchstabe, fk_pk_fk_pk_kuerzel)
							VALUES ('".$name[1]."','".$name[0]."',".$klassenCode[0]['pk_jahrgang'].",'".$klassenCode[0]['pk_buchstabe']."','".$klassenCode[0]['pk_fk_pk_kuerzel']."')",[]);
			  $benutzer = $db->abfrage('SELECT * FROM Benutzer WHERE (vorname=? AND nachname=?)',[$name[1],$name[0]])->fetchAll();
			  redirect($benutzer[0]['pk_userid']);
			  echo "noch nicht vorhanden + code eingegeben! + code richtig";
		  } else {
			echo "noch nicht vorhanden + code eingegeben! + code NICHT richtig";
		  }
	} else  {
		  echo "noch nicht vorhanden + code NICHT eingegeben!";
	  }
} else {
  /*User ist in der Datenbank*/
  echo "schon vorhanden!";
  redirect($benutzer[0]['pk_userid']);
}
$benutzer=$db->abfrage('SELECT * FROM Benutzer', [])->fetchAll();
var_dump($benutzer);

function redirect($pkUser) {
	$_SESSION['pkUser']=$pkUser;
	header('Location: /auswahl');
}

?>
<!DOCTYPE html>
<html lang="de" ng-app="Vorlage">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">

    <title>Vorlage</title>
    <link rel="icon" href="favicon.ico">
  
    <link rel="stylesheet" href="vendor/material-icons-3.0.1/material-icons.css">
    <link rel="stylesheet" href="vendor/roboto/roboto.css">
  
    <link rel="stylesheet" href="vendor/angular-material-1.1.10/angular-material.min.css">
  
    <link rel="stylesheet" href="app.css">

    <link rel="stylesheet" href="style2.css">

    <script src="vendor/jquery-3.3.1/jquery.min.js"></script>
    <script src="vendor/moment.js-2.22.2/moment.min.js"></script>
    <script src="vendor/moment.js-2.22.2/locale/de.js" charset="UTF-8"></script>

    <script src="vendor/angularjs-1.7.2/angular.min.js"></script>
    <script src="vendor/angularjs-1.7.2/angular-resource.min.js"></script>
    <script src="vendor/angularjs-1.7.2/angular-messages.min.js"></script>
    <script src="vendor/angularjs-1.7.2/angular-sanitize.min.js"></script>
    <script src="vendor/angularjs-1.7.2/angular-animate.min.js"></script>
    <script src="vendor/angularjs-1.7.2/angular-aria.min.js"></script>
    <script src="vendor/angularjs-1.7.2/i18n/angular-locale_de.js"></script>

    <script src="vendor/angular-material-1.1.10/angular-material.min.js"></script>
    <script src="vendor/angular-ui-router-1.0.18/angular-ui-router.min.js"></script>
  
    <script src="app.js"></script>
  </head>

  <body layout="column" layout-padding flex>
    <div id="titel">
      <h1>Anmeldung für das <span id="sportfest">Sportfest</span></h1>
    </div>

    <md-whiteframe class="md-whiteframe-5dp" layout="column" flex="50" layout-align="center center" layout-padding>

      <div>
          <img id="logo" src="bilder/logo.png" alt="HTL3R Logo">
      </div>
	  <form method='get' action='/loginCode/'>
      <md-input-container layout="row">
        <label>Klassencode</label>
        <input name='code' type='text' class="logininputs" ng-model="user.klassecode">
      </md-input-container>

      <md-button type="submit" name="loginbutton" class="md-raised md-primary">Login</md-button>
	  </form>
    </md-whiteframe>
  </body>

</html>