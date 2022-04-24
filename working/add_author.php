<?php
require_once 'classes/DBConnector.php';
require_once "include/validate_author.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Process request!!";

  [$author, $errors] = author_validate($_POST);

  if (empty($errors)) {

    try {

      $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'link' => $_POST['link']
      ];

      Post::create('authors', $data);

    } catch (Exception $e) {
      die("Exception: " . $e->getMessage());
    }
    header("Location: author_view_all.php");
  } else {
    session_start();
    $_SESSION["data"] = $author;
    $_SESSION["errors"] = $errors;
    header("Location: add_author_form.php");
  }
} else {
  //returns error page on GET request
  http_response_code(405);
}


?>