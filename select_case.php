<?php
session_start();
if (!isset($_SESSION['cases'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
    <title>Select Your Case</title>
</head>
<body class="fade-in">

<h2>Select Your Case</h2>

<form action="game.php" method="post">
    <div class="case-grid">
        <?php foreach ($_SESSION['cases'] as $i => $v): ?>
            <button class="case-btn" name="player_case" value="<?= $i ?>">
                <?= $i+1 ?>
            </button>
        <?php endforeach; ?>
    </div>
</form>

</body>
</html>