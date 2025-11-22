<?php
session_start();
require_once "logic/init.php";
require_once "logic/helpers.php";
require_once "logic/banker_logic.php";

if (!isset($_SESSION['cases']) || !is_array($_SESSION['cases'])) {
    init_game();
}

if (!isset($_SESSION['opened_cases'])) {
    $_SESSION['opened_cases'] = [];
}
if (!isset($_SESSION['round'])) {
    $_SESSION['round'] = 1;
}
if (!isset($_SESSION['bank_offers'])) {
    $_SESSION['bank_offers'] = [];
}

if (isset($_GET['pick'])) {
    $pick = intval($_GET['pick']);
    if ($pick >= 0 && $pick < 26 && !isset($_SESSION['player_case'])) {
        $_SESSION['player_case'] = $pick;
        header("Location: game.php");
        exit;
    }
}

if (isset($_GET['open'])) {
    $open = intval($_GET['open']);
    if ($open >= 0 && $open < 26) {
        if (isset($_SESSION['player_case'])) {
            if (!in_array($open, $_SESSION['opened_cases']) && $open != $_SESSION['player_case']) {
                $_SESSION['opened_cases'][] = $open;
                header("Location: game.php");
                exit;
            }
        }
    }
}

if (is_game_complete()) {
    header("Location: results.php");
    exit;
}

$remaining = remaining_values();
$to_open = cases_per_round($_SESSION['round']);

$opened = count($_SESSION['opened_cases']);
$needed = 0;
for ($r = 1; $r <= $_SESSION['round']; $r++) {
    $needed += cases_per_round($r);
}

$need_offer = ($opened >= $needed);

if ($need_offer && !empty($remaining)) {
    $offer = banker_offer($remaining, $_SESSION['round']);
    
    if (!empty($_SESSION['bank_offers'])) {
        $last = end($_SESSION['bank_offers']);
        if (abs($last - $offer) > 0.01) {
            $_SESSION['bank_offers'][] = $offer;
        }
    } else {
        $_SESSION['bank_offers'][] = $offer;
    }
    
    $_SESSION['current_offer'] = $offer;
} else {
    if (!$need_offer) {
        unset($_SESSION['current_offer']);
    }
}

if (isset($_POST['deal'])) {
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        die("Invalid security token. Please try again.");
    }
    if (!empty($_SESSION['bank_offers'])) {
        $_SESSION['final_offer'] = end($_SESSION['bank_offers']);
    }
    header("Location: results.php?deal=yes");
    exit;
}

if (isset($_POST['nodeal'])) {
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        die("Invalid security token. Please try again.");
    }
    $_SESSION['round']++;
    header("Location: game.php");
    exit;
}

$cases = $_SESSION['cases'];
$player_case = $_SESSION['player_case'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animations.css">
    <title>Game</title>
</head>

<body>
<div class="center-box">
    <h1>Game Board</h1>

    <?php if ($player_case !== null): ?>
        <div class="game-info">
            <p>Your case: <strong>#<?php echo htmlspecialchars($player_case + 1); ?></strong> | Round: <strong><?php echo htmlspecialchars($_SESSION['round']); ?></strong></p>
        </div>
    <?php else: ?>
        <p class="warning">Please <a href="select_case.php">select your case</a> first.</p>
    <?php endif; ?>

    <div class="case-grid">
<?php foreach ($cases as $i => $val): ?>
    <?php if ($i == $player_case): ?>
        <div class="case locked">Your Case</div>

    <?php elseif (in_array($i, $_SESSION['opened_cases'])): ?>
        <div class="case opened">$<?php echo htmlspecialchars(number_format($val)); ?></div>

    <?php else: ?>
        <?php if (!$need_offer && $player_case !== null): ?>
            <a class="case" href="game.php?open=<?php echo htmlspecialchars($i); ?>">
                Case <?php echo htmlspecialchars($i+1); ?>
            </a>
        <?php else: ?>
            <div class="case disabled">Case <?php echo htmlspecialchars($i+1); ?></div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
    </div>

    <?php if ($need_offer): ?>
        <?php 
        if (!isset($_SESSION['current_offer']) || $_SESSION['current_offer'] <= 0) {
            if (!empty($remaining)) {
                $_SESSION['current_offer'] = banker_offer($remaining, $_SESSION['round']);
            }
        }
        include "banker.php"; 
        ?>
    <?php endif; ?>
</div>

</body>
</html>
