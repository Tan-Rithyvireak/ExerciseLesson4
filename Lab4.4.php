<?php
$name = '';
$email = '';
$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    $nameInput = $_POST['name'] ?? '';
    $emailInput = $_POST['email'] ?? '';
    $name = is_string($nameInput) ? trim($nameInput) : '';
    $email = is_string($emailInput) ? trim($emailInput) : '';

    if ($name === '') {
        $errors['name'] = 'Name is required.';
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Enter a valid email address.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.4 - Validate Name and Email</title>
</head>
<body>
    <h1>Registration</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['name'])): ?><span role="alert"><?= htmlspecialchars($errors['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <label for="email">Email:</label>
        <input id="email" name="email" type="email" value="<?= htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['email'])): ?><span role="alert"><?= htmlspecialchars($errors['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <button type="submit">Register</button>
    </form>
    <?php if ($submitted && $errors === []): ?>
        <p>Registration details are valid for <?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>.</p>
    <?php endif; ?>
</body>
</html>
