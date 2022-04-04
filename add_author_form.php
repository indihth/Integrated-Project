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
        <h2>Add Author</h2>

        <!-- important POST method -->
        <form method="POST" action="add_author.php" class="form">
            <div>
                <label for="">First Name</label>
                <!-- use NAME to put value into POST -->
                <input type="text" name="first_name">
            </div>

            <div>
                <label for="">Last Name</label>
                <input type="text" name="last_name">
            </div>
            <div>
                <label for="">Link</label>
                <input type="text" name="link">
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

<!-- if page left, clear the data -move to different page then return to no data- -->
<?php
if (isset($_SESSION["data"])  and isset($_SESSION["errors"])) {
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>