<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameInput = $_POST['name'] ?? '';
    $name = is_string($nameInput) ? trim($nameInput) : '';

    if ($name === '') {
        $_SESSION['lab47_error'] = 'Name is required.';
    } else {
        $_SESSION['lab47_success'] = $name;
    }

    header('Location: Lab4.7.php', true, 303);
    exit;
}

$error = $_SESSION['lab47_error'] ?? null;
$success = $_SESSION['lab47_success'] ?? null;
unset($_SESSION['lab47_error'], $_SESSION['lab47_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.7 - Post/Redirect/Get</title>
</head>
<body>
    <h1>Post/Redirect/Get Example</h1>
    <?php if (is_string($error)): ?><p role="alert"><?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p><?php endif; ?>
    <?php if (is_string($success)): ?><p>Thank you, <?= htmlspecialchars($success, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>. Your form was submitted.</p><?php endif; ?>
    <form method="post">
        <label for="name">Name:</label>
        <input id="name" name="name" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
