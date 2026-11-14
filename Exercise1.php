<?php
declare(strict_types=1);

function calculateAverage(float $score1, float $score2, float $score3): float
{
    return ($score1 + $score2 + $score3) / 3;
}

$scores = [
    'score1' => '',
    'score2' => '',
    'score3' => '',
];
$errors = [];
$average = null;
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($scores as $field => $value) {
        $input = $_POST[$field] ?? '';
        $scores[$field] = is_string($input) ? trim($input) : '';

        if ($scores[$field] === '' || !is_numeric($scores[$field])) {
            $errors[$field] = 'Please enter a valid number.';
        } elseif ((float) $scores[$field] < 0 || (float) $scores[$field] > 100) {
            $errors[$field] = 'Score must be between 0 and 100.';
        }
    }

    if ($errors === []) {
        $average = calculateAverage(
            (float) $scores['score1'],
            (float) $scores['score2'],
            (float) $scores['score3']
        );
        $result = $average >= 50 ? 'Passed' : 'Failed';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercise 1 - Average Score</title>
</head>
<body>
    <h1>Average Score</h1>
    <form method="post">
        <?php foreach ($scores as $field => $score): ?>
            <label for="<?= htmlspecialchars($field, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
                Score <?= substr($field, -1) ?>:
            </label>
            <input
                type="number"
                id="<?= htmlspecialchars($field, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                name="<?= htmlspecialchars($field, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                min="0"
                max="100"
                step="any"
                value="<?= htmlspecialchars($score, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                required
            >
            <?php if (isset($errors[$field])): ?>
                <span role="alert"><?= htmlspecialchars($errors[$field], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
            <?php endif; ?>
            <br>
        <?php endforeach; ?>
        <button type="submit">Calculate Average</button>
    </form>

    <?php if ($average !== null && $result !== null): ?>
        <p>Average: <?= number_format($average, 2) ?></p>
        <p>Result: <?= htmlspecialchars($result, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <?php endif; ?>
</body>
</html>
