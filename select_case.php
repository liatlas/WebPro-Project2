<?php
session_start();
require_once "logic/init.php";

$cases = $_SESSION['cases'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Select Your Case</title>
</head>

<body class="fade-in">
    <h1>Select Your Case</h1>

    <div class="case-grid">
        <?php foreach ($cases as $i => $val): ?>
            <a class="case"
               href="game.php?pick=<?php echo $i; ?>">
                Case <?php echo $i+1; ?>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
