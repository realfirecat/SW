<?php
$klassencode = $_GET['klassencode'];
require 'db/db.php';

$result_gruppe_besetzt = $db->abfrage("SELECT count(fk_pk_userid),fk_pk_name, anzteilnehmer FROM BenutzerSportart
    INNER JOIN Sportart ON fk_pk_name=pk_name 
	INNER JOIN Benutzer ON fk_pk_userid=pk_userid 
	INNER JOIN Klasse ON fk_pk_jahrgang=pk_jahrgang AND fk_pk_buchstabe=pk_buchstabe AND fk_pk_fk_pk_kuerzel=pk_fk_pk_kuerzel 
	WHERE (klassencode='" . $klassencode . "' and fk_pk_id=1)
	GROUP BY fk_pk_name", [])->fetchAll();

$result_einzel_besetzt = $db->abfrage("SELECT count(fk_pk_userid),fk_pk_name, anzteilnehmer FROM BenutzerSportart
        INNER JOIN Sportart ON fk_pk_name=pk_name 
        INNER JOIN Benutzer ON fk_pk_userid=pk_userid 
        INNER JOIN Klasse ON fk_pk_jahrgang=pk_jahrgang AND fk_pk_buchstabe=pk_buchstabe AND fk_pk_fk_pk_kuerzel=pk_fk_pk_kuerzel 
        WHERE (klassencode='" . $klassencode . "' and fk_pk_id=2)
        GROUP BY fk_pk_name", [])->fetchAll();

/*foreach ($result_gruppe as $row) {
    echo $row['fk_pk_name'];
    echo $row['count(fk_pk_userid)'];
    echo $row['anzteilnehmer'];
}
echo "<br>";*/


$result_gruppe_nicht = $db->abfrage("SELECT pk_name, anzteilnehmer FROM Sportart WHERE pk_name NOT IN (SELECT fk_pk_name FROM BenutzerSportart
    INNER JOIN Sportart ON fk_pk_name=pk_name 
	INNER JOIN Benutzer ON fk_pk_userid=pk_userid 
	INNER JOIN Klasse ON fk_pk_jahrgang=pk_jahrgang AND fk_pk_buchstabe=pk_buchstabe AND fk_pk_fk_pk_kuerzel=pk_fk_pk_kuerzel 
	WHERE (klassencode='" . $klassencode . "' and fk_pk_id=1)
	GROUP BY fk_pk_name) AND fk_pk_id=1", [])->fetchAll();

$result_einzel_nicht = $db->abfrage("SELECT pk_name, anzteilnehmer FROM Sportart WHERE pk_name NOT IN (SELECT fk_pk_name FROM BenutzerSportart
        INNER JOIN Sportart ON fk_pk_name=pk_name 
        INNER JOIN Benutzer ON fk_pk_userid=pk_userid 
        INNER JOIN Klasse ON fk_pk_jahrgang=pk_jahrgang AND fk_pk_buchstabe=pk_buchstabe AND fk_pk_fk_pk_kuerzel=pk_fk_pk_kuerzel 
        WHERE (klassencode='" . $klassencode . "' and fk_pk_id=2)
        GROUP BY fk_pk_name) AND fk_pk_id=2", [])->fetchAll();

/*foreach ($result2 as $row) {
    echo $row['pk_name'];
    echo $row['anzteilnehmer'];
}*/

if (!empty($_GET['einzelsportart'])) {
    echo "einzel ausgewählt";
}

if (!empty($_GET['teamsportart'])) {
    echo "team ausgewählt";
}


?>

<!DOCTYPE html>
<html lang="de" ng-app="Vorlage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sportarten Anmeldung</title>
    <link rel="icon" href="favicon.ico">

    <link rel="stylesheet" href="vendor/material-icons-3.0.1/material-icons.css">
    <link rel="stylesheet" href="vendor/roboto/roboto.css">

    <link rel="stylesheet" href="vendor/angular-material-1.1.10/angular-material.min.css">

    <link rel="stylesheet" href="css/app_anmeldung.css">

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
<<<<<<< HEAD
    <script src="/components/radio-button.js"></script>
=======
    <script src="components/radio-button.js"></script>
>>>>>>> 592fad624e60c5d6f15b4de0e4732dcbd589d6fb

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
    <link rel="stylesheet" href="css/app_anmeldung.css">
</head>

<body layout="column" id="anmeldung">

<md-toolbar class="md-hue-2">
    <div class="md-toolbar-tools" layout-align="space-between center">
        <img id="profilseite_logo" src="bilder/logo.png">
        <md-button class="md-raised md-accent md-hue-3" aria-label="Learn More">
            Abmelden
        </md-button>
    </div>
</md-toolbar>

<form method="get" name="anmeldung_form" action="anmeldung.php" id="sportart_anmeldung" layout="column"
      layout-align-gt-xs="center center">
    <div id="anmeldung_h1" layout="row" layout-align="center center">
        <h1>Bitte wählen Sie eine Teamsportart und eine Einzelsportart aus.</h1>
    </div>

    <md-whiteframe id="anmeldung_whiteframe" class="md-whiteframe-10dp">
        <md-content>
            <md-tabs md-stretch-tabs="always">

                <md-tab label="Einzelsportart">
                    <div class="anmeldung_grid_container">
                        <h2 class="anmeldung_grid_header1">Sportart</h2>
                        <md-radio-group ng-model="data.group2" class="anmeldung_grid_radio">
                            <?php
                            foreach ($result_gruppe_besetzt as $row) {
                                echo "<radio-button name=\"einzelsportart\" value=\"" . $row['pk_name'] . "\">" . $row['pk_name'] . "</radio-button>";
                            }
                            foreach ($result_gruppe_nicht as $row) {
                                echo "<radio-button name=\"einzelsportart\" value=\"" . $row['pk_name'] . "\">" . $row['pk_name'] . "</radio-button>";
                            }
                            ?>
                        </md-radio-group>

                        <h2 class="anmeldung_grid_header2">Teilnehmer</h2>
                        <div class="anmeldung_grid_teilnehmer">

                            <?php
                            foreach ($result_gruppe_besetzt as $row) {
                                echo "<p>" . $row['count(fk_pk_userid)'] . "/" . $row['anzteilnehmer'] . "</p>";
                            }
                            foreach ($result_gruppe_nicht as $row) {
                                echo "<p> 0/" . $row['anzteilnehmer'] . "</p>";
                            }
                            ?>

                        </div>
                    </div>
                </md-tab>

                <md-tab label="Teamsportart">

                    <div class="anmeldung_grid_container">
                        <h2 class="anmeldung_grid_header1">Sportart</h2>
                        <md-radio-group class="anmeldung_grid_radio">
                            <?php
                            foreach ($result_einzel_besetzt as $row) {
<<<<<<< HEAD
                                echo "<radio-button name=\"teamsportart\" value=\"" . $row['pk_name'] . "\">" . $row['pk_name'] . "</radio-button>";
                            }
                            foreach ($result_einzel_nicht as $row) {
                                echo "<radio-button name=\"teamsportart\" value=\"" . $row['pk_name'] . "\">" . $row['pk_name'] . "</radio-button>";
=======
                                echo "<radio-button name=\"einzelsportart\" value=\"" . $row['pk_name'] . "\">" . $row['pk_name'] . "</radio-button>";
                            }
                            foreach ($result_einzel_nicht as $row) {
                                echo "<radio-button name=\"einzelsportart\" value=\"" . $row['pk_name'] . "\">" . $row['pk_name'] . "</radio-button>";
>>>>>>> 76da3fe99bce357d1e93a80005e4f9724aa8ec8a
                            }
                            ?>
                        </md-radio-group>
                        <h2 class="anmeldung_grid_header2">Teilnehmer</h2>
                        <div class="anmeldung_grid_teilnehmer">
                            <?php
                            /*echo $row['count(fk_pk_userid)'];
                            echo $row['anzteilnehmer'];*/
                            foreach ($result_einzel_besetzt as $row) {
                                echo "<p>" . $row['count(fk_pk_userid)'] . "/" . $row['anzteilnehmer'] . "</p>";
                            }
                            foreach ($result_einzel_nicht as $row) {
                                echo "<p> 0/" . $row['anzteilnehmer'] . "</p>";
                            }
                            ?>
                        </div>
                    </div>
                </md-tab>

            </md-tabs>
        </md-content>
    </md-whiteframe>

    <md-button type='submit' id="button_sportart_anmeldung" class="md-raised" name="submitbutton" value="test">
        Bestätigen
    </md-button>
</form>

</body>

</html>
<!--Hallo Max jjjjjj-->