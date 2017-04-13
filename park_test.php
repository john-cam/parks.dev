<?php
require 'Park.php';

$connection = Park::dbConnect();

// echo $connection->getAttribute(PDO::ATTR_CONNECTION_STATUS) . PHP_EOL;

$count = Park::count();

$selectAll = Park::all();

$returnResults = Park::returnResults(4);

var_dump($returnResults);


// var_dump($selectAll);
// var_dump($count);