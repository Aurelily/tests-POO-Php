<h1>Liste des annonces</h1>

<?php foreach($annonces as $annonce): ?>

    <article>
        <h2><a href="annonces/lire/<?= $annonce->id?>"><?= $annonce->titre ?></a></h2>
        <p><?= $annonce->description ?></p>
    </article>

<?php endforeach; ?>