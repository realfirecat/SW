<?php
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
        }
        
        function closeConnection() {
            $this->db=null;
        }
        
        function getDb() {
            return $this->db;
        }
    }