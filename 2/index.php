<?php

// need to be changed to psr4 autoloader
require dirname(__FILE__). DIRECTORY_SEPARATOR . 'autoloader.php';

// init family:
$passengers = [
    new Human('Father', Human::TYPE_PARENT),
    new Human('Mother', Human::TYPE_PARENT),
    new Human('Sister', Human::TYPE_CHILD),
    new Human('Brother', Human::TYPE_CHILD)
];

$fisherman = new Human('Fisherman', Human::TYPE_FISHERMAN);

array_push($passengers, $fisherman);

$transporter = (new Transporter($passengers))->transport();