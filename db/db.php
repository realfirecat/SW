<?php
/*
Example code:
	include('db/db.php');
	$db->abfrage('SELECT * FROM USER WHERE pk_userid=?', [2])->fetchAll(); 	-> liefert ein zweidimensionales Array
*/

/*neue Datenbankverbindung als Variable: Database(Host,Datenbank,user,passwort)*/
$db=new Database("localhost","Sportfest","sportfest","!3_*#A_?m%");

/*Datenbank Klasse*/
class Database {
    private $db;

	/*Datenbankverbindung */
    function __construct($host, $dbname, $user, $password){
        try {
            $this->db = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $password);
            $this->db->exec("set names utf8");
        } catch (PDOException $e) {
            echo $e;
        }
    }

	/*
		qry = String (z.B. "SELECT * FROM USER WHERE pk_userid=?")
		array = Füllelemente als Array (z.B: 1 oder $_SESSION['pk_userid'])
	*/
    function abfrage($qry, $array) {
        $stmt = $this->db->prepare($qry);
        if($stmt->execute($array)) {
            return $stmt;
        }
    }

	/*
		schließt eine Datenbankverbindung, falls nötig (im Normallfall wird sie automatisch am Ende der Datei geschlossen)
	*/
    function closeConnection() {
        $this->db=null;
    }
	
	/*
		gibt das Datenbank-Objekt zurück, um Datenbankverbindungen zu clonen
	*/
    function getDb() {
        return $this->db;
    }
    
    /*
        hallo, max
    */
}
