<?php
require_once __DIR__ . '/desk.php';
require_once __DIR__ . '/project.php';

$localRoutes = array_merge(
    $routes_desk,
    $routes_project
);
return $localRoutes;
