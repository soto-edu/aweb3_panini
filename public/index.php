<?php
require_once __DIR__ . '/../src/Config/env.php';
$appName = $_ENV['APP_NAME']
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $appName; ?></title>
</head>
<body>
<h1><?= $appName; ?></h1>
</body>
</html>