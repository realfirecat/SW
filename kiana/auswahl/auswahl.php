<?php
    include '../db/db.php';
    
//    klassencode=a1b2&vorname=kiana&nachname=kaiss
    
    if (isset($_GET['klassencode']) && isset($_GET['vorname']) && isset($_GET['nachname'])) {
        $klassencode = $_GET['klassencode'];
        $vorname = $_GET['vorname'];
        $nachname = $_GET['nachname'];
    } else {
        echo "Fehler, falsche Daten bekommen";
        exit();
    }
    
    /*Tabelle mit Sportartname und teilnehmenden Schüleranzahl */
    $qry = "CREATE TABLE tmp AS (SELECT fk_pk_name, COUNT(fk_pk_name) AS anzahl FROM benutzersportart
                INNER JOIN sportart s ON benutzersportart.fk_pk_name = s.pk_name
                WHERE fk_pk_userid IN (SELECT benutzer.pk_userid FROM benutzer
                INNER JOIN klasse k ON benutzer.fk_pk_jahrgang = k.pk_jahrgang AND benutzer.fk_pk_buchstabe = k.pk_buchstabe AND benutzer.fk_pk_fk_pk_kuerzel = k.pk_fk_pk_kuerzel
                WHERE k.klassencode = ?)
                GROUP BY fk_pk_name);";
    $ary = array($klassencode);
    $sql = $db->abfrage($qry, $ary);
    
    $qry2 = "SELECT * FROM tmp
                INNER JOIN sportart ON tmp.fk_pk_name = sportart.pk_name
                INNER JOIN sportarttyp s ON sportart.fk_pk_id = s.pk_id
                WHERE s.pk_id = 2";
    $ary2 = array();
    $sql2 = $db->abfrage($qry2, $ary2);
    
    var_dump( $sql2);
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
    
    <link rel="stylesheet" href="app.css">
    
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
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
    <link rel="stylesheet" href="app.css">
</head>

<body layout="column" id="anmeldung">

<nav>
    <md-whiteframe layout="row" id="nav-whiteframe" class="md-whiteframe-10dp" layout-align="space-between center">
        <img src="images/htl3r_logo_transp_gross.png">
        <md-button class="md-raised" id="abmelden">Abmelden</md-button>
    </md-whiteframe>
</nav>

<div id="sportart_anmeldung" layout="column" layout-align-gt-xs="center center">
    
    <div id="anmeldung_h1" layout="row" layout-align="center center">
        <h1>Bitte wählen Sie eine Teamsportart und eine Einzelsportart aus.</h1>
    </div>
    
    <md-whiteframe id="anmeldung_whiteframe" class="md-whiteframe-10dp">
        <md-content>
            <md-tabs md-stretch-tabs="always">
                
                <md-tab label="Einzelsportart" >
                    <div class="anmeldung_grid_container">
                        <h2 class="anmeldung_grid_header1">Sportart</h2>
                        <md-radio-group name="einzelsportart" class="anmeldung_grid_radio">
                            <md-radio-button value="bowling">Bowling</md-radio-button>
                            <md-radio-button value="billiard">Billiard</md-radio-button>
                            <md-radio-button value="schach">Schach</md-radio-button>
                            <md-radio-button value="leichtathletik">Leichtathletik</md-radio-button>
                            <md-radio-button value="minigolf">Minigolf</md-radio-button>
                            <md-radio-button value="tennis">Tennis</md-radio-button>
                            <md-radio-button value="badminton">Badminton</md-radio-button>
                            <md-radio-button value="sudoku">Sudoku</md-radio-button>
                            <md-radio-button value="floorball">Floorball</md-radio-button>
                            <md-radio-button value="boccia">Boccia</md-radio-button>
                            <md-radio-button value="Brettspiele">Brettspiele</md-radio-button>
                            <md-radio-button value="darts">Darts</md-radio-button>
                            <md-radio-button value="klettern">Klettern</md-radio-button>
                        </md-radio-group>
                        <h2 class="anmeldung_grid_header2">Teilnehmer</h2>
                        <div class="anmeldung_grid_teilnehmer">
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                        </div>
                    </div>
                </md-tab>
                
                <md-tab label="Teamsportart">
                    
                    <div class="anmeldung_grid_container">
                        <h2 class="anmeldung_grid_header1">Sportart</h2>
                        <md-radio-group name="teamsportart" class="anmeldung_grid_radio">
                            <md-radio-button value="basketball" >Basketball</md-radio-button>
                            <md-radio-button value="hockey"> Hockey </md-radio-button>
                            <md-radio-button value="fussball">Fußball</md-radio-button>
                            <md-radio-button value="volleyball">Volleyball</md-radio-button>
                            <md-radio-button value="ultimate">Ultimate</md-radio-button>
                            <md-radio-button value="tauziehen">Tauziehen</md-radio-button>
                        </md-radio-group>
                        <h2 class="anmeldung_grid_header2">Teilnehmer</h2>
                        <div class="anmeldung_grid_teilnehmer">
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                            <p>8/10</p>
                        </div>
                    </div>
                </md-tab>
            
            </md-tabs>
        </md-content>
    </md-whiteframe>
    
    <md-button id="button_sportart_anmeldung" class="md-raised" name="submitbutton">Bestätigen</md-button>
</div>
</body>

</html>
