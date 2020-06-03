<?php
require_once __DIR__ . '/desk.php';
require_once __DIR__ . '/desk_col.php';
require_once __DIR__ . '/desk_col_feature.php';
require_once __DIR__ . '/feature.php';
require_once __DIR__ . '/project.php';
require_once __DIR__ . '/status.php';

$localRoutes = array_merge(
    $routes_desk,
    $routes_desk_col,
    $routes_desk_col_feature,
    $routes_feature,
    $routes_project,
    $routes_status,
);
return $localRoutes;
