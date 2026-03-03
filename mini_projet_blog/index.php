<?php
require_once 'managers/PostManager.php';

$postManager = new PostManager();
$posts = $postManager->findAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Blog POO Pro</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <h1>Mon Blog Professionnel</h1>

    <?php foreach ($posts as $post): ?>
        <?php $postManager->loadCategories($post); ?>
        <article>
            <h2><?= $post->title ?></h2>
            <div class="meta">
                Par <strong><?= $post->author->username ?></strong> 
                le <?= $post->createdAt->format('d/m/Y') ?>
            </div>

            <div style="margin-bottom: 15px;">
                <?php foreach ($post->categories as $category): ?>
                    <span class="tag"><?= $category->title ?></span>
                <?php endforeach; ?>
            </div>

            <p><?= $post->excerpt ?></p>
        </article>
    <?php endforeach; ?>

    <hr>
    <h3>Mode Debug (Analyse des objets)</h3>
    <pre><?php var_dump($posts); ?></pre>

</body>
</html>