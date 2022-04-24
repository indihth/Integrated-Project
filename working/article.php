<?php
require_once 'classes/DBConnector.php';

try {

  $story = Get::byId('stories', $_GET["id"]);
  $author = Get::byId('authors', $story->author_id);
  $category = Get::byId('categories', $story->category_id);


  //  write statement to check if any stories have already been used
  //  by ID, avoid doubles in side categories
  //  same category as current story


  $relatedStories = Get::byCategoryOrderBy($category->name, 'date ASC', 4);
  // $otherStories = ??
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
  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/site/working/assets/";
  include($IPATH . "nav.html"); ?>

  <div class="container">
    <div class="width-8">
      <!-- main story -->
      <div class="story">
        <div class="width-12 tag">
          <p><?= $category->name; ?></p>
        </div>

        <div class="width-6 viewArticle">
          <h1 class="mb-1"><?= $story->headline ?></h1>
          <h4 class="mb-1"><?= $story->short_headline ?></h4>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $story->date ?></h5>
        </div>

        <div class="width-6 viewArticle">
          <p><?= $story->main_story ?></p>
        </div>
      </div>

      <button class="btn_prime"><a href="edit_story_form.php?id=<?= $story->id; ?>">Edit</a></button>
      <button><a href="delete_story_form.php?id=<?= $story->id; ?>">Delete</a></button>

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
      <?php foreach ($relatedStories as $relatedStory) {
        $category = GET::byId('categories', $relatedStory->category_id);
        $author = GET::byId('authors', $relatedStory->author_id);    ?>
        <div class="story">
          <h3><a href="article.php?id=<?= $relatedStory->id ?>"><?= $relatedStory->short_headline; ?></a></h3>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $relatedStory->date; ?></h5>
        </div>

      <?php  } ?>
    </div>
</body>

</html>