<?php

    class DataBase{
     
        private $conn;

        public function __construct($servername, $username, $password, $dbname){
            try {
                $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die ("Falha na conexão com o banco de dados: " . $e -> getMessage());
            }
        }

        public function getConnection(){
            return $this->conn;
        }
        
    }

?>