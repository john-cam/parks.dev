<?php

if(isset($_POST['submit'])) {
    $name = strip_tags(ucwords($_POST['name']));
    $location = strip_tags(ucwords($_POST['location']));
    $dateEstablished = strip_tags($_POST['date_established']);
    $areaInAcres = strip_tags($_POST['area_in_acres']);
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
    else if(!is_numeric($dateEstablished))
    {
        $error .= "Please enter a numeric date";
    }
    else if($dateEstablished > date("Y"))
    {
        $error .= "Whoa.. That park hasn't been established yet!";
    }
    else if(!is_numeric($areaInAcres) || $areaInAcres == "")
    {
        $error .= "Please enter a number for the area in acres";
    }
    else
    {
        // no errors, run the query!
        Park::insert($name, $location, $dateEstablished, $areaInAcres, $description);
        $hidden = 1;
    }
    if($error != "")
    {
        echo '<div class="error">' . $error . '</div>';
        $hidden = 0;
    }
}