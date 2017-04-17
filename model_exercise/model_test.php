<?php

require __DIR__ . '/model.php';

$data = new Model();

$data->name = 'Cameron';

echo $data->name . PHP_EOL;

var_dump($data);