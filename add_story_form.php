<?php
require_once 'classes/DBConnector.php';

try {

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

    <!-- navbar -->
    <div class="header">
        <a href="index.php">
            <h1>Culture News</h1>
        </a>
        <nav>
            <ul class="nav-cont">
                <li><a class="active nav-item" href="index.php">Home</a></li>
                <li><a class="nav-item" href="#news">News</a></li>
                <li><a class="nav-item" href="#news">Events</a></li>
                <li><a class="nav-item" href="add_author_form.php">Add Author</a></li>
                <li><a class="nav-item" href="add_story_form.php">Add Story</a></li>
            </ul>
        </nav>
    </div>

    <div class="main">
        <h2>Add Story</h2>

        <!-- important POST method -->
        <form method="POST" action="add_story.php" class="form">
            <div>
                <label for="">Headline</label>
                <!-- use NAME to put value into POST -->
                <input type="text" name="headline">
            </div>

            <div>
                <label for="">Short headline</label>
                <input type="text" name="short_headline">
            </div>

            <div>
                <label for="">Sub-heading</label>
                <input type="text" name="sub_heading">
            </div>
            <div>
                <label for="">Main Story</label>
                <textarea name="main_story" cols="30" rows="10"></textarea>
            </div>
            <div>
                <label for="">Summary</label>
                <textarea name="summary" cols="30" rows="10"></textarea>
            </div>
            <div>
                <label for="">Date</label>
                <input type="date" name="date">
            </div>
            <div>
                <label for="">Time</label>
                <input type="time" name="time">
            </div>
            <div>
                <label for="">Author</label>
                <select name="author_id">

                    <?php foreach ($authors as $author) { ?>
                        <option value="<?= $author->id ?>"><?= $author->first_name ?> <?= $author->last_name ?></option>
                    <?php } ?>

                </select>
            </div>
            <div>
                <label for="">Category</label>
                <select name="category_id">

                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php } ?>

                </select>
            </div>

            <a href="index.php">Cancel</a>
            <input type="submit">

    </div>

    </form>
    </div>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
    <script src="js/patient_validate.js"></script>
</body>

</html>