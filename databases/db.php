<?php 

class DB{
    private static function connect(){
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "lms";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    public static function query($query){  
        $conn = self::connect(); 
        $conn->exec($query); 
    }

}