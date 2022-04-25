<?php
require_once 'classes/DBConnector.php';

try {

    $author = Get::byId('authors', $_GET["id"]);

    // $story = Get::byId('stories', $_GET["id"]);
    // $author = Get::byId('authors', $author->author_id);
    // $category = Get::byId('categories', $story->category_id);


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
        <form method="POST" action="edit_author.php" class="form center">
            <h2>Edit Author</h2>

            <input type="hidden" name="id" value="<?= $author->id ?>">

            <div>
                <label for="">First Name</label>
                <!-- use NAME to put value into POST -->
                <input type="text" id="first_name" name="first_name" value="<?= $author->first_name ?>">
                <!-- checking if there's an error then printing it out -->
                <div id="first_name_error" class="error"></div>
            </div>

            <div>
                <label for="">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?= $author->last_name ?>">
                <div id="last_name_error" class="error"></div>
            </div>
            <div>
                <label for="">Link</label>
                <input type="text" id="link" name="link" value="<?= $author->link ?>">
                <div id="link_error" class="error"></div>
            </div>

            <!-- <button id="submit_btn" class="button primary" type="submit" formaction="edit_author.php">Submit</button>
            <button><a href="author_view_all.php">Cancel</a></button> -->
            <button  id="submit_btn" class="btn_prime" type="submit"> Edit</button>
            <button formaction="author_view_all.php">Cancel</button>

    </div>

    </form>
    </div>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
    <script src="js/validate_author.js"></script>
</body>

</html>