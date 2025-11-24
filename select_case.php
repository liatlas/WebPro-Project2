<?php
session_start();
require_once "logic/init.php";

if (!isset($_SESSION['cases']) || !is_array($_SESSION['cases'])) {
    init_game();
}

if (isset($_SESSION['player_case'])) {
    header("Location: game.php");
    exit;
}

$cases = $_SESSION['cases'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animations.css">
    <title>Select Your Case</title>
</head>

<body>
    <div class="center-box">
        <h1>Select Your Case</h1>
        <p>Choose one case to keep throughout the game.</p>

        <div class="case-grid">
        <?php foreach ($cases as $i => $val): ?>
            <a class="case"
               href="game.php?pick=<?php echo htmlspecialchars($i); ?>">
                Case <?php echo htmlspecialchars($i+1); ?>
            </a>
        <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
