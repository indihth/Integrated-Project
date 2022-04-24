<?php
require_once 'classes/DBConnector.php';

try {

  $author = Get::byId('authors', $_GET["id"]);
  $stories = Get::byAuthor($_GET["id"], 'ASC', 2);

  // $stories = Get::('stories', $)


  //  write statement to check if any stories have already been used
  //  by ID, avoid doubles in side categories

  $lifeStories = Get::byCategory('Life', 4);
  $stageStories = Get::byCategoryOrderBy('Stage', 'date ASC', 6);
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
  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/site/working/assets/"; include($IPATH."nav.html"); ?> 

  <div class="container">
    <div class="width-8">

      <div>
        <h1 class="mt-1 mb-1"><?= $author->first_name, " ", $author->last_name ?></h1>

        <button> <a href="edit_author_form.php?id=<?= $author->id; ?>">Edit Author</a></button>

        <button><a href="delete_author_form.php?id=<?= $author->id; ?>">Delete Author</a></button>
      </div>

      <?php foreach ($stories as $story) {
        $category = GET::byId('categories', $story->category_id);
        $author = GET::byId('authors', $story->author_id);    ?>
        <div class="story">
          <h3><a href="article.php?id=<?= $story->id ?>"><?= $story->short_headline; ?></a></h3>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $story->date; ?></h5>
        </div>

      <?php  } ?>

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
      <?php foreach ($stageStories as $stageStory) {
        $category = GET::byId('categories', $stageStory->category_id);
        $author = GET::byId('authors', $stageStory->author_id);    ?>
        <div class="story">
          <h3><a href="article.php?id=<?= $stageStory->id ?>"><?= $stageStory->short_headline; ?></a></h3>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $stageStory->date; ?></h5>
        </div>

      <?php  } ?>
    </div>
    <script src="js/patient_validate.js"></script>
</body>

</html>