<?php
  require_once 'classes/DBConnector.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Process request!!";

    echo "<pre>\$_POST = ";
    print_r($_POST);
    echo "<pre>";
  } 
  else {
    http_response_code(405);
  }

  $author["id"] = $_POST["id"];

  try {
      
      Post::delete('authors',  $author["id"]);

      header("Location: index.php");
      
  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
  }

  header("Location: author_view_all.php");
?>