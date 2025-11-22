<?php
session_start();
require_once "logic/helpers.php";
require_once "logic/banker_logic.php";

# FIRST ENTRY → picking the main case
if (isset($_GET['pick']) && $_SESSION['player_case'] === null) {
    $_SESSION['player_case'] = intval($_GET['pick']);
}

# OPEN CASE
if (isset($_GET['open'])) {
    $open = intval($_GET['open']);
    if (!in_array($open, $_SESSION['opened_cases']) &&
        $open !== $_SESSION['player_case']) {
        $_SESSION['opened_cases'][] = $open;
    }
}

# VALUES LEFT
$remaining = remaining_values();

# CASES THIS ROUND
$to_open = cases_per_round($_SESSION['round']);

# IF PLAYER OPENED ENOUGH CASES → banker makes offer
$need_offer = (count($_SESSION['opened_cases']) >= 
               ($_SESSION['round'] + $to_open - 1));

$offer = null;
if ($need_offer) {
    $offer = banker_offer($remaining, $_SESSION['round']);
    $_SESSION['bank_offers'][] = $offer;
}

# DEAL BUTTON PRESSED
if (isset($_POST['deal'])) {
    $_SESSION['final_offer'] = end($_SESSION['bank_offers']);
    header("Location: results.php?deal=yes");
    exit;
}

# NO DEAL BUTTON
if (isset($_POST['nodeal'])) {
    $_SESSION['round']++;
}

$cases = $_SESSION['cases'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Game</title>
</head>

<body class="fade-in">
<h1>Game Board</h1>

<p>Your case: <strong>#<?php echo $_SESSION['player_case'] + 1; ?></strong></p>

<div class="case-grid">
<?php foreach ($cases as $i => $val): ?>
    <?php if ($i == $_SESSION['player_case']): ?>
        <div class="case locked">Your Case</div>

    <?php elseif (in_array($i, $_SESSION['opened_cases'])): ?>
        <div class="case opened">$<?php echo number_format($val); ?></div>

    <?php else: ?>
        <?php if (!$need_offer): ?>
            <a class="case" href="game.php?open=<?php echo $i; ?>">
                Case <?php echo $i+1; ?>
            </a>
        <?php else: ?>
            <div class="case disabled">Case <?php echo $i+1; ?></div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<?php if ($need_offer): ?>
    <?php include "banker.php"; ?>
<?php endif; ?>

</body>
</html>
