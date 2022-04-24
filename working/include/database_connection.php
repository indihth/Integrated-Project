<?php
$servername = "localhost";
$username = "root";
$password = "";  //this is password for MAMP, Xampp is blank (change this)
$dbname = "news_articles";
  
try{
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      //echo "Connected to database successfully";  
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
        
?>