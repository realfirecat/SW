<?php
/**
 * Created by PhpStorm.
 * User: sarah
 * Date: 03.12.2018
 * Time: 15:39
 */
$klassencode = $_GET['klassencode'];
require '../db/db.php';

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



$result_gruppe_nicht = $db->abfrage("SELECT pk_name, anzteilnehmer FROM Sportart WHERE pk_name NOT IN (SELECT fk_pk_name FROM BenutzerSportart
    INNER JOIN Sportart ON fk_pk_name=pk_name 
	INNER JOIN Benutzer ON fk_pk_userid=pk_userid 
	INNER JOIN Klasse ON fk_pk_jahrgang=pk_jahrgang AND fk_pk_buchstabe=pk_buchstabe AND fk_pk_fk_pk_kuerzel=pk_fk_pk_kuerzel 
	WHERE (klassencode='" . $klassencode . "' and fk_pk_id=1)
	GROUP BY fk_pk_name) AND fk_pk_id=1", [])->fetchAll();
/*echo json_encode($result_gruppe_nicht);
foreach ($result_gruppe_nicht as $row) {
    echo $row['pk_name'];
}
echo "<br>";*/

$result_einzel_nicht = $db->abfrage("SELECT pk_name, anzteilnehmer FROM Sportart WHERE pk_name NOT IN (SELECT fk_pk_name FROM BenutzerSportart
        INNER JOIN Sportart ON fk_pk_name=pk_name 
        INNER JOIN Benutzer ON fk_pk_userid=pk_userid 
        INNER JOIN Klasse ON fk_pk_jahrgang=pk_jahrgang AND fk_pk_buchstabe=pk_buchstabe AND fk_pk_fk_pk_kuerzel=pk_fk_pk_kuerzel 
        WHERE (klassencode='" . $klassencode . "' and fk_pk_id=2)
        GROUP BY fk_pk_name) AND fk_pk_id=2", [])->fetchAll();
?>
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
                        <?php
                        /*Teamsportart(?) Sportartnamen einfügen*/
                        echo "<radio-button-group ng-model='$ctrl.einzelsportart' class='anmeldung_grid_radio' name='einzelsportart' rows='"
                            . json_encode($result_gruppe_besetzt + $result_gruppe_nicht)
                            . "'></radio-button-group>";
                        ?>

                        <h2 class="anmeldung_grid_header2">Teilnehmer</h2>
                        <div class="anmeldung_grid_teilnehmer">

                            <?php
                            /*Anzahl der bereits Angemeldeten zu dieser Sportart aus einer Klasse */
                            foreach ($result_gruppe_besetzt as $row) {
                                echo "<p>" . $row['count(fk_pk_userid)'] . "/" . $row['anzteilnehmer'] . "</p>";
                            }
                            /*Anzahl der max Teilnehmeranzahl zu dieser Sportart*/
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
                            /*Einzelsportart(?) Namen einfügen*/
                            echo "<radio-button-group class='anmeldung_grid_radio' ng-model='$ctrl.teamsportart' name='teamsportart' rows='"
                                . json_encode($result_einzel_besetzt + $result_einzel_nicht)
                                . "'></radio-button-group>";
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

    <md-button id="button_sportart_anmeldung" class="md-raised" ng-click="$ctrl.submit()" name="submitbutton" value="test">
        Bestätigen
    </md-button>
</form>

<div>{{$ctrl.status}}</div>