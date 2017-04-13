<?php

require (__DIR__ . '/db_connection.php');

$dropTable = 'DROP TABLE IF EXISTS national_parks';

$db->exec($dropTable);

$createTable = 'CREATE TABLE national_parks (
    id int NOT NULL auto_increment,
    name varchar(60) NOT NULL,
    location varchar (60) NOT NULL,
    date_established varchar(4) NOT NULL,
    area_in_acres double NOT NULL,
    description varchar(120) NOT NULL,
    PRIMARY KEY (id)
)';

$db->exec($createTable);