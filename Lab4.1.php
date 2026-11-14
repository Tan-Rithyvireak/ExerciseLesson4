<?php
$keyword = $_GET['keyword'] ?? '';
$keyword = is_string($keyword) ? trim($keyword) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.1 - GET Search</title>
</head>
<body>
    <h1>Book Search</h1>
    <form method="get">
        <label for="keyword">Book title:</label>
        <input id="keyword" name="keyword" value="<?= htmlspecialchars($keyword, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        <button type="submit">Search</button>
    </form>
    <?php if ($keyword !== ''): ?>
        <p>Search keyword: <?= htmlspecialchars($keyword, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>
