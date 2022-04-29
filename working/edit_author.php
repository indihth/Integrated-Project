<?php
require_once 'classes/DBConnector.php';
require_once "include/validate_author.php";

    try {

      $author["id"] = $_POST['id'];

      $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'link' => $_POST['link']
      ];

      Post::edit('authors',  $author["id"], $data);

    } catch (Exception $e) {
      die("Exception: " . $e->getMessage());
    }
    header("Location: author_view_all.php");

    ?>