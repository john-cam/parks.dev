<?php

require 'Park.php';

$connection = Park::dbConnect();
$count = Park::count();
$selectAll = Park::all();
$returnResults = Park::returnResults(4);

// var_dump($returnResults);
// var_dump($selectAll);
// var_dump($count);
// var_dump($connection);