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
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/site/assets/";
    include($IPATH . "nav.html"); ?>

    <div class="main">

        <!-- important POST method -->
        <form method="POST" action="delete_story.php" class="form center">
            <h2>Delete Story</h2>

            <input type="hidden" name="id" value="<?= $story->id ?>">

            <div>
                <label for="">Headline</label>
                <!-- use NAME to put value into POST -->
                <input type="text" name="headline" disabled value="<?= $story->headline ?>">
            </div>

            <div>
                <label for="short_headline">Short headline</label>
                <input type="text" name="short_headline" disabled value="<?= $story->short_headline ?>">
            </div>

            <div>
                <label for="sub_heading">Sub-heading</label>
                <input type="text" name="sub_heading" disabled value="<?= $story->sub_heading ?>">
            </div>
            <div>
                <label for="main_story">Main Story</label>
                <textarea name="main_story" cols="30" rows="10" disabled><?= $story->main_story ?></textarea>
            </div>
            <div>
                <label for="summary">Summary</label>
                <textarea name="summary" cols="30" rows="10" disabled><?= $story->summary ?></textarea>
            </div>
            <div>
                <label for="">Date</label>
                <input type="date" name="date" disabled value="<?= $story->date ?>">
            </div>
            <div>
                <label for="">Time</label>
                <input type="time" name="time" disabled value="<?= $story->time ?>">
            </div>
            <div>
                <label for="">Author</label>
                <select name="author_id" disabled>

                    <?php foreach ($authors as $author) { ?>
                        <option value="<?= $author->id ?>" <?php if ($author === $author->id) echo "selected" ?>><?= $author->first_name ?> <?= $author->last_name ?></option>
                    <?php } ?>

                </select>
            </div>
            <div>
                <label for="">Category</label>
                <select name="category_id" disabled>

                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php } ?>

                </select>
            </div>

            <div>
                <a href="delete_story.php?id=<?= $story->id; ?>"><input type="submit"></a>
                <a href="index.php"><button>Cancel</button></a>
            </div>

    </div>

    </form>
    </div>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
    <!-- <script src="js/patient_validate.js"></script> -->
</body>

</html>