<?php
  require_once 'classes/DBConnector.php';

  $author["id"] = $_POST["id"];

  try {
      
      Post::delete('authors',  $author["id"]);

      header("Location: index.php");
      
  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
  }

  header("Location: author_view_all.php");
?>