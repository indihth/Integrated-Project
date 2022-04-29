<?php

// source: https://stackoverflow.com/questions/15963757/how-to-set-current-page-active-in-php
// highlight current page in nav bar
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>

<!-- navbar -->
  <div class="header">
    <h1><a href="index.php">Culture News</a></h1>
    <nav>
      <ul class="nav-cont">
        <li><a class="nav-item <?php active('index.php');?>" href="index.php">Home</a></li>
        <li><a class="nav-item <?php active('author_view_all.php');?>" href="author_view_all.php">Authors</a></li>
        <li><a class="nav-item <?php active('add_story_form.php');?>" href="add_story_form.php">Add Story</a></li>
      </ul>
    </nav>
  </div>