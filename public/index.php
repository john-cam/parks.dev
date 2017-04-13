<?php
require '../Park.php';

extract(Park::getPageNumber());
$hidden = "1";
$limit = 6;

$allParks = Park::returnResults($limit);
$lastPage = Park::getLastPage($limit);

$numberToAdd = 1;
$numberToSubtract = 1;

// check the numbers and redirect accordingly
if($page <= 1 || !is_numeric($page)) {
    if($page < 1) {
        header("Location: " . "?page=1");
        die();
    }
    $numberToSubtract = 0;
    $page = 1;
}
if($page > $lastPage) {
    $page = $lastPage;
    $numberToAdd = 0;
    header("Location: " . "?page=$lastPage");
    die();
} else if($page == $lastPage) {
    $numberToAdd = 0;
}

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
                <a href="?page=<?php echo $page - $numberToSubtract ?>">Previous</a>
            </div>
            <div class="href right">
                <a href="?page=<?php echo $page + $numberToAdd ?>">Next</a>
            </div>
            <div class="spacing-top"> </div>
            <div class="form-header hidden">
                <div class="addForm">
                    <h2 class="addPark">Add Park</h2>
                </div>
            </div>
            <div class="input-form hidden">
                <?php require '../checkSubmit.php'; ?>
                <form action="index.php" method="POST">
                    <input type="text" name="name" id="park_name" placeholder="Name">
                    <input type="text" name="location" id="park_name" placeholder="Location">
                    <input type="text" name="date_established" id="park_name" placeholder="Date Established" maxlength="4">
                    <input type="text" name="area_in_acres" id="park_name" placeholder="Area In Acres">
                    <input type="text" name="description" id="park_name" placeholder="Description">
                    <input type="hidden" name="page" value="<?php echo $page ?>">
                    <button type="submit" name="submit" id="button">Submit</button>
                </form>
            </div>
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