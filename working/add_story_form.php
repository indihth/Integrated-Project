<?php
require_once 'classes/DBConnector.php';
session_start();

//check to see if there is already data and if so, display it
if (isset($_SESSION["data"])  and isset($_SESSION["errors"])) {
    $data = $_SESSION["data"];
    $errors = $_SESSION["errors"];
} else {
    $data = [];
    $errors = [];
}

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

    <!-- TITLE AND NAVBAR -->
    <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/site/working/assets/";
    include($IPATH . "nav.php"); ?>

    <div class="main">

        <!-- important POST method -->
        <form method="POST" action="add_story.php" class="form center">
            <h2>Add Story</h2>

            <label for="headline">Headline</label>
            <!-- use NAME to put value into POST -->
            <input type="text" id="headline" name="headline" value="<?php if (isset($data["headline"])) echo $data["headline"]; ?>">

            <div id="headline_error" class="error"><?php if (isset($errors["headline"])) echo $errors["headline"]; ?></div>

            <label for="">Short headline</label>
            <input id="short_headline" type="text" name="short_headline" value="<?php if (isset($data["short_headline"])) echo $data["short_headline"]; ?>">
            <div id="short_headline_error" class="error"><?php if (isset($errors["short_headline"])) echo $errors["short_headline"]; ?></div>

            <label for="">Sub-heading</label>
            <input id="sub_heading" type="text" name="sub_heading" value="<?php if (isset($data["sub_heading"])) echo $data["sub_heading"]; ?>">
            <div id="sub_heading_error" class="error"><?php if (isset($errors["sub_heading"])) echo $errors["sub_heading"]; ?></div>

            <label for="">Summary</label>
            <textarea id="summary" name="summary" cols="30" rows="10" value="<?php if (isset($data["summary"])) echo $data["summary"]; ?>"></textarea>
            <div id="summary_error" class="error"><?php if (isset($errors["summary"])) echo $errors["summary"]; ?></div>

            <label for="">Main Story</label>
            <textarea id="main_story" name="main_story" cols="30" rows="10" value="<?php if (isset($data["main_story"])) echo $data["main_story"]; ?>"></textarea>
            <div id="main_story_error" class="error"><?php if (isset($errors["main_story"])) echo $errors["main_story"]; ?></div>

            <label for="">Date</label>
            <input id="date" type="date" name="date" value="<?php if (isset($data["date"])) echo $data["date"]; ?>">
            <div id="date_error" class="error"><?php if (isset($errors["date"])) echo $errors["date"]; ?></div>

            <label for="">Time</label>
            <input id="time" type="time" name="time" value="<?php if (isset($data["time"])) echo $data["time"]; ?>">
            <div id="time_error" class="error"><?php if (isset($errors["time"])) echo $errors["time"]; ?></div>

            <label for="">Author</label>
            <select id="author_id" name="author_id">

                <?php foreach ($authors as $author) { ?>
                    <option value="<?= $author->id ?>"><?= $author->first_name ?> <?= $author->last_name ?></option>
                <?php } ?>

            </select>
            <div id="author_id_error" class="error"><?php if (isset($errors["author_id"])) echo $errors["author_id"]; ?></div>

            <label for="">Category</label>
            <select id="category_id" name="category_id">

                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php } ?>

            </select>
            <div id="category_id_error" class="error"><?php if (isset($errors["category_id"])) echo $errors["category_id"]; ?></div>

            <div>
                <button id="submit_btn" class="btn_prime" type="submit" formaction="edit_author.php">Submit</button>
                <button formaction="index.php">Cancel</button>
            </div>

            <!-- <div>
                <input type="submit">
                <a href="index.php"><button>Cancel</button></a>
            </div> -->
    </div>

    </form>
    </div>


    <script src="js/validate_story.js"></script>
  </div>
  
  <!-- FOOTER -->
  <?php $IPATH = $_SERVER["DOCUMENT_ROOT"] . "/site/working/assets/";
  include($IPATH . "footer.html"); ?>
</body>

</html>

<!-- if page left, clear the data -move to different page then return to no data- -->
<?php
if (isset($_SESSION["data"])  and isset($_SESSION["errors"])) {
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>