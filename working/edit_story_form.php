<?php
require_once 'classes/DBConnector.php';

try {

    $story = Get::byId('stories', $_GET["id"]);
    $author = Get::byId('authors', $story->author_id);
    $category = Get::byId('categories', $story->category_id);


    $categories = Get::all('categories');
    $authors = Get::all('authors');
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

    <div class="main">

        <!-- important POST method -->
        <form method="POST" action="edit_story.php" class="form center">
            <h2>Edit Story</h2>

            <input type="hidden" name="id" value="<?= $story->id ?>">

            <div>
                <label for="">Headline</label>
                <!-- use NAME to put value into POST -->
                <input type="text"  id="headline"  name="headline" value="<?= $story->headline ?>">
                <div id="headline_error" class="error"></div>
            </div>

            <div>
                <label for="short_headline">Short headline</label>
                <input type="text" id="short_headline"  name="short_headline" value="<?= $story->short_headline ?>">
                <div id="short_headline_error" class="error"></div>
            </div>

            <div>
                <label for="sub_heading">Sub-heading</label>
                <input type="text" id="sub_heading"  name="sub_heading" value="<?= $story->sub_heading ?>">
                <div id="sub_heading_error" class="error"></div>
            </div>
            <div>
                <label for="main_story">Main Story</label>
                <textarea id="main_story"  name="main_story" cols="30" rows="10"><?= $story->main_story ?></textarea>
                <div id="main_story_error" class="error"></div>
            </div>
            <div>
                <label for="summary">Summary</label>
                <textarea id="summary"  name="summary" cols="30" rows="10"><?= $story->summary ?></textarea>
                <div id="summary_error" class="error"></div>
            </div>
            <div>
                <label for="">Date</label>
                <input type="date" id="date"  name="date" value="<?= $story->date ?>">
                <div id="date_error" class="error"></div>
            </div>
            <div>
                <label for="">Time</label>
                <input type="time" id="time"  name="time" value="<?= $story->time ?>">
                <div id="time_error" class="error"></div>
            </div>
            <div>
                <label for="">Author</label>
                <select  id="author_id" name="author_id">

                    <?php foreach ($authors as $author) { ?>
                        <option value="<?= $author->id ?>" <?php if ($story->author_id === $author->id) echo "selected" ?>><?= $author->first_name ?> <?= $author->last_name ?></option>
                    <?php } ?>

                </select>
                <div id="author_id_error" class="error"></div>
            </div>
            <div>
                <label for="">Category</label>
                <select  id="category_id" name="category_id">

                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->id ?>" <?php if ($story->category_id === $category->id) echo "selected" ?>> <?= $category->name ?></option>
                    <?php } ?>

                </select>
                <div id="category_id_error" class="error"></div>
            </div>

            
            <div>
                <button id="submit_btn" class="btn_prime"><input type="submit"><a href="edit_story.php?id=<?= $story->id;?>"></a></button>
                <button> <a href="index.php">Cancel</a></button>

                <!-- <button id="submit_btn" class="button-2 submitBtn" type="submit" formaction="edit_story.php">Submit</button>
                <button class="button-2" role="button"><a href="index.php">Cancel</a></button> -->
            </div>

            <!-- <div>
                <button class="btn_prime" type="submit"><a href="edit_story.php">Edit</a></button>
                <button> <a href="index.php">Cancel</a></button>
            </div> -->

    </div>

    </form>
    </div>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
    <script src="js/validate_story.js"></script>
</body>

</html>