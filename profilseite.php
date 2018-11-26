<?php
    include '../db/db.php';
    
    $vorname = $_GET['vorname'];
    $nachname = $_GET['nachname'];
    
    /*$db = new Database("localhost", "sportfest", "kiana", "kiana");
   */
//    $qry3 = "(SELECT CONCAT(fk_pk_jahrgang, fk_pk_buchstabe, fk_pk_fk_pk_kuerzel) from Benutzer
//          where vorname like 'maximilian' and nachname like 'groß')";
//    $ary3 = array();
//    $rs3 = $db->ababfrage($qry3, $ary3);
    
    
    
    if (isset($_GET['radiobuttonGruppen'])) {
        $gruppensportart = $_GET['radiobuttonGruppen'];
        
        $qry1 = "insert into benutzersportart
        values ((select benutzer.pk_userid from benutzer
        where vorname like $vorname and nachname like $nachname), $gruppensportart);";
        $db->einfuegen($qry1);
        
    }
    
    if (isset($_GET['radiobuttonEinzel'])) {
        $einzelsportart = $_GET['radiobuttonEinzel'];
        
        $qry2 = "insert into benutzersportart
        values ((select benutzer.pk_userid from benutzer
        where vorname like $vorname and nachname like $nachname), $einzelsportart);";
        $db->einfuegen($qry2);
        
    }
    ?>

<!DOCTYPE html>
<html lang="de" ng-app="Vorlage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Vorlage</title>
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
    <script src="components/mein-slider.js"></script>
    <script src="components/rgb-slider.js"></script>
    
    <link href="css/app_profilseite.css"
          rel="stylesheet"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
</head>

<body layout="column">

<md-toolbar class="md-hue-2" >
    <div class="md-toolbar-tools" layout-align="space-between center">
        <img id="profilseite_logo" src="../bilder/logo.png">
        <md-button class="md-raised md-accent md-hue-3" aria-label="Learn More">
            Abmelden
        </md-button>
    </div>
</md-toolbar>

<div id="profilseite_auswahl">
    <h1 id="profilseite_h1"> Ihre Auswahl für das Sportfest</h1>
</div>

<div class="profilseite_scrolling">
    
    <md-whiteframe class="md-whiteframe-0dp" layout layout-align="center center">
        <div id="profilseite_schuelername" flex="80" layout="row" layout-padding>
            <p name="schueler" class="profilseite_name">
                <?php echo $vorname. " ". $nachname; ?>
            </p>
            <p name="klasse" class="profilseite_name"> 4AI</p>
        </div>
    </md-whiteframe>
    
    <md-whiteframe class="md-whiteframe-0dp" layout layout-align="center center">
        <div id="profilseite_auswahlSPA" flex="80" layout-margin layout-align="center center">
            <div flex="70" layout-align="center center">
                <div layout-align="center center">
                    <h2 id="profilseite_h2"> Ausgewählte Sportarten</h2>
                </div>
                <div layout="row">
                    <div flex="5"></div>
                    <div flex="90">
                        <div>
                            <h3 profilseite_h3>Teamsportart</h3>
                            <div layout="row" layout-align="space-around">
                                <div layout="row" flex layout-align="space-between">
                                    <div class="sportart">
                                        <p class="profilseite_sportartTE" name="gewaehltTeam"> <?php echo $gruppensportart; ?> </p>
                                    </div>
                                    <div class="ausrichtungbutton">
                                        <md-button class="md-raised aendern" name="teamAendernButton">
                                            Ändern
                                        </md-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div id="einzelsportart">
                            <h3>Einzelsportart</h3>
                            <div layout="row" layout-align="center">
                                <div  layout="row" flex layout-align="space-between stretch">
                                    <div>
                                        <p class="profilseite_sportartTE" name="gewaehltEinzel"> <?php echo $einzelsportart; ?> </p>
                                    </div>
                                    <div >
                                        <md-button class="md-raised aendern" name="einzelnAendernButton">Ändern
                                        </md-button>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div id="profilseite_infodiv">
                    <p id="profilseite_info"> Sie sind fertig mit der Anmeldung für das Sportfest. Sie können Ihre Auswahl bis
                        zum
                        15.März 2018 ändern</p>
                </div>
            </div>
        </div>
    </md-whiteframe>
</div>
</body>

</html>
