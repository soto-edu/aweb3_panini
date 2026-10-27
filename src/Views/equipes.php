<?php
/** @var App\Models\Equipes[] $equipes */
?>
<h1>Équipes</h1>
<ul>
<?php foreach ($equipes as $equipe): ?>
    <li><?= $equipe->getId() ?> - <?= $equipe->getPays() ?></li>
<?php endforeach; ?>
</ul>
