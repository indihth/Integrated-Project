<?php

session_start();

//check to see if there is already data and if so, display it
if (isset($_SESSION["data"])  and isset($_SESSION["errors"])) {
    $data = $_SESSION["data"];
    $errors = $_SESSION["errors"];
} else {
    $data = [];
    $errors = [];
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
        <form method="POST" action="add_author.php" class="form center">
            <h2>Add Author</h2>

            <label for="first_name">First Name</label>
            <!-- use NAME to put value into POST -->
            <input type="text" id="first_name" name="first_name" value="<?php if (isset($data["first_name"])) echo $data["first_name"];?>">

            <!-- checking if there's an error then printing it out -->
            <div id="first_name_error" class="error"><?php if (isset($errors["first_name"])) echo $errors["first_name"];?></div>

            <label for="">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?php if (isset($data["last_name"])) echo $data["last_name"];?>">
            <div id="last_name_error" class="error"><?php if (isset($errors["last_name"])) echo $errors["last_name"];?></div>

            <label for="">Link</label>
            <input type="text" id="link" name="link" value="<?php if (isset($data["link"])) echo $data["link"];?>">
            <div id="link_error" class="error"><?php if (isset($errors["link"])) echo $errors["link"];?></div>

            <div>
                <button id="submit_btn" class="button-2 submitBtn" type="submit" formaction="add_author.php">Submit</button>
                <button class="button-2" role="button"><a href="index.php">Cancel</a></button>
            </div>
    </div>

    </form>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
    <script src="js/validate_author.js"></script>
</body>

</html>

<!-- if page left, clear the data -move to different page then return to no data- -->
<?php
        if (isset($_SESSION["data"])  and isset($_SESSION["errors"])) {
            unset($_SESSION["data"]);
            unset($_SESSION["errors"]);
        }
        ?>