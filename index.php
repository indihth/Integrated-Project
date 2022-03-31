<!-- create, delete then update -->
<?php
require_once 'classes/DBConnector.php';

try {

  // gets 1st newest story from World
  $headlineStories = Get::byCategoryOrderBy('world', 'date ASC', 1);
  // gets all subsequent stories from World, skips first
  $subStories = Get::byCategoryOrderBy('world', 'date ASC', 2, 1);

  // add event table for left headline column
  // $events = Get::all('events', 6);

  $cultureStories = Get::byCategory('Culture', 4);
  $worldStories = Get::byCategoryOrderBy('World', 'date ASC', 4);
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
    <!-- Left - headline only stories -->
    <div class="width-3">

      <!-- 1st headline only category -->
      <div class="mb-1">
        <div class="eventTag tag">
          <p>Current Events</p>
        </div>

        <?php foreach ($worldStories as $worldStory) {
          $category = GET::byId('categories', $worldStory->category_id);
          $author = GET::byId('authors', $worldStory->author_id);    ?>
          <div class="story">
            <!-- <div class="tag">
            <p><?= $category->name; ?></p>
          </div> -->
            <h3><a href="article.php?id=<?= $worldStory->id ?>"><?= $worldStory->short_headline; ?></a></h3>
            <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $worldStory->date; ?></h5>
          </div>
        <?php  } ?>
      </div>
      <!-- 2nd headline only category -->

      <div class="mb-1">
        <div class="eventTag tag">
          <p>Upcoming Events</p>
        </div>

        <!-- <div class="story">
        <div class="tag">
          <p>Upcoming Events</p>
        </div>
        </div> -->

        <?php foreach ($worldStories as $worldStory) {
          $category = GET::byId('categories', $worldStory->category_id);
          $author = GET::byId('authors', $worldStory->author_id);    ?>
          <div class="story">
            <!-- <div class="tag">
            <p><?= $category->name; ?></p>
          </div> -->
            <h3><a href="article.php?id=<?= $worldStory->id ?>"><?= $worldStory->short_headline; ?></a></h3>
            <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $worldStory->date; ?></h5>
          </div>

        <?php  } ?>
      </div>
    </div>
    <!-- Middle - main stories -->
    <div class="width-6">
      <!-- main story -->
      <?php
      $category = GET::byId('categories', $headlineStories[0]->category_id);
      $author = GET::byId('authors', $headlineStories[0]->author_id);
      ?>

      <div class="story">
        <div class="tag">
          <p><?= $category->name; ?></p>
        </div>
        <h1><a href="article.php?id=<?= $headlineStories[0]->id ?>"><?= $headlineStories[0]->headline; ?></a></h1>
        <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $headlineStories[0]->date; ?></h5>
        <p><?= substr($headlineStories[0]->main_story, 0, 500);
            echo "...(read more)"; ?></p>
      </div>

      <!-- substories -->
      <?php foreach ($subStories as $subStory) {
        $category = GET::byId('categories', $subStory->category_id);
        $author = GET::byId('authors', $subStory->author_id);    ?>
        <div class="story">
          <div class="tag">
            <p><?= $category->name; ?></p>
          </div>
          <h2><a href="article.php?id=<?= $subStory->id ?>"><?= $subStory->headline; ?></a></h2>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $subStory->date; ?></h5>
          <p><?= substr($subStory->main_story, 0, 250);
              echo "...(read more)"; ?></p>
        </div>

      <?php  } ?>
    </div>

    <!-- Right - mini stories -->
    <?php foreach ($cultureStories as $cultureStory) {
      $category = GET::byId('categories', $cultureStory->category_id);
      $author = GET::byId('authors', $cultureStory->author_id);    ?>

      <div class="width-3">
        <div class="story">
          <div class="tag">
            <p><span><?= $category->name; ?></span></p>
          </div>
          <h3><a href="article.php?id=<?= $cultureStory->id ?>"><?= $cultureStory->short_headline; ?></a></h3>
          <p><?= $cultureStory->summary; ?></p>
          <h5><span><?= $author->first_name; ?> <?= $author->last_name; ?></span> - <?= $cultureStory->date; ?></h5>
        </div>

      <?php  } ?>
      </div>
</body>

</html>