<?php
session_start();
require_once "logic/init.php";

if (!isset($_SESSION['cases']) || !isset($_SESSION['player_case'])) {
    header("Location: index.php");
    exit;
}

$case_index = $_SESSION['player_case'];
$case_value = $_SESSION['cases'][$case_index];

$deal_taken = isset($_GET['deal']) && $_GET['deal'] === "yes";
$final_offer = null;
if ($deal_taken && isset($_SESSION['final_offer'])) {
    $final_offer = $_SESSION['final_offer'];
}

if (isset($_GET['play_again']) && $_GET['play_again'] === "yes") {
    unset($_SESSION['cases']);
    unset($_SESSION['opened_cases']);
    unset($_SESSION['player_case']);
    unset($_SESSION['round']);
    unset($_SESSION['bank_offers']);
    unset($_SESSION['final_offer']);
    unset($_SESSION['current_offer']);
    init_game();
    header("Location: select_case.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animations.css">
    <title>Results</title>
</head>

<body>
<div class="center-box">
    <h1>Game Results</h1>

    <div class="results-box">
        <h2>Your Case Value: $<?php echo htmlspecialchars(number_format($case_value)); ?></h2>

        <?php if ($deal_taken && $final_offer !== null): ?>
            <h3>You accepted the deal:</h3>
            <h2 class="deal-result">$<?php echo htmlspecialchars(number_format($final_offer, 2)); ?></h2>

            <?php if ($final_offer > $case_value): ?>
                <p class="win-text">Good Deal! You beat the banker!</p>
            <?php else: ?>
                <p class="lose-text">Bad Deal! The banker tricked you!</p>
            <?php endif; ?>

        <?php else: ?>
            <p class="nodeal-text">You refused all deals!</p>
            <p>Your final winnings come from your case.</p>
        <?php endif; ?>
    </div>

    <a class="btn" href="results.php?play_again=yes">Play Again</a>
</div>

</body>
</html>
