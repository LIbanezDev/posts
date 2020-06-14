<?php
    require_once 'database/connection.php';
    require_once 'components/helpers.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Lucas Posts</title>
</head>
<body>
<header id="cabecera">
    <div id="logo">
        <a href="index.php">
            LUCAS POSTS
        </a>
    </div>
    <nav id="menu">
        <ul>
            <?php $categories = getCategories($conn); ?>
            <?php while($category = $categories->fetch_assoc()): ?>
                <li>
                    <a href="/index.php?category=<?=$category['id']?>"> <?= $category['name'] ?> | <?= $category['amount']?>
                    </a>
                </li>
            <?php  endwhile; ?>
            <li>
                <a href="/aboutme.php"> About me </a>
            </li>
            <li>
                <a href="/contact.php"> Contact </a>
            </li>
        </ul>
    </nav>
</header>


