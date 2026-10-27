<?php
/** @var App\Models\Equipes[] $equipes */
?>
<h1>Équipes</h1>
<ul>
<?php foreach ($equipes as $equipe): ?>
    <li><a href="/equipes/<?= $equipe->getId() ?>"><?= $equipe->getPays() ?></a></li>
<?php endforeach; ?>
</ul>
