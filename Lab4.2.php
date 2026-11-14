<?php
$name = '';
$phone = '';
$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    $nameInput = $_POST['name'] ?? '';
    $phoneInput = $_POST['phone'] ?? '';
    $name = is_string($nameInput) ? trim($nameInput) : '';
    $phone = is_string($phoneInput) ? trim($phoneInput) : '';

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($phone === '') {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+\-\s()]{7,20}$/', $phone)) {
        $errors[] = 'Enter a valid phone number.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.2 - POST Form</title>
</head>
<body>
    <h1>Contact Details</h1>
    <?php foreach ($errors as $error): ?>
        <p role="alert"><?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php endforeach; ?>
    <form method="post">
        <label for="name">Name:</label>
        <input id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <label for="phone">Phone:</label>
        <input id="phone" name="phone" value="<?= htmlspecialchars($phone, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <button type="submit">Submit</button>
    </form>
    <?php if ($submitted && $errors === []): ?>
        <p>Thank you, <?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>.</p>
    <?php endif; ?>
</body>
</html>
