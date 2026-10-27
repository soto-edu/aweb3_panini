<?php
require_once dirname(__DIR__, 2) . '/src/Config/env.php';
$appName = $_ENV['APP_NAME'];
?>
<h1><?= $appName; ?></h1>
PAGE_ACCUEIL

<a href="/equipes">Équipes</a>