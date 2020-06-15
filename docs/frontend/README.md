# HTML & CSS

## HTML y CSS de la página

```php
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
```

