<?php

if(isset($_POST['submit'])) {
    $name = strip_tags(ucwords($_POST['name']));
    $location = strip_tags(ucwords($_POST['location']));
    $date_established = strip_tags($_POST['date_established']);
    $area_in_acres = strip_tags($_POST['area_in_acres']);
    $description = strip_tags($_POST['description']);
    $page = (int) strip_tags($_POST['page']);

    $error = "";
    if($name == "")
    {
        $error .= "Please enter your name";
    }
    else if(strlen($name) < 2)
    {
        $error .= "Please enter a park name";
    }
    else if($location == "")
    {
        $error .= "Please enter your location";
    }
    else if(!is_numeric($date_established))
    {
        $error .= "Please enter a numeric date";
    }
    else if($date_established > date("Y"))
    {
        $error .= "Whoa.. That park hasn't been established yet!";
    }
    else if(!is_numeric($area_in_acres) || $area_in_acres == "")
    {
        $error .= "Please enter a number for the area in acres";
    }
    else
    {
        // no errors, run the query!
        $query = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description) VALUES (:name, :location, :date_established, :area_in_acres, :description)";
        $result = $db->prepare($query);

        $result->bindValue(':name', $name, PDO::PARAM_STR);
        $result->bindValue(':location', $location, PDO::PARAM_STR);
        $result->bindValue(':date_established', $date_established, PDO::PARAM_STR);
        $result->bindValue(':area_in_acres', $area_in_acres, PDO::PARAM_STR);
        $result->bindValue(':description', $description, PDO::PARAM_STR);

        $result->execute();
        $lp = $lastPage + 1;
        $hidden = 1;
    }
    if($error != "")
    {
        echo '<div class="error">' . $error . '</div>';
        $hidden = 0;
    }
}