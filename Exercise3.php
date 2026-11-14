<?php
declare(strict_types=1);

function formatStudentInfo(string $name, int $age, string $city): string
{
    return sprintf('%s is %d years old and lives in %s.', $name, $age, $city);
}

$name = '';
$age = '';
$city = '';
$errors = [];
$studentInfo = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nameInput = $_POST['name'] ?? '';
    $ageInput = $_POST['age'] ?? '';
    $cityInput = $_POST['city'] ?? '';
    $name = is_string($nameInput) ? trim($nameInput) : '';
    $age = is_string($ageInput) ? trim($ageInput) : '';
    $city = is_string($cityInput) ? trim($cityInput) : '';

    if ($name === '') {
        $errors['name'] = 'Name is required.';
    }
    if (filter_var($age, FILTER_VALIDATE_INT) === false || (int) $age < 1 || (int) $age > 120) {
        $errors['age'] = 'Age must be a whole number between 1 and 120.';
    }
    if ($city === '') {
        $errors['city'] = 'City is required.';
    }

    if ($errors === []) {
        $studentInfo = formatStudentInfo($name, (int) $age, $city);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercise 3 - Student Information</title>
</head>
<body>
    <h1>Student Information</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"
            value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['name'])): ?>
            <span role="alert"><?= htmlspecialchars($errors['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
        <?php endif; ?>
        <br>
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" min="1" max="120" step="1"
            value="<?= htmlspecialchars($age, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['age'])): ?>
            <span role="alert"><?= htmlspecialchars($errors['age'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
        <?php endif; ?>
        <br>
        <label for="city">City:</label>
        <input type="text" id="city" name="city"
            value="<?= htmlspecialchars($city, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['city'])): ?>
            <span role="alert"><?= htmlspecialchars($errors['city'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
        <?php endif; ?>
        <br>
        <button type="submit">Show Student Information</button>
    </form>
    <?php if ($studentInfo !== null): ?>
        <p><?= htmlspecialchars($studentInfo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>
