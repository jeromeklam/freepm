<?php
require_once __DIR__ . '/desk.php';
require_once __DIR__ . '/desk_col.php';
require_once __DIR__ . '/desk_col_feature.php';
require_once __DIR__ . '/feature.php';
require_once __DIR__ . '/feature_histo.php';
require_once __DIR__ . '/issue.php';
require_once __DIR__ . '/issue_category.php';
require_once __DIR__ . '/issue_histo.php';
require_once __DIR__ . '/project.php';
require_once __DIR__ . '/project_category_issue.php';
require_once __DIR__ . '/project_version.php';
require_once __DIR__ . '/project_version_file.php';
require_once __DIR__ . '/status.php';

$localRoutes = array_merge(
    $routes_desk,
    $routes_desk_col,
    $routes_desk_col_feature,
    $routes_feature,
    $routes_feature_histo,
    $routes_issue,
    $routes_issue_category,
    $routes_issue_histo,
    $routes_status,
    $routes_project,
    $routes_project_category_issue,
    $routes_project_version,
    $routes_project_version_file
);

return $localRoutes;
