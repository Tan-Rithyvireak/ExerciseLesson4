<?php
$attackExample = "<script>alert('test')</script>";
$safeOutput = htmlspecialchars($attackExample, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lab 4.3 - Escape HTML</title>
</head>
<body>
    <h1>Escaping Untrusted Text</h1>
    <p>The following input is displayed as text and is not executed:</p>
    <pre><?= $safeOutput ?></pre>
</body>
</html>
