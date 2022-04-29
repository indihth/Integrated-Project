<?php
require_once 'classes/DBConnector.php';

try {

  // $story = Get::byId('stories', $_GET["id"]);
  $authors = Get::all('authors');
  // $category = Get::byId('categories', $story->category_id);


  //  write statement to check if any stories have already been used
  //  by ID, avoid doubles in side categories

  $lifeStories = Get::byCategory('Life', 4);

} catch (Exception $e) {
  die("Exception: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/grid.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Integrated Project</title>
</head>

<body>
<!-- TITLE AND NAVBAR -->
<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/site/working/assets/"; include($IPATH."nav.php"); ?>

  <div class="container">
    <div class="width-3">
      <h1 class="mt-1 mb-2">List of Authors</h1>

      <button> <a href="add_author_form.php">Add Author</a></button>

      <table class="table">
        <thead>
          <tr>
            <th>Names</th>
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($authors as $author) {
            echo "<tr>";
            echo "<td><a href='author_view.php?id=" . $author->id . "'>" . $author->first_name . " " . $author->last_name . "</a></td>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
    <div class="width-1"></div>

    <!-- Right - mini stories -->
    <div class="width-3">
      <div class="eventTag tag">
        <p>Related Stories</p>
      </div>

      <!-- <div class="heading story">
      <p><span>trending</span> </p>
    </div> -->
      <?php foreach ($lifeStories as $lifeStory) {
        $category = GET::byId('categories', $lifeStory->category_id);
        $author = GET::byId('authors', $lifeStory->author_id);    ?>
        <div class="story">
          <h3><a href="article.php?id=<?= $lifeStory->id ?>"><?= $lifeStory->short_headline; ?></a></h3>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $lifeStory->date; ?></h5>
        </div>

      <?php  } ?>
    </div>
  </div>
  
  <!-- FOOTER -->
  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/site/working/assets/";
  include($IPATH . "footer.html"); ?>
</body>

</html>