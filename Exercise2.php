<?php
declare(strict_types=1);

function calculateRectangleArea(float $width, float $height): float
{
    if ($width < 0 || $height < 0) {
        throw new InvalidArgumentException('Width and height must not be negative.');
    }

    return $width * $height;
}

$width = '';
$height = '';
$errors = [];
$area = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['width', 'height'] as $field) {
        $input = $_POST[$field] ?? '';
        $$field = is_string($input) ? trim($input) : '';

        if ($$field === '' || !is_numeric($$field)) {
            $errors[$field] = 'Please enter a valid number.';
        } elseif ((float) $$field < 0) {
            $errors[$field] = 'Value must not be negative.';
        }
    }

    if ($errors === []) {
        $area = calculateRectangleArea((float) $width, (float) $height);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercise 2 - Rectangle Area</title>
</head>
<body>
    <h1>Rectangle Area</h1>
    <form method="post">
        <label for="width">Width:</label>
        <input type="number" id="width" name="width" min="0" step="any"
            value="<?= htmlspecialchars($width, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['width'])): ?>
            <span role="alert"><?= htmlspecialchars($errors['width'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
        <?php endif; ?>
        <br>
        <label for="height">Height:</label>
        <input type="number" id="height" name="height" min="0" step="any"
            value="<?= htmlspecialchars($height, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        <?php if (isset($errors['height'])): ?>
            <span role="alert"><?= htmlspecialchars($errors['height'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
        <?php endif; ?>
        <br>
        <button type="submit">Calculate Area</button>
    </form>
    <?php if ($area !== null): ?>
        <p>Area: <?= number_format($area, 2) ?></p>
    <?php endif; ?>
</body>
</html>
