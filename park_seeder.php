<?php

require_once __DIR__ . '/db_connection.php';

$deleteData = 'TRUNCATE `national_parks`';
$db->exec($deleteData);

$parks = [
    [
        "name" => "Yellowstone",
        "location" => "Wyoming",
        "date_established" => "1872",
        "area_in_acres" => 2219791.33,
        "description" => ""
    ],
    [
        "name" => "Grand Canyon",
        "location" => "Arizona",
        "date_established" => "1919",
        "area_in_acres" => 1217262,
        "description" => ""
    ],
    [
        "name" => "Yosemite",
        "location" => "California",
        "date_established" => "1890",
        "area_in_acres" => 747956,
        "description" => ""
    ],
    [
        "name" => "Rocky Mountains",
        "location" => "Colorado",
        "date_established" => "1915",
        "area_in_acres" => 265461,
        "description" => ""
    ],
    [
        "name" => "Zion",
        "location" => "Utah",
        "date_established" => "1919",
        "area_in_acres" => 146597,
        "description" => ""
    ],
    [
        "name" => "Olympic",
        "location" => "Washington",
        "date_established" => "1938",
        "area_in_acres" => 922650,
        "description" => ""
    ],
    [
        "name" => "Acadia",
        "location" => "Maine",
        "date_established" => "1916",
        "area_in_acres" => 49052,
        "description" => ""
    ],
    [
        "name" => "Grand Teton",
        "location" => "Wyoming",
        "date_established" => "1929",
        "area_in_acres" => 310000,
        "description" => ""       
    ],
    [
        "name" => "Glacier",
        "location" => "Montana",
        "date_established" => "1910",
        "area_in_acres" => 1012837,
        "description" => ""        
    ],
    [
        "name" => "Great Smoky Mountains",
        "location" => "North Carolina",
        "date_established" => "1934",
        "area_in_acres" => 187000,
        "description" => ""
    ],
];

$query = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description) VALUES (:name, :location, :date_established, :area_in_acres, :description)";
$statement = $db->prepare($query);

foreach($parks as $park) {
    $statement->bindValue(':name', $park['name'], PDO::PARAM_STR);
    $statement->bindValue(':location', $park['location'], PDO::PARAM_STR);
    $statement->bindValue(':date_established', $park['date_established'], PDO::PARAM_STR);
    $statement->bindValue(':area_in_acres', $park['area_in_acres'], PDO::PARAM_INT);
    $statement->bindValue(':description', $park['description'], PDO::PARAM_STR);
    $statement->execute();
    echo "ID inserted: " . $db->lastInsertId() . PHP_EOL;
} 