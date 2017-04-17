<?php

if(isset($_POST['submit'])) {
    
    require_once 'Input.php';

    $errors = [];
    $park = new Park();
    try {
        $park->name = Input::getString('name');
    } catch(Exception $e) {
        $errors['name'] = $e->getMessage();
    }

    try {
        $park->location = Input::getString('location');
    } catch (Exception $e) {
        $errors['location'] = $e->getMessage();
    }

    try {
        $park->dateEstablished = Input::getNumber('date_established');
    } catch (Exception $e) {
        $errors['date_established'] = $e->getMessage();
    }

    try {
        $park->areaInAcres = Input::getNumber('area_in_acres');
    } catch (Exception $e) {
        $errors['acres'] = $e->getMessage();
    }

    try {
        $park->description = Input::getString('description');
    } catch (Exception $e) {
        $errors['description'] = $e->getMessage();
    }

    foreach($_REQUEST as $post => $value) {
        if(($value === "" || $value == null) && $post != 'submit') {
            $errors[$post] = "Please fill in your input";
        }
    }
    // no errors, run the query!
    if(empty($errors)) {
        Park::insert($park->name, $park->location, $park->dateEstablished, $park->areaInAcres, $park->description);
        $hidden = 1;
    } else {
        // if exception thrown
        $hidden = 0;
    }
}