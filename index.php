<?php

use lucleads\Mapper\ExampleUseCase\MapperExample;

require __DIR__ . '/vendor/autoload.php';


$app = new MapperExample;
$app->mapRandomPerson();
