<?php

require 'Park.php';

$connection = Park::dbConnect();
$count = Park::count();
$selectAll = Park::all();
$returnResults = Park::returnResults(4);