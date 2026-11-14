<?php
session_start();

$programOptions = ['CS' => 'Computer Science', 'IT' => 'Information Technology', 'ISTD' => 'Information Systems and Design'];
$nameInput = $_POST['name'] ?? '';
$emailInput = $_POST['email'] ?? '';
$programInput = $_POST['program'] ?? '';
$name = is_string($nameInput) ? trim($nameInput) : '';
$email = is_string($emailInput) ? trim($emailInput) : '';
$program = is_string($programInput) ? $programInput : '';
$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    if ($name === '') {
        $errors['name'] = 'Name is required.';
    } elseif (strlen($name) > 100) {
        $errors['name'] = 'Name must not exceed 100 characters.';
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if (!array_key_exists($program, $programOptions)) {
        $errors['program'] = 'Select a valid program.';
    }

    if ($errors === []) {
        $_SESSION['lab49_success'] = [
            'name' => $name,
            'program' => $programOptions[$program],
        ];
        header('Location: Lab4.9.php', true, 303);
        exit;
    }
}

$success = $_SESSION['lab49_success'] ?? null;
unset($_SESSION['lab49_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.9 - Student Registration</title>
</head>
<body>
    <h1>Student Registration</h1>
    <?php if (is_array($success) && isset($success['name'], $success['program'])): ?>
        <p role="status">Registration complete for <?= htmlspecialchars($success['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> (<?= htmlspecialchars($success['program'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>).</p>
    <?php endif; ?>
    <form method="post">
        <label for="name">Full name:</label>
        <input id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['name'])): ?><span role="alert"><?= htmlspecialchars($errors['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <label for="email">Email:</label>
        <input id="email" name="email" type="email" value="<?= htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['email'])): ?><span role="alert"><?= htmlspecialchars($errors['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <label for="program">Program:</label>
        <select id="program" name="program" required>
            <option value="">Choose a program</option>
            <?php foreach ($programOptions as $value => $label): ?>
                <option value="<?= htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" <?= $program === $value ? 'selected' : '' ?>>
                    <?= htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['program'])): ?><span role="alert"><?= htmlspecialchars($errors['program'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span><?php endif; ?>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
