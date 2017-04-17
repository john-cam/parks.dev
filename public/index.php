<?php

$hidden = "1";

require_once '../Park.php';
require_once '../checkSubmit.php';

// extract(Park::getPageNumber()) returns $page as the page number
extract(Park::getPageNumber());
$limit = 6;

$allParks = Park::returnResults($limit);
$lastPage = Park::getLastPage($limit);

$add = Park::getNumberToAdd($page, $lastPage);
$subtract = Park::getNumberToSubtract($page);

?>

<DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/parks2.css" rel="stylesheet" type="text/css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header"></div>
        <section class="parks_content">
            <h1>National Parks</h1>
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Date Established</th>
                        <th>Area In Acres</th>
                        <th>Description</th>
                    </tr>
                </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <?php
                        foreach($allParks as $parks) 
                        {
                            echo '<tr>';
                                echo '<td>' . $parks->name . '</td>';
                                echo '<td>' . $parks->location . '</td>';
                                echo '<td>' . $parks->dateEstablished . '</td>';
                                echo '<td>' . $parks->areaInAcres . '</td>';
                                echo '<td>' . $parks->description . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="href left">
                <a href="?page=<?php echo $page - $subtract ?>">Previous</a>
            </div>
            <div class="href right">
                <a href="?page=<?php echo $page + $add ?>">Next</a>
            </div>
            <div class="spacing-top"> </div>
            <div class="form-header hidden">
                <div class="addForm">
                    <h2 class="addPark">Add Park</h2>
                </div>
            </div>
            <div class="input-form hidden">
                <form action="index.php" method="POST">
                    <?php if(isset($_POST['submit'])) { ?>
                        <?php if(!empty($errors['name'])) {
                        echo '<div class="error">' . $errors['name'] . '</div>';
                        }
                    }?>
                    <input type="text" name="name" id="name" placeholder="Name">
                    <?php
                    if(isset($_POST['submit']))
                    {
                        if(!empty($errors['location']))
                        {
                            echo '<div class="error">' . $errors['location'] . '</div>';
                        }
                    }
                    ?>
                    <input type="text" name="location" id="location" placeholder="Location">
                    <?php
                    if(isset($_POST['submit']))
                    {
                        if(!empty($errors['date_established']))
                        {
                            echo '<div class="error">' . $errors['date_established'] . '</div>';
                        }
                    }
                    ?>
                    <input type="text" name="date_established" id="date_established" placeholder="Date Established" maxlength="4">
                    <?php
                    if(isset($_POST['submit']))
                    {
                        if(!empty($errors['acres']))
                        {
                            echo '<div class="error">' . $errors['acres'] . '</div>';
                        }
                    }
                    ?>
                    <input type="text" name="area_in_acres" id="area_in_acres" placeholder="Area In Acres">
                    <?php
                    if(isset($_POST['submit']))
                    {
                        if(!empty($errors['description']))
                        {
                            echo '<div class="error">' . $errors['description'] . '</div>';
                        }
                    }
                    ?>
                    <input type="text" name="description" id="description" placeholder="Description">
                    <input type="hidden" name="page" value="<?php echo $page ?>">
                    <button type="submit" name="submit" id="button">Submit</button>
                </form>
            </div>
            <div class="footer"></div>
        </section>
        <script>
        $(document).ready(function(){
            var fade = 400;
            var hidden = <?php echo $hidden ?>;
            var clicks = 1;

            if(hidden == 0)
            {
                $(".form-header").fadeIn(fade);
                $(".input-form").fadeIn(fade);
                $(".error").fadeIn(fade);
                clicks = 2;
            }

            $(".tbl-content").click(function(){
                setTimeout(function(){
                    if(clicks % 2 == 0){
                        $(".form-header").fadeIn(fade);
                        $(".input-form").fadeIn(fade);
                        $(".error").fadeIn(fade);
                    }
                    else
                    {
                        $(".form-header").fadeOut(fade);
                        $(".input-form").fadeOut(fade);
                        $(".error").fadeOut(fade);
                    }
                }, fade);
                clicks++;
            });
        });
        </script>
    </body>
</html>