<?php
$skillOptions = ['PHP', 'HTML', 'CSS', 'JavaScript'];
$skillsInput = $_POST['skills'] ?? [];
$skills = is_array($skillsInput)
    ? array_values(array_intersect($skillOptions, array_filter($skillsInput, 'is_string')))
    : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.6 - Sticky Checkbox Array</title>
</head>
<body>
    <h1>Select Your Skills</h1>
    <form method="post">
        <?php foreach ($skillOptions as $skill): ?>
            <label>
                <input type="checkbox" name="skills[]" value="<?= htmlspecialchars($skill, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" <?= in_array($skill, $skills, true) ? 'checked' : '' ?>>
                <?= htmlspecialchars($skill, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Selected skills</h2>
        <?php if ($skills === []): ?>
            <p>No valid skills selected.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($skills as $skill): ?>
                    <li><?= htmlspecialchars($skill, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
