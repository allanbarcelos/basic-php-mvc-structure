<?php
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/DatabaseSeeder.php';
require_once __DIR__ . '/../app/core/App.php';

$seeder = new DatabaseSeeder();
$seeder->run();

$app = new App();
$app->run();