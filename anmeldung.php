<?php


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
    <script src="components/radio-button.js"></script>
    <script src="components/radio-button-group.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
    <link rel="stylesheet" href="css/app_anmeldung.css">
    <script src="components/anmeldung.js"></script>
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
<anmeldung></anmeldung>


</body>

</html>