<?php
$nameInput = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
$emailInput = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
$messageInput = filter_input(INPUT_POST, 'message', FILTER_UNSAFE_RAW);
$name = is_string($nameInput) ? trim($nameInput) : '';
$email = is_string($emailInput) ? trim($emailInput) : '';
$message = is_string($messageInput) ? trim($messageInput) : '';
$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    if ($name === '') {
        $errors['name'] = 'Name is required.';
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if ($message === '') {
        $errors['message'] = 'Message is required.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.8 - Secure Contact Form</title>
</head>
<body>
    <h1>Contact Us</h1>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        <label for="name">Name:</label>
        <input id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        <?php if (isset($errors['name'])): ?><span role="alert"><?= htmlspecialchars($errors['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <label for="email">Email:</label>
        <input id="email" name="email" type="email" value="<?= htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        <?php if (isset($errors['email'])): ?><span role="alert"><?= htmlspecialchars($errors['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <label for="message">Message:</label>
        <textarea id="message" name="message"><?= htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></textarea>
        <?php if (isset($errors['message'])): ?><span role="alert"><?= htmlspecialchars($errors['message'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <button type="submit">Send</button>
    </form>
    <?php if ($submitted && $errors === []): ?>
        <h2>Message preview</h2>
        <p>From: <?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> (<?= htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>)</p>
        <p><?= nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) ?></p>
    <?php endif; ?>
</body>
</html>
