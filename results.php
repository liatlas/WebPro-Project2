<?php
session_start();

$player_case_index = $_SESSION['player_case'];
$player_case_value = $_SESSION['cases'][$player_case_index];

$deal_taken = isset($_GET['deal']) && $_GET['deal'] === "yes";
$final_offer = $deal_taken ? $_SESSION['final_offer'] : null;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Results</title>
</head>

<body class="fade-in">
<h1>Game Results</h1>

<div class="results-box">
    <h2>Your Case Value: $<?php echo number_format($player_case_value); ?></h2>

    <?php if ($deal_taken): ?>
        <h3>You accepted the deal:</h3>
        <h2 class="deal-result">$<?php echo number_format($final_offer); ?></h2>

        <?php if ($final_offer > $player_case_value): ?>
            <p class="win-text">Good Deal! You beat the banker!</p>
        <?php else: ?>
            <p class="lose-text">Bad Deal! The banker tricked you!</p>
        <?php endif; ?>

    <?php else: ?>
        <p class="nodeal-text">You refused all deals!</p>
        <p>Your final winnings come from your case.</p>
    <?php endif; ?>
</div>

<a class="btn" href="index.php">Play Again</a>

</body>
</html>
