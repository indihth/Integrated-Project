<?php
  require_once 'classes/DBConnector.php';

  $story["id"] = $_POST["id"];

  try {
      
      Post::delete('stories',  $story["id"]);

      header("Location: index.php");
      
  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
  }
?>