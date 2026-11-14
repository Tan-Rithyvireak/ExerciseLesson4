<?php
$nameInput = $_POST['name'] ?? '';
$courseInput = $_POST['course'] ?? '';
$name = is_string($nameInput) ? trim($nameInput) : '';
$courseOptions = ['CS' => 'Computer Science', 'IT' => 'Information Technology', 'ISTD' => 'Information Systems and Design'];
$course = is_string($courseInput) ? $courseInput : '';
$errors = [];
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($submitted) {
    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if (!array_key_exists($course, $courseOptions)) {
        $errors[] = 'Select a valid course.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.5 - Sticky Form Fields</title>
</head>
<body>
    <h1>Student Course Form</h1>
    <?php foreach ($errors as $error): ?>
        <p role="alert"><?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php endforeach; ?>
    <form method="post">
        <label for="name">Name:</label>
        <input id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
        <label for="course">Course:</label>
        <select id="course" name="course">
            <option value="">Choose a course</option>
            <?php foreach ($courseOptions as $value => $label): ?>
                <option value="<?= htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" <?= $course === $value ? 'selected' : '' ?>>
                    <?= htmlspecialchars($label, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Submit</button>
    </form>
    <?php if ($submitted && $errors === []): ?>
        <p>Saved: <?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> — <?= htmlspecialchars($courseOptions[$course], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>
