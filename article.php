<?php
require_once 'classes/DBConnector.php';

try {

  $story = Get::byId('stories', $_GET["id"]);
  $author = Get::byId('authors', $story->author_id);
  $category = Get::byId('categories', $story->category_id);


  //  write statement to check if any stories have already been used
  //  by ID, avoid doubles in side categories

  $cultureStories = Get::byCategory('Culture', 4);
  $worldStories = Get::byCategoryOrderBy('World', 'date ASC', 6);
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
  <!-- navbar -->
  <div class="header">
    <a href="index.php"><h1>Culture News</h1></a>
    <nav>
      <ul class="nav-cont">
        <li><a class="active nav-item" href="index.php">Home</a></li>
        <li><a class="nav-item" href="#news">News</a></li>
        <li><a class="nav-item" href="#news">Events</a></li>
        <li><a class="nav-item" href="#news">Add Story</a></li>
      </ul>
    </nav>
  </div>

  <div class="container">
    <div class="width-8">
      <!-- main story -->
      <div class="story">
        <div class="width-12 tag">
          <p>Welt</p>
        </div>

        <div class="width-6 viewArticle">
          <h1> <?= $story->headline ?> </h1>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $story->date ?></h5>
        </div>

        <div class="width-6 viewArticle">
          <p><?= $story->main_story ?></p>
        </div>
      </div>

      <a href="update_story_form.php?id=<?= $story->id; ?>">Update</a>
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
      <?php foreach ($worldStories as $worldStory) {
        $category = GET::byId('categories', $worldStory->category_id);
        $author = GET::byId('authors', $worldStory->author_id);    ?>
        <div class="story">
          <h3><a href="article.php?id=<?= $worldStory->id ?>"><?= $worldStory->short_headline; ?></a></h3>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $worldStory->date; ?></h5>
        </div>

      <?php  } ?>
    </div>
</body>

</html>