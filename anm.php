<?php
$klassencode = $_GET['klassencode'];
require '../db/db.php';

//SELECTS
        //gruppensportarten, wo min 1 Teilnehmer ist
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
        
        
        //gruppensportarten, wo niemand drinnen ist
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


//Einzelsportart NAMEN einfügen
        //besetzt: fk_pk_name
        foreach ($result_gruppe_besetzt as $row) {
        echo "<p>" . $row['fk_pk_name'] . "</p>";
        }
        
        //nicht: pk_name
        foreach ($result_gruppe_nicht as $row) {
        echo "<p>" . $row['pk_name'] . "</p>";
        }
        
        
//Einzelsportart ANZAHL/MAX ANZ einfügen
        //Anzahl der bereits Angemeldeten zu dieser Sportart aus einer Klasse UND die max anzahl
        foreach ($result_gruppe_besetzt as $row) {
            echo "<p>" . $row['count(fk_pk_userid)'] . "/" . $row['anzteilnehmer'] . "</p>";
        }
        
        //wenn nmd drinnen is, schreib ich null händisch hin UND die max anzahl
        foreach ($result_gruppe_nicht as $row) {
            echo "<p> 0/" . $row['anzteilnehmer'] . "</p>";
        }
        
?>
