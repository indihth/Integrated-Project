<?php
require_once 'classes/DBConnector.php';
require_once "include/database_connection.php";
require_once "include/validate_author.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Process request!!";

  echo "<pre>\$_POST = ";
  print_r($_POST);
  echo "</pre>";

  [$author, $errors] = author_validate($_POST);

  if (empty($errors)) {

    echo "<pre>\$author = ";
    print_r($author);
    echo "<pre>";

    echo "<pre>\$errors = ";
    print_r($errors);
    echo "<pre>";

    try {

      $author["id"] = $_POST["id"];

      $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'link' => $_POST['link']
      ];

      Post::edit('authors',  $author["id"], $data);

    //   $params = [
    //     "first_name" => $author["first_name"], 
    //     "last_name" => $author["last_name"], 
    //     "link" => $author["link"]
    // ];

    // $params["id"] = $_POST["id"];

    // $sql = "UPDATE author SET
    //             first_name = :first_name,
    //             last_name = :last_name,
    //             link = :link
    //         WHERE id = :id";


    //   $stmt = $connection->prepare($sql);
    //   $success = $stmt->execute($params);
      
    // if (!$success) {
    //     throw new Exception("Could not update author");
    // }

    } catch (Exception $e) {
      die("Exception: " . $e->getMessage());
    }

    $connection = null;
    header("Location: author_view_all.php");

  } else {
    session_start();
    $_SESSION["data"] = $author;
    $_SESSION["errors"] = $errors;
    header("Location: edit_author_form.php");
  }
} else {
  //returns error page on GET request
  http_response_code(405);
}

?>