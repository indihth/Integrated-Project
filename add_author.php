<?php
  require_once 'classes/DBConnector.php';

  try {
      
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'link' => $_POST['link']
      ];
      
      Post::create('authors', $data);

      header("Location: author_view_all.php");
      
  } catch (Exception $e) {
    die("Exception: " . $e->getMessage());
  }
?>