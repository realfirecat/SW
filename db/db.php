<?php

$db=new Database("localhost","Sportfest","sportfest","!3_*#A_?m%");

class Database {
    private $db;

    function __construct($host, $dbname, $user, $password){
        try {
            $this->db = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $password);
            $this->db->exec("set names utf8");
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function abfrage($qry, $array) {
        $stmt = $this->db->prepare($qry);
        if($stmt->execute($array)) {
            return $stmt;
        }
    }

    function einfuegen($sql) {
        $this->db->exec($sql);
        /*$stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':pass',$pass);
        $stmt->bindParam(':confirmed',$confirmed);
        $stmt->bindParam(':referral',$referral);
        $stmt->bindParam(':confirmationCode',$confirmationCode);
        $username="test";
        $email="test2@wdawd.at";
        $pass="testPass";
        $confirmed=false;
        $referral="testReferral";
        $confirmationCode="confirmationCode";
        $stmt->execute();*/
    }

    function closeConnection() {
        $this->db=null;
    }

    function getDb() {
        return $this->db;
    }
}
