<?php 
    function redirect(){ // Redirects
        header("Location : /index.php");
    }

    function OpenCon(){ // Opens the connection
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'skillforge';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName) or die("Connect Fialed! %s\n". $conn -> error);
    
        return $conn;
    }

    function secure($value){ // Protects against SQL injection
        global $conn;
        $value = $conn -> real_escape_string($value);
        $value = strip_tags($value);
        $value = trim($value);
        return $value;
    }
?>